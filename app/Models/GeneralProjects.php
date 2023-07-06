<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GeneralProjects extends Model
{
    use HasFactory;



    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'title',
        'count_people',
        'name',
        'path'
    ];

//    public static function boot()
//    {
//        parent::boot();
//
//        static::creating(function ($model) {
//            $model->path = Str::random(10) . '_' . $model->name;
//        });
//    }
//
//    public function setImageUriAttribute($value)
//    {
//        $this->attributes['path'] = asset('your_directory/' . $value);
//    }
}
