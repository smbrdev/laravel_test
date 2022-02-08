<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Status;
use App\Models\Workflow;


class WorkflowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $data = Workflow::all();
          if(!$data){
             return response("No data found !",401);
          }
          return response()->json($data,201);
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
        $validated = $request->validate([
        'name' => 'required',
        'status1' => 'nullable',
        'status2' => 'nullable',
        'status3' => 'nullable',

        ]);

        $validated['status1'] = $validated['status1'] ?? "status1";
        $validated['status2'] = $validated['status2'] ?? "status2";
        $validated['status3'] = $validated['status3'] ?? "status3";

        $workflow_id = Workflow::create(['name' => $validated['name']])->id;

        error_log("logging id of workflow :");
        error_log($workflow_id);

        $stat1 = Status::create([
          'title' => $validated['status1'],
          'workflow_id' => $workflow_id,
        ]);

        $stat2 = Status::create([
          'title' => $validated['status2'],
          'workflow_id' => $workflow_id,
        ]);

        $stat3 = Status::create([
          'title' => $validated['status3'],
          'workflow_id' => $workflow_id,

        ]);

        $workflow = Workflow::find($workflow_id);

        if(!$workflow){
          return response()->json("Worflow wasnt created",401);
        }

        return response()->json($workflow,201);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $worflow = Worflow::find($id);

        if(!$worflow){
          return response()->json("Worflow wasnt found",401);
        }

        return response()->json($workflow,201);
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
        $workflow = Workflow::find($id);

        if(!$workflow){
          return response()->json("Workflow wasnt found",401);
        }

        $workflow->statuses()->delete();
        //$user->images()->delete();
        $workflow->delete();

        return response()->json("Workflow with id : $workflow->id was deleted ",201);
    }
}
