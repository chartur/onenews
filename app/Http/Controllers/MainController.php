<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Seo;
use App\Models\Tag;

class MainController extends Controller
{
    /**
     * Main page of website
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::withCount('posts')
            ->get();

        $tags = Tag::orderBy('searched', 'desc')
            ->limit(15)
            ->get();

        $aboutSite = Seo::where('slug', 'about')
            ->first();

        $page = Page::where('slug', 'main')
            ->first();

        $seo = Seo::where('slug', 'main')
            ->first();

        $aboutSite = getAttributeByLang($aboutSite,'description');

        return view('welcome')->with(compact('categories', 'tags', 'aboutSite', 'seo', 'page'));
    }

    /**
     * Returns about page template
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function about()
    {
        $categories = Category::withCount('posts')
            ->get();

        $tags = Tag::orderBy('searched', 'desc')
            ->limit(15)
            ->get();

        $page = Page::where('slug', 'about')
            ->first();

        $seo = Seo::where('slug', 'about')
            ->first();

        $aboutSite = getAttributeByLang($seo,'description');

        return view('about')->with(compact('categories', 'tags', 'seo', 'page', 'aboutSite'));
    }

    /**
     * Returns contact us template
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function contactUs()
    {
        $categories = Category::withCount('posts')
            ->get();

        $tags = Tag::orderBy('searched', 'desc')
            ->limit(15)
            ->get();

        $page = Page::where('slug', 'contact')
            ->first();

        $seo = Seo::where('slug', 'contact')
            ->first();

        $aboutSite = getAttributeByLang($seo,'description');

        return view('contact-us')->with(compact('categories', 'tags', 'seo', 'page', 'aboutSite'));
    }

    /**
     * Returns all categories template
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function categories()
    {
        $lang = app()->getLocale();
        $categories = Category::with(['posts' => function($q) use ($lang){
            $q->whereNotNull($lang.'_title')->whereNotNull($lang.'_content')->latest();
        }])
        ->withCount('posts')
        ->get()
        ->map(function ($cat) {
            $cat->setRelation('posts', $cat->posts->take(6));
            return $cat;
        });


        $tags = Tag::orderBy('searched', 'desc')
            ->limit(15)
            ->get();

        $page = Page::where('slug', 'main')
            ->first();

        $seo = Seo::where('slug', 'main')
            ->first();

        $aboutSite = getAttributeByLang($seo,'description');

        return view('categories')->with(compact('categories','tags','page','seo', 'aboutSite'));
    }

    public function categoryPage($slug)
    {
        $lang = app()->getLocale();
        $category = Category::where('slug', $slug)
            ->first();

        if(!$category) {
            abort(404);
        }

        $categories = Category::withCount('posts')
            ->get();

        $tags = Tag::orderBy('searched', 'desc')
            ->limit(15)
            ->get();

        $seo = Seo::where('slug', 'main')
            ->first();

        $page = Page::where('slug', 'main')
            ->first();

        $posts = Post::where('category_id', $category->id)
            ->whereNotNull($lang.'_title')
            ->whereNotNull($lang.'_content')
            ->paginate(17);

        $aboutSite = getAttributeByLang($seo,'description');

        $more_posts = Post::where('category_id', '<>', $category->id)
            ->whereNotNull($lang.'_title')
            ->whereNotNull($lang.'_content')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('category')->with(compact(
        'category',
             'posts',
                'page',
                'seo',
                'aboutSite',
                'categories',
                'tags',
                'more_posts'
            )
        );
    }
}
