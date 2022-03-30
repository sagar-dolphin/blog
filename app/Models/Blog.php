<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogImages;

class Blog extends Model
{
    use HasFactory;

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
    public function blogImages()
    {
        return $this->hasMany(BlogImages::class);
    }

    public function getTitleAttribute($name)
    {
        return ucfirst($name);
    }

}
