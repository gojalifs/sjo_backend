<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Util\Exception;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $carts = Cart::all();
            $result = CartResource::collection($carts);
            return $this->sendResponse($result, 'Success');
        } catch (Exception $e) {
            return $this->sendError($e, 'Something error');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Get input data
        $user_id = $request->input('user_id');

        $carts = $request->input('carts');

        // Start database cart
        DB::beginTransaction();


        try {
            $number = DB::selectOne("SELECT CONCAT(DATE_FORMAT(CURRENT_TIMESTAMP(), '%y%m%d'), LPAD(IFNULL((SELECT COUNT(*) FROM carts WHERE DATE(created_at) = CURRENT_DATE()) + 1, 1), 4, '0' )) AS cart_number")->cart_number;
            DB::select('CALL insert_cart_header(?, ?)', [
                $user_id,
                $number,
            ]);

            foreach ($carts as $cart) {
                // Call the stored procedure for each cart detail
                $cart_id = null;
                $total = null;
                $grand_total = null;

                DB::select('CALL insert_carts_detail(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                    $number,
                    $cart['lens_id'],
                    $cart['frame_id'],
                    $cart['qty'],
                    $cart['eye'],
                    $cart['sphere'],
                    $cart['cylinder'],
                    $cart['axis'],
                    $cart['add'],
                    $cart['prism'],
                    $cart['base'], &
                    $cart_id, &
                    $total, &
                    $grand_total
                ]);

                // Log the cart detail
                Log::info('cart with ID ' . $cart_id . ' has been created');

            } // end of foreach loop

            // Commit the database cart
            DB::commit();

            // Return a success response
            return response()->json(['message' => 'cart added successfully']);

        } catch (Exception $e) {
            // Rollback the database cart
            DB::rollback();

            // Return an error response
            return response()->json([
                'error' => 'cart creation failed',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($user_id)
    {
        $carts = DB::table('view_cart_details')
            ->where('user_id', $user_id)
            ->get()
            ->groupBy('transaction_number')
            ->map(function ($cart) {
                $cart_details = $cart->first();
                $details = $cart->map(
                    function ($item) {
                            return [
                                // 'qty' => $item->qty,
                                // 'frameName' => $item->frame_name,
                                // 'framePrice' => $item->frame_price,
                                // 'lensType' => $item->lens_type,
                                // 'lensPrice' => $item->lens_price,
                                'frameName' => $item->frame_name,
                                'framePrice' => $item->frame_price,
                                'lensType' => $item->lens_type,
                                'lensPrice' => $item->lens_price,
                                'qty' => $item-> qty,
                                'eye' => $item-> eye,
                                'sphere' => $item-> sphere,
                                'cylinder' => $item-> cylinder,
                                'axis' => $item-> axis,
                                'adds' => $item-> adds,
                                'prism' => $item-> prism,
                                'base' => $item-> base,
                                
                            ];
                        }
                )->toArray();

                $cart_details->details = $details;

                return new CartResource($cart_details);
            });

        return $this->sendResponse($carts, 'data fetched');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return $this->sendResponse($cart, 'Success Delete');
    }
}