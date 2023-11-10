<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('news')->get();
        foreach ($categories as $category) {
            $news = News::where('category_id', $category['id'])->get();
        }
        return new CategoryResource(true, 'Berhasil fetch', $categories);
    }
}
