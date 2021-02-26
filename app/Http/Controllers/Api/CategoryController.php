<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = new Category;
            $category->fill($request->validated())->save();

            return new CategoryResource($category);
        } catch (\Exception $exception) {
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
        $category = Category::findOrfail($id);

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
            $category = Category::find($id);
            $category->fill($request->validated())->save();

            return new CategoryResource($category);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage}");
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();

        return response()->json(null, 204);
    }
}
