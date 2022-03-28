<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Http\Requests\BlogRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;

class BlogService {

    public $request;

    public function __construct(BlogRequest $request)
    {
        $this->request = $request;
    }

    public function createBlog($request)
    {
        dd($request->all());
    }
}
