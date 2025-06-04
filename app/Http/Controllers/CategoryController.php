<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(
            Category::query()->where('parent', true)
                ->with('children')
                ->withCount('articles')
                ->get()
        );
    }

    public function show(Category $category): AnonymousResourceCollection
    {
        return ArticleResource::collection(
            $category->articles()
                ->with('categories', 'author', 'review')
                ->where('status', ArticleStatus::PUBLISHED)
                ->orderByDesc('id')
                ->paginate(15)
        );
    }
}
