<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FrameColorResource;
use App\Models\FrameColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrameColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FrameColor $frameId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $frameId)
{
    $frameColors = FrameColor::where('frame_id', '=', $frameId)->get();
    
    if ($frameColors->isEmpty()) {
        return $this->sendError('Data not found');
    }

    return $this->sendResponse(new FrameColorResource($frameColors), 'Data found');
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
?>