<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Status;
use App\Models\Workflow;
use Illuminate\Support\Facades\Storage;





class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $workflow = Workflow::find($id);
        $images = $workflow->images;
        error_log("searching for images for workflow ");
        error_log($workflow->id);

        if(!$workflow){
          return response()->json("Workflow wasnt found",401);
        }

        if(!$images){
           return response()->json("Workflow has no images",444);
        }

        return response()->json($images,201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json("nothing here",401);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->replace($request->all()); 

        $title = $request["title"];
        $image = $request["image"];
        
        error_log($title);

        
        $workflow = Workflow::find($id);
        $uploadFolder = 'images';

        $new_image = new Image;
        $new_image->title = $title;
        $new_image->workflow_id = $id;
        $new_image->status_id = $workflow->statuses->first()->id;

        //$image = $inputs["image"];
        
        $image_uploaded_path = $image->store($uploadFolder, 'public');

        
        Storage::disk('public')->url($image_uploaded_path);

        $new_image->url = Storage::disk('public')->url($image_uploaded_path);

        $new_image->save();
        return response()->json("image stored succesfully",201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json("nothing here",401);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json("nothing here",401);

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
        $image = Image::find($id);

        if(!$image){
          return response()->json("Image wasnt found",401);
        }

        $image->title = $request->title;
        $image->status_id = $request->status_id;
        $image->save();

        return response()->json($image,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);



        if(!$image){
          return response()->json("Image wasnt found",401);
        }

        $image_id = $image->id;
        $workflow_id = $image->workflow->id;

        $image->delete();


        return response()->json("Image with id : $image_id was deleted from workflow : $workflow_id ",201);
    }
}
