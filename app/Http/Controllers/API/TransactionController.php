<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $transacts = transaction::all();
        $result = TransactionResource::collection($transacts);
        return $this->sendResponse($result, 'Success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TransactionRequest $request)
    {
        // Get input data
        $user_id = $request->input('user_id');
        $shipping_id = $request->input('shipping_id');
        $delivery_fee = $request->input('delivery_fee');
        $payment_method = $request->input('payment_method');
        $transactions = $request->input('transactions');

        // Start database transaction
        DB::beginTransaction();


        try {
            $number = DB::selectOne("SELECT CONCAT(DATE_FORMAT(CURRENT_TIMESTAMP(), '%y%m%d'), LPAD(IFNULL((SELECT COUNT(*) FROM transactions WHERE DATE(created_at) = CURRENT_DATE()) + 1, 1), 4, '0' )) AS transaction_number")->transaction_number;
            DB::select('CALL insert_transaction_header(?, ?, ?, ?, ?)', [
                $user_id,
                $number,
                $shipping_id,
                $delivery_fee,
                $payment_method
            ]);

            foreach ($transactions as $transaction) {
                // Call the stored procedure for each transaction detail
                $transact_id = null;
                $total = null;
                $grand_total = null;

                DB::select('CALL insert_transaction_detail(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                    $number,
                    $transaction['lens_id'],
                    $transaction['frame_id'],
                    $transaction['qty'],
                    $transaction['rsphere'],
                    $transaction['lsphere'],
                    $transaction['rcylinder'],
                    $transaction['lcylinder'],
                    $transaction['raxis'],
                    $transaction['laxis'],
                    $transaction['rprism'],
                    $transaction['lprism'],
                    $transaction['radd'],
                    $transaction['ladd'],
                    $transaction['rbase'],
                    $transaction['lbase'],
                    
                ]);


                // Log the transaction detail
                Log::info('Transaction with ID ' . $transact_id . ' has been created');

            } // end of foreach loop

            // Commit the database transaction
            DB::commit();

            // Return a success response
            return response()->json(['message' => 'Transaction created successfully']);

        } catch (Exception $e) {
            // Rollback the database transaction
            DB::rollback();

            // Return an error response
            return response()->json([
                'error' => 'Transaction creation failed',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($user_id)
    {
        $transactions = DB::table('view_transaction_details')
            ->where('user_id', $user_id)
            ->get()
            ->groupBy('transaction_number')
            ->map(function ($transaction) {
                $transaction_details = $transaction->first();
                $details = $transaction->map(
                    function ($item) {
                            return [
                                'frameName' => $item->frame_name,
                                'framePrice' => $item->frame_price,
                                'lensType' => $item->lens_type,
                                'lensPrice' => $item->lens_price,
                                'qty' => $item->qty,
                                'eye' => $item->eye,
                                'lsphere' => $item->lsphere,
                                'lcylinder' => $item->lcylinder,
                                'laxis' => $item->laxis,
                                'ladds' => $item->ladds,
                                'lprism' => $item->lprism,
                                'lbase' => $item->lbase,
                                'rsphere' => $item->rsphere,
                                'rcylinder' => $item->rcylinder,
                                'raxis' => $item->raxis,
                                'radds' => $item->radds,
                                'rprism' => $item->rprism,
                                'rbase' => $item->rbase,
                                'subTotal' => $item->subtotal,
                                'total' => $item->grand_total,
                                'deliveryFee' => $item->delivery_fee,
                                'grandTotal' => $item->grand_total,
                                'paymentStatus' => $item->payment_status,
                                'deliveryStatus' => $item->delivery_status,
                            ];
                        }
                )->toArray();

                $transaction_details->details = $details;

                return new TransactionResource($transaction_details);
            });

        return $this->sendResponse($transactions, 'data fetched');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(transaction $transaction)
    {

    }
}