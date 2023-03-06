<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardResource;
use App\Models\credit_card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $card = credit_card::all();
        $result = CardResource::collection($card);
        return $this->sendResponse($result, 'Success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = new CardResource(credit_card::create($request));
        return $this->sendResponse($data, 'Success adding data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\credit_card  $credit_card
     * @return \Illuminate\Http\Response
     */
    public function show(credit_card $credit_card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\credit_card  $credit_card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, credit_card $credit_card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\credit_card  $credit_card
     * @return \Illuminate\Http\Response
     */
    public function destroy(credit_card $credit_card)
    {
        //
    }
}
