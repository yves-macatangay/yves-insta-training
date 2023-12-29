<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    private $post;
    private $category;

    public function __construct(Post $post, Category $categ){
        $this->post = $post;
        $this->category = $categ;
    }

    public function create(){
        $all_categories = $this->category->all();

        return view('users.posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request){
        $request->validate([
            'category' => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1000',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:1048'
        ]);

        $this->post->user_id = Auth::user()->id;
        $this->post->description = $request->description;
        $this->post->image = 'data:image/' . $request->image->extension() . 
                            ';base64,' . base64_encode(file_get_contents($request->image));
        $this->post->save();

        foreach($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
        }
        $this->post->categoryPosts()->createMany($category_post);

        return redirect()->route('index');
    }

    public function show($id){
        $post_a = $this->post->findOrFail($id);

        return view('users.posts.show')
            ->with('post', $post_a);
    }

    public function edit($id){
        $post_a = $this->post->findOrFail($id);

        if($post_a->user_id != Auth::user()->id){
            return redirect()->route('index');
        }

        $all_categories = $this->category->all();

        $selected_categories = [];
        foreach($post_a->categoryPosts as $category_post){
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.posts.edit')
        ->with('post', $post_a)
        ->with('all_categories', $all_categories)
        ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $id){

        $request->validate([
            'category' => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1000',
            'image' => 'mimes:jpeg,jpg,png,gif|max:1048'
        ]);

        $post_a = $this->post->findOrFail($id);

        $post_a->description = $request->description;

        if($request->image){
            $post_a->image = 'data:image/' . $request->image->extension() . 
                            ';base64,' . base64_encode(file_get_contents($request->image));
        }
        
        $post_a->save();

        $post_a->categoryPosts()->delete();

        foreach($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
        }
        $post_a->categoryPosts()->createMany($category_post);

        return redirect()->route('post.show', $id);
    }

    public function delete($id){
        $this->post->destroy($id);

        return redirect()->route('index');
    }
}
