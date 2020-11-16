<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/5/20
 * Time: 00:17
 */

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Post;
use App\Models\Seo;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class PostsController
{

    public function getWpData()
    {
        //
        $data = DB::connection('mysql2')
            ->select('SELECT id, `post_date` as created_at, `post_content` as hy_content, `post_title` as hy_title FROM `wp_posts`');

        return response()->json($data);
    }

    /**
     * Returns post main page
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function article(Post $post)
    {
        $lang = app()->getLocale();
        $tags = Tag::orderBy('searched', 'desc')
            ->limit(15)
            ->get();
        $categories = Category::withCount('posts')->get();
        $post->load('tags', 'category');

        $aboutSite = Seo::where('slug', 'about')
            ->first();

        $more_posts = Post::where('id', '<>', $post->id)
            ->whereNotNull($lang.'_title')
            ->whereNotNull($lang.'_content')
            ->orderByDesc('id')
            ->limit(10)
            ->get();

        $aboutSite = getAttributeByLang($aboutSite,'description');

        return view('post-page')->with(compact('post', 'categories', 'tags', 'aboutSite', 'more_posts'));
    }
}