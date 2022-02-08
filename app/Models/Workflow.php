<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Status;

class Workflow extends Model
{
    use HasFactory;

    protected $fillable = array('name');

    public function statuses()
    {
        return $this->hasMany('App\Models\Status');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }
}
