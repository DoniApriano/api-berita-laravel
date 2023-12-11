<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RootCategoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profilePicture = $user->profile_picture;
        $pageTitle = "Halaman Komentar";

        $category = Category::get();

        return view('admin.category', compact(['profilePicture', 'pageTitle', 'category']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $nama_kategori = $request->name;

        DB::statement('CALL create_category(?)', array($nama_kategori));

        return back()->with('success', 'Berhasil menambah kategori');
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $news = $category->news;

        foreach ($news as $item) {
            $item->delete();
        }

        $category->delete();

        return back()->with('success', 'Berhasil hapus kategori');
    }
}
