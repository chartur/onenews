<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/12/20
 * Time: 22:09
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
    /**
     * Returns new post creation page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function newPostView()
    {
        $activePage = 'new_post';
        $categories = Category::get();
        $tags = Tag::get();
        return view('admin.create-new-post')->with(compact('activePage', 'categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hy_content' => Rule::requiredIf($request->hy_title),
            'hy_title' => Rule::requiredIf($request->hy_content),
            'ru_title' => Rule::requiredIf($request->ru_content),
            'ru_content' => Rule::requiredIf($request->ru_title),
            'is_general' => 'required',
            'has_video' => 'required',
            'category_id' => 'required',
            'image' => 'required',
            'tags' => 'required'
        ]);

        $post = new Post();
        if($request->has('post_id') && $request->post_id) {
            $post = Post::find($request->post_id);
            if(!$post) {
                return response()->json(['status' => 'danger', 'message' => 'Փոստը չի գտնվել։'], 404);
            }
        }

        $post->hy_title = trim($request->hy_title);
        $post->hy_content = trim($request->hy_content);
        $post->ru_title = trim($request->ru_title);
        $post->ru_content = trim($request->ru_content);
        $post->image = str_replace(url(''), '', $request->image);
        $post->source = trim($request->source);
        $post->category_id = $request->category_id;
        if($request->is_general && $request->hy_title && $request->hy_content) {
            $post->is_general = 1;
        }
        if($request->is_general && $request->ru_title && $request->ru_content) {
            $post->is_general = 2;
        }
        if($request->is_general && $request->hy_title && $request->hy_content && $request->ru_title && $request->ru_content){
            $post->is_general = 3;
        }
        $post->has_video = $request->has_video;
        $post->hy_description = trim($request->hy_description);
        $post->ru_description = trim($request->ru_description);
        $post->saveOrFail();
        $post->tags()->detach();
        $post->tags()->attach($request->tags);

        $url = createPostLink($post->id, 'hy');
        if($post->ru_title && $post->ru_content) {
            $url = createPostLink($post->id, 'ru');
        }
        if($post->hy_title && $post->hy_content) {
            $url = createPostLink($post->id, 'hy');
        }

        if($post->is_general) {
            if ($post->is_general == 3) {
                Post::where('is_general', '<>', 0)
                ->where('id', '<>', $post->id)
                    ->update(['is_general' => 0]);
            }else{
                Post::where('is_general', 3)
                    ->update(['is_general' => $post->is_general == 1 ? 2 : 1]);

                Post::where('is_general', $post->is_general)
                    ->where('id', '<>', $post->id)
                    ->update(['is_general' => 0]);
            }

        }

        return response()->json([
            'status' => 'success',
            'message' => 'Փոստը հաջողությամբ ստեղծված է։' ,
            'data' => [
                'url' => $url,
                'id' => $post->id
            ]
        ]);
    }

    /**
     * Returns post update template
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function updatePostView(Post $post)
    {
        $activePage = 'post';
        $categories = Category::get();
        $tags = Tag::get();
        $post->load('tags', 'category');
        $url = createPostLink($post->id, 'hy');
        if($post->ru_title && $post->ru_content) {
            $url = createPostLink($post->id, 'ru');
        }
        if($post->hy_title && $post->hy_content) {
            $url = createPostLink($post->id, 'hy');
        }
        return view('admin.edit-post')->with(compact('post','categories','tags','activePage', 'url'));
    }

    /**
     * Returns all posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function lists()
    {
        $activePage = 'all_posts';
        $posts = Post::with('category')
            ->orderByDesc('id')
            ->paginate(20);


        return view('admin.posts-list')->with(compact('activePage', 'posts'));
    }
}