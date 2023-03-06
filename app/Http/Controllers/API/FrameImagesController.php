<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrameImageRequest;
use App\Http\Resources\FrameImagesResource;
use App\Models\FrameImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrameImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $images = FrameImage::all();

        if (!$images->count()) {
            abort(404, 'Image not found');
        }

        $grouped = $images->groupBy('frame_id')->map(function ($item) {
            return [
                'frameId' => $item[0]->frame_id,
                'imgPath' => $item->pluck('pict_path')->toArray()
            ];
        })->values();

        return $this->sendResponse($grouped, 'Images found');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FrameImageRequest $request)
    {
        $data = new FrameImagesResource(FrameImage::create($request->validated()));
        return $this->sendResponse($data, 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FrameImage  $frameImage
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($frameImage)
    {
        $images = DB::table('frame_images')
            ->where('frame_id', '=', $frameImage)
            ->get();

        if (!$images->count()) {
            abort(404, 'Image not found');
        }

        $grouped = $images->groupBy('frame_id')->map(function ($item) {
            return [
                'frameId' => $item[0]->frame_id,
                'imgPath' => $item->pluck('pict_path')->toArray()
            ];
        })->values();

        return $this->sendResponse($grouped, 'Images found');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FrameImage  $frameImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FrameImage $frameImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FrameImage  $frameImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(FrameImage $frameImage)
    {
        //
    }
}