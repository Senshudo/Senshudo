<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(
            Category::where('parent', true)
                ->with('children')
                ->withCount('articles')
                ->get()
        );
    }

    public function show(Category $category)
    {
        return ArticleResource::collection(
            $category->articles()
                ->with('category', 'author', 'review')
                ->where('status', ArticleStatus::PUBLISHED)
                ->orderByDesc('id')
                ->paginate(15)
        );
    }
}
