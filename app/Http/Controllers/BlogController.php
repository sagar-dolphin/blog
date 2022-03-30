<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Services\BlogService;
use App\Models\Blog;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request, BlogService $blogService)
    public function index(Request $request)
    {        
        if($request->ajax()){
        //    return $blogService->getDataTables();
           // echo "sdfsdf111";exit;
        $blogs = Blog::with('BlogImages')->where('created_by', auth()->user()->id);   
        return DataTables::eloquent($blogs)
        ->addColumn('image', function($blogs){
            $blogs = $blogs->toArray();
            $getHtmlImg = '';
            for($i=0; $i<count($blogs['blog_images']); $i++){
                $url= asset('images/'.$blogs['blog_images'][$i]['name']);
                $getHtmlImg .= ' <img src="'.$url.'" border="0" width="40" class="img-rounded ml-2" align="center" /> ';
            }
            return $getHtmlImg;
        })
        ->addColumn('action', function($blogs){
            $getHtml = '<button class="btn edit-blog" data-id="'.$blogs->id.'">';
            $getHtml .= '<i class="fas fa-edit"></i>';
            $getHtml .= '</button>';
            return $getHtml;
        })
        ->rawColumns(['image', 'action'])
        ->toJson();
        }
        return view('admin.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request, BlogService $blogService)
    {   
        try {
            if($request->ajax() && $request->validated()){
                $blogService->createBlog($request);
                return response()->json([
                    'success' => true,
                    'message' => 'Blog successfully created'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
