<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Support\InvalidRequestResponse;
use Exception;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = QueryBuilder::for(Category::class)
                ->allowedFilters(['label', AllowedFilter::exact('id')])
                ->allowedSorts(['id', 'label', 'created_at', 'updated_at'])
                ->allowedIncludes(['transactions', AllowedInclude::count('transactionsCount')])
                ->get();
            return $categories;
        } catch (Exception $e) {
            Log::error($e);
            return InvalidRequestResponse::notAllowed();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {

            $category = QueryBuilder::for(Category::where('id', $category->id))
                ->allowedIncludes(['transactions'])
                ->first();

            return $category;
        } catch (Exception $e) {
            Log::error($e);
            return InvalidRequestResponse::notAllowed();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $category->update($validated);

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
