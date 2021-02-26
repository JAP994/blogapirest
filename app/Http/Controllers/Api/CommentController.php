<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CommentController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CommentResource::collection(Comment::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        try {
            $comment = new Comment;
            $comment->fill($request->validated())->save();

            return new CommentResource($comment);

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
        $comment = Comment::findOrfail($id);

        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
           $comment = Comment::find($id);
           $comment->fill($request->validated())->save();

           return new CommentResource($comment);

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
        $comment = Comment::findOrfail($id);
        $comment->delete();

        return response()->json(null, 204);
    }
}
