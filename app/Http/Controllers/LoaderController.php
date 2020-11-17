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

class LoaderController extends Controller
{

    public function getMainPost()
    {
        $lang = app()->getLocale();
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

    public function getCategoriesByPlaces($place)
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
    public function getBreakingNews()
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
}