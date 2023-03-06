<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrameRequest;
use App\Http\Resources\FrameResource;
use App\Models\Frame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($start = 1, $end = 50)
    {
        $frames = DB::select('select * from view_frames');

        $result = [];

        foreach ($frames as $frame) {
            if (!in_array($frame->frame_id, array_column($result, 'frameId'))) {
                $data = [
                    "frameId" => $frame->frame_id,
                    "name" => $frame->name,
                    "stock" => $frame->stock,
                    "price" => number_format( $frame->price, 0, ',', '.'),
                    "material" => $frame->material,
                    "shape" => $frame->shape,
                    "description" => $frame->description,
                    "rating" => $frame->rating,
                    "pictPath" => $frame->pict_path
                ];
                array_push($result, $data);
            } else {
                continue;
                if ($data['frameId'] == $frame->frame_id) {
                }
            }
        }

        return $this->sendResponse($result, 'Success');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FrameRequest $request)
    {
        $data = new FrameResource(Frame::create($request->validated()));

        return $this->sendResponse($data, 'Success Add Frame');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frame  $frame
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Frame $frame)
    {
        $check = Frame::find($frame->frame_id);
        if (!$check) {
            abort(404, 'Frame Not Found');
        }
        $data = new FrameResource($check);

        return $this->sendResponse($data, 'Data Found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frame  $frame
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(FrameRequest $request, Frame $frame)
    {
        $frame->update($request->validated());

        $data = new FrameResource($frame);

        return $this->sendResponse($data, 'Update Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frame $frame)
    {
        //
    }
}