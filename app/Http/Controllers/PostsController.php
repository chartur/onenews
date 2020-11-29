<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/5/20
 * Time: 00:17
 */

namespace App\Http\Controllers;


use App\Http\Repos\FacebookArticleRepo;
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
     * @param int $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function article($post_id)
    {
        $main_post = Post::with('tags', 'category')->find($post_id);
        if(!$main_post) {
            abort(404);
        }

        $lang = app()->getLocale();

        if(!$main_post->{$lang.'_title'} && !$main_post->{$lang.'_content'}){
            return redirect()->to('/');
        }

        $tags = Tag::orderBy('searched', 'desc')
            ->limit(15)
            ->get();
        $categories = Category::withCount('posts')->get();

        $aboutSite = Seo::where('slug', 'about')
            ->first();

        $more_posts = Post::where('id', '<>', $main_post->id)
            ->where($lang.'_title', '<>', '')
            ->where($lang.'_content', '<>', '')
            ->whereHas('tags', function ($q) use ($main_post) {
                return $q->whereIn('tags.id', $main_post->tags->pluck('id'));
            })
            ->orderByDesc('id')
            ->limit(11)
            ->get();

        $floating_post = $more_posts->sortByDesc('viewed')->first();

        $aboutSite = getAttributeByLang($aboutSite,'description');

        return view('post-page')->with(compact('main_post', 'categories', 'tags', 'aboutSite', 'more_posts', 'floating_post'));
    }
}