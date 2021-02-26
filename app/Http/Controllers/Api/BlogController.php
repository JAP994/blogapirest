<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BlogController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BlogResource::collection(Blog::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        try {
            $blog = new Blog;
            $blog->fill($request->validated())->save();

            return new BlogResource($blog);

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage}");
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
        $blog = Blog::findOrfail($id);

        return new BlogResource($blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
           $blog = Blog::find($id);
           $blog->fill($request->validated())->save();

           return new BlogResource($blog);

        } catch(\Exception $exception) {
           throw new HttpException(400, "Invalid data - {$exception->getMessage}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrfail($id);
        $blog->delete();

        return response()->json(null, 204);
    }
}
