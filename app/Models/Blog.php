<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogImages;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'created_by'
    ];

    /**
     * Get all of the blogImages for the Blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    // public static function boot()
    // {
    //     parent::boot();

    //     static::deleted(function ($model) {
    //         $model->load(['blogs', 'blogImages',]);

    //         $model->blogImages()->delete();
    //         $model->blog()->delete();
    //     });
    // }
    public function blogImages()
    {
        return $this->hasMany(BlogImages::class);
    }

    public function blogImage()
    {
        return $this->hasOne(BlogImages::class);
    }

    public function getTitleAttribute($name)
    {
        return ucfirst($name);
    }

    public function getDescriptionAttribute($name)
    {
        return strip_tags($name);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

}
