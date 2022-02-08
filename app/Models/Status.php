<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Workflow;


class Status extends Model
{
    use HasFactory;

    protected $fillable = array('title','workflow_id');



    public function workflow()
    {
        return $this->belongsTo('App\Models\Workflow', 'workflow_id');
    }
}
