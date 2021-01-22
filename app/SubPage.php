<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubPage extends Model
{
    protected $fillable = ['name_ar','name_en','image','content','page_id'];

    public function page()
    {
        return $this->belongsTo('App\Page','page_id');
    }
}
