<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    private $category;
    private $post;

    public function __construct(Category $category, Post $post){
        $this->category = $category;
        $this->post = $post;
    }

    public function index(){
        $all_categories = $this->category->orderBy('updated_at', 'desc')->paginate(10);

        $uncategorized_count = 0;
        $all_posts = $this->post->all();
        foreach($all_posts as $p){
            if($p->categoryPost->count() == 0){
                $uncategorized_count++;
            }
        }

        return view('admin.categories.index')
        ->with('all_categories', $all_categories)
        ->with('uncategorized_count', $uncategorized_count);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:1|max:50|unique:categories,name'
        ]);

        $this->category->name = ucwords(strtolower($request->name));
        $this->category->save();

        return redirect()->back();
    }

    public function update(Request $request, $id){
        $request->validate([
            'new_name' => 'required|min:1|max:50|unique:categories,name,'.$id
        ]);

        $categ = $this->category->findOrFail($id);
        $categ->name = ucwords(strtolower($request->new_name));
        $categ->save();

        return redirect()->back();
    }

    public function destroy($id){
        $this->category->destroy($id);
        return redirect()->back();
    }
}
