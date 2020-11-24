<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Seo;
use App\Models\Tag;
use Illuminate\Http\Request;

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

        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit(15)
            ->get();

        $aboutSite = Seo::where('slug', 'about')
            ->first();

        $page = Page::where('slug', 'main')
            ->first();

        $seo = Seo::where('slug', 'main')
            ->first();

        $left_place_content = LoaderController::getCategoriesByPlaces('left');
        $right_place_content = LoaderController::getCategoriesByPlaces('right');
        $middle_place_content = LoaderController::getCategoriesByPlaces('middle');
        $general_post_content = LoaderController::getMainPost();

        $aboutSite = getAttributeByLang($aboutSite,'description');

        return view('welcome')->with(compact(
        'categories',
            'tags',
                'aboutSite',
                'seo',
                'page',
                'left_place_content',
                'right_place_content',
                'middle_place_content',
                'general_post_content'
            )
        );
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

        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
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

        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
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
            $q
                ->where($lang.'_title', '<>', '')
                ->where($lang.'_content', '<>', '')
                ->latest();
        }])
        ->withCount('posts')
        ->get()
        ->map(function ($cat) {
            $cat->setRelation('posts', $cat->posts->take(6));
            return $cat;
        });


        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit(15)
            ->get();

        $page = Page::where('slug', 'main')
            ->first();

        $seo = Seo::where('slug', 'main')
            ->first();

        $aboutSite = getAttributeByLang($seo,'description');

        return view('categories')->with(compact('categories','tags','page','seo', 'aboutSite'));
    }

    /**
     * Page of single category
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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

        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit(15)
            ->get();

        $seo = Seo::where('slug', 'main')
            ->first();

        $page = Page::where('slug', 'main')
            ->first();

        $posts = Post::where('category_id', $category->id)
            ->where($lang.'_title', '<>', '')
            ->where($lang.'_content', '<>', '')
            ->orderByDesc('id')
            ->paginate(17);

        $aboutSite = getAttributeByLang($seo,'description');

        $more_posts = Post::where('category_id', '<>', $category->id)
            ->where($lang.'_title', '<>', '')
            ->where($lang.'_content', '<>', '')
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

    /**
     * Page posts where has video
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function videos()
    {
        $lang = app()->getLocale();
        $category = new Category();
        $category->hy_name = trans('main.menu.video.name');
        $category->ru_name = trans('main.menu.video.name');

        if(!$category) {
            abort(404);
        }

        $categories = Category::withCount('posts')
            ->get();

        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit(15)
            ->get();

        $seo = Seo::where('slug', 'main')
            ->first();

        $page = Page::where('slug', 'main')
            ->first();

        $posts = Post::where('has_video', 1)
            ->where($lang.'_title', '<>', '')
            ->where($lang.'_content', '<>', '')
            ->orderBy('id', 'desc')
            ->paginate(17);

        $aboutSite = getAttributeByLang($seo,'description');

        $more_posts = Post::where($lang.'_title', '<>', '')
            ->where($lang.'_content', '<>', '')
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

    /**
     * Search page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        $lang = app()->getLocale();
        if(!$request->has('q') || !$request->q) {
            return redirect()->back();
        }

        $categories = Category::withCount('posts')
            ->get();

        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->limit(15)
            ->get();

        $seo = Seo::where('slug', 'main')
            ->first();

        $page = Page::where('slug', 'main')
            ->first();

        $category = new Category();
        $category->hy_name = trans('main.search');
        $category->ru_name = trans('main.search');

        $query = $request->q;

        $searched_tags = Tag::select('id')
                ->orWhere($lang.'_name', 'like', '%'.$query.'%')
                ->orWhere($lang.'_name', 'like', '%'.$query.'%')
                ->pluck('id');


        $posts = Post::orWhere($lang.'_title', 'like', '%'.$query.'%')
                ->orWhere($lang.'_content', 'like', '%'.$query.'%')
                ->orWhereHas('tags', function ($q) use ($searched_tags){
                    $q->whereIn('tags.id', $searched_tags);
                })
                ->orderBy('id', 'desc')
                ->paginate(20);


        $posts_ids = $posts->getCollection()->pluck('id')->toArray();

        $more_posts = Post::where($lang.'_title', '<>', '')
            ->where($lang.'_content', '<>', '')
            ->whereNotIn('id', $posts_ids)
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $aboutSite = getAttributeByLang($seo,'description');

        return view('category')->with(compact(
        'seo',
            'tags',
                'category',
                'categories',
                'tags',
                'more_posts',
                'page',
                'posts',
                'aboutSite'
            )
        );
    }
}
