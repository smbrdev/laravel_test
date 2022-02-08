<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\Workflow;


class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        error_log("searching for workflow id : ${id}");
        $workflow = Workflow::find($id);
        error_log($workflow->name);

        if(!$workflow){
          error_log("workflow not found");
          return response()->json("Workflow wasnt found",401);
        }

        $statuses = $workflow->statuses;

        foreach ($statuses as $status) {
            error_log($status->title);
          }

        return response()->json($statuses,201);
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
    public function store(Request $request)
    {
        return response()->json("nothing here",401);
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
        $validated = $request->validate([
        'title' => 'required',
        ]);

        $status = Status::find($id);

        if(!$status){
          return response()->json("Status not found",401);
        }

        $status->title = $validated['title'];
        $status->save();

         return response()->json($status,201);

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json("nothing here",401);
    }
}
