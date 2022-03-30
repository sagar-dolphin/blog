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

    public function __construct(BlogRequest $request)
    {        
        $this->request = $request;
    }

    public function getDataTables()
    {
        // echo "sdfsdf111";exit;
        $blogs = Blog::select('*');
        // dd($blogs);
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
        $blog['created_by'] = auth()->user()->id;
        $blog = Blog::create($blog);
        if($request->hasfile('images')){
            $this->uploadImage($blog, $request->file('images'));
        }
    }

    public function uploadImage($blog, $images)
    {
        foreach($images as $key => $image){
            $original_name = $image->getClientOriginalName();
            $name = date('YmdHi').$image->getClientOriginalName();
            $image->move(public_path('images'), $name);
            $blogImages = new BlogImages();
            $blogImages->name = $name;
            $blogImages->original_name = $original_name;
            $blog->blogImages()->save($blogImages);
        }
        return 0;
    }
}
