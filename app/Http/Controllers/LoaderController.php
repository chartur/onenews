<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/5/20
 * Time: 19:30
 */

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Place;
use App\Models\Post;
use Illuminate\Http\Request;

class LoaderController extends Controller
{

    public static function getMainPost()
    {
        $lang = app()->getLocale();
        $post = Post::where('is_general', 3)->first();
        if($post) {
            return view('components.main-post')->with(compact('post'));
        }
        $generalIndex = $lang == 'hy' ? 1 : 2;
        $post = Post::where('is_general', $generalIndex)->first();
        if(!$post) {
            $post = Post::orderBy('id', 'desc')
                ->where($lang.'_title', '<>', '')
                ->where($lang.'_content', '<>', '')
                ->limit(1)
                ->first();
        }
        return view('components.main-post')->with(compact('post'));
    }

    public static function getCategoriesByPlaces($place)
    {
        $lang = app()->getLocale();
        $places = Place::with('widget')
            ->where('place', $place)
            ->orderBy('ordering', 'asc')
            ->get();

        $html = '';
        foreach ($places as $p) {
            switch($p->widget->type) {
                case 'posts':
                    $category = Category::find($p->data->category_id);
                    $posts = Post::where('category_id', $p->data->category_id)
                        ->where('is_general', 0)
                        ->where($lang.'_title', '<>', '')
                        ->where($lang.'_content', '<>', '')
                        ->orderBy('id', 'desc')
                        ->limit($p->data->post_count)
                        ->get();

                    $html .= view($p->widget->file_url)->with(compact('category', 'posts'))->render();
                    break;
                case 'subscription':
                    $html .= view($p->widget->file_url)->render();
                    break;
                case 'html':
                    $html .= view($p->widget->file_url)->with((array) $p->data)->render();
                    break;
            }

        }

        return $html;
    }

    /**
     * Get news for breaking line
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public static function getBreakingNews()
    {
        $locale = app()->getLocale();
        $langAttr = config('laravellocalization.supportedLocales.'.$locale);
        setLocale(LC_ALL, $langAttr['regional']);
        $date = strftime("%A %d %B %Y");
        $news = Post::orderBy('id', 'desc')
            ->where($locale.'_title', '<>', '')
            ->where($locale.'_content', '<>', '')
            ->limit(15)
            ->get();
        return view('components.breaking-news')->with(compact('news', 'date'));
    }

    /**
     * Get related single post
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function loadSinglePostByType(Request $request)
    {
        $post_type = $request->post_type;
        $category = $request->category;

        $refs = session()->has('ref-float') ? session()->get('ref-float') : [];
        if($request->has('ref-float') && !in_array($request->get('ref-float'), $refs)) {
            $refs[] = $request->get('ref-float');
            session()->put('ref-float', $refs);
        }

        $post = Post::where('category_id', $category)
            ->where('id', '<>', $request->current)
            ->whereNotIn('id', $refs)
            ->orderBy('id', 'desc')
            ->limit(40);


        switch($post_type) {
            case 'popular':
                $post = $post->orderBy('viewed', 'desc');
                break;
            case 'unpopular':
                $post = $post->orderBy('viewed', 'asc');
                break;
            case 'latest':
                $post = $post->orderBy('id', 'desc');
                break;
        }

        $with_ref = $request->current;

        $post = $post->first();

        return view('components.small-post-component')->with(compact('post', 'with_ref'));
    }
}