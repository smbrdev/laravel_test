<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Worfklow;
use App\Models\Status;

class Image extends Model
{
    use HasFactory;

    protected $fillable = array('title','url','workflow_id','status_id');

    public function workflow()
    {
        return $this->belongsTo('App\Models\Workflow', 'workflow_id');
    }

    public function status()
    {
        return $this->hasOne('App\Models\Status', 'status_id');
    }
}
