<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Http\Requests\BlogRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\Blog;
use App\Models\BlogImages;


class BlogService {

    public $request;
    public $uploadedImages = [];

    public function __construct(BlogRequest $request)
    {        
        $this->request = $request;
    }

    public function getDataTables()
    {
        $blogs = Blog::select('*');
        return DataTables::eloquent($blogs)
        ->addColumn('action', function($blogs){
            $getHtml = '<button class="btn edit-blog" data-id="'.$blogs->id.'">';
            $getHtml .= '<i class="fas fa-edit"></i>';
            $getHtml .= '</button>';
            return $getHtml;
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }

    public function createBlog($request)
    {    
        $blog = $request->all();     
        $removedImagesIds = array();
        $images = $request->file('images');
        if(isset($request->remove_image_ids)){
            $removedImagesIds = explode(",", $request->remove_image_ids);
            $images = array_diff_key($images, array_flip($removedImagesIds));
        }
        $blog['created_by'] = auth()->user()->id;
        $blog = Blog::create($blog);
        if($request->hasfile('images')){
            $this->uploadImage($blog, $images);
        }
    }

    public function uploadImage($blog, $images)
    {                
        foreach($images as $key => $value){
            $original_name = $value->getClientOriginalName();
            $name = date('YmdHi').$value->getClientOriginalName();
            $value->move(public_path('images'), $name);
            $blogImages = new BlogImages();
            $blogImages->blog_id = $blog->id;
            $blogImages->name = $name;
            $blogImages->original_name = $original_name;
            $blogImages->save();
        }
        return 0;
    }

    public function updateBlog($request)
    {        
        $blog = $request->all();     
        $removedImagesIds = array();
        $images = $request->file('images');
        if(isset($request->remove_image_ids)){
            $removedImagesIds = explode(",", $request->remove_image_ids);
            $images = array_diff_key($images, array_flip($removedImagesIds));
        }        
        $oldBlog = Blog::find($request->blog_id);        
        $oldBlog->update($blog);        
        if($request->hasfile('images')){            
            $this->uploadImage($oldBlog, $images);
        }
    }
}
