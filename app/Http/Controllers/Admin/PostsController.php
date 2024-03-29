<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/12/20
 * Time: 22:09
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Repos\FacebookArticleRepo;
use App\Models\Adsense;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Parsers\ArmLurParser;
use App\Parsers\BlogNewsParser;
use App\Parsers\IravabanNetParser;
use App\Parsers\LragirParser;
use App\Parsers\NewsAmParser;
use App\Parsers\NewsAmStyle;
use App\Parsers\ShamshyanParser;
use App\Parsers\TertAmParser;
use App\Parsers\HraparakAmParser;
use App\Parsers\NewsAmSportParser;
use App\Parsers\ArajinAmParser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Stichoza\GoogleTranslate\GoogleTranslate;

class PostsController extends Controller
{

    public function __construct()
    {
        app()->setLocale('hy');
    }

    /**
     * Returns new post creation page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function newPostView()
    {
        $activePage = 'new_post';
        $categories = Category::get();
        $tags = Tag::where('type', Tag::TYPE_POST)->get();
        $ads = Adsense::get();
        return view('admin.create-new-post')->with(compact('activePage', 'categories', 'tags', 'ads'));
    }

    /**
     * Returns new post parse and creation page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function newPostParseView()
    {
        $activePage = 'new_post_parse';
        $categories = Category::get();
        $tags = Tag::where('type', Tag::TYPE_POST)->get();
        $ads = Adsense::get();

        $parse_sites = [
            'news.am',
            'news.am - style',
            'news.am - sport',
            'iravaban.net',
            'shamshyan.com',
            'tert.am',
            'hraparak.am',
            'lragir.am',
            'blognews.am',
            'armlur.am',
            '1in.am'
        ];

        $ads = Adsense::get();

        return view('admin.parse-new-post')->with(compact('activePage', 'categories', 'tags', 'ads', 'parse_sites', 'ads'));
    }

    public function getParsedData(Request $request)
    {
        $request->validate([
            'site' => 'required',
            'url' => 'required'
        ]);

        $parse_sites = [
            'news.am' => NewsAmParser::class,
            'news.am - style' => NewsAmStyle::class,
            'news.am - sport' => NewsAmSportParser::class,
            'iravaban.net' => IravabanNetParser::class,
            'shamshyan.com' => ShamshyanParser::class,
            'lragir.am' => LragirParser::class,
            'blognews.am' => BlogNewsParser::class,
            'armlur.am' => ArmLurParser::class,
            'tert.am' => TertAmParser::class,
            'hraparak.am' => HraparakAmParser::class,
            '1in.am' => ArajinAmParser::class
        ];

        if(!isset($parse_sites[$request->site])) {
            return response()->json([
                'message' => 'Անհայտ կայք'
            ], 500);
        }

        $parser = new $parse_sites[$request->site]($request->url);
        return response()->json($parser->getPostData());
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

        $urls = [];
        if($post->ru_title && $post->ru_content) {
            $urls['ru'] = createPostLink($post->id, 'ru');
        }
        if($post->hy_title && $post->hy_content) {
            $urls['hy'] = createPostLink($post->id, 'hy');
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
                'urls' => $urls,
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
        $ads = Adsense::get();
        $activePage = 'post';
        $categories = Category::get();
        $tags = Tag::where('type', Tag::TYPE_POST)->get();
        $post->load('tags', 'category');
        $urls = [];
        if($post->ru_title && $post->ru_content) {
            $urls['ru'] = createPostLink($post->id, 'ru');
        }
        if($post->hy_title && $post->hy_content) {
            $urls['hy'] = createPostLink($post->id, 'hy');
        }
        return view('admin.edit-post')->with(compact('post','categories','tags','activePage', 'urls', 'ads'));
    }

    /**
     * Posts list with DataTable
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function lists(Request $request)
    {

        if ($request->ajax()) {
            $data = Post::with('category');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="/cabinet/posts/update/'. $row->id .'" class="edit btn btn-warning btn-sm mr-2">
                                <i class="fa fa-edit"></i>
                            </a>';
                    $lang = 'hy';
                    if($row->ru_title) {
                        $lang = 'ru';
                    }
                    if($row->hy_title) {
                        $lang = 'hy';
                    }

                    $btn .= '<a href="'. createPostLink($row->id, $lang) .'" target="_blank" class="edit btn btn-primary btn-sm mr-2">
                              <i class="fa fa-eye"></i>
                            </a>';

                    return $btn;
                })
                ->addColumn('source', function($row){
                    return $row->source ? '<span class="text-success d-block text-center" >Ունի հղում</span >'
                                        : '<span class="text-danger d-block text-center" >Չունի հղում</span >';
                })
                ->addColumn('title_ru', function($row){
                    return $row->hy_title ?: $row->ru_title;
                })
                ->addColumn('title', function($row){
                    return $row->hy_title ?: $row->ru_title;
                })
                ->addColumn('image', function($row){

                    $image = '<img src="'. $row->image .'" width="50px">';

                    return $image;
                })
                ->addColumn('langs', function($row) {
                    $langs = '';
                    if ($row->hy_title) {
                        $langs .= '<span class="text-success d-block text-center" > Հայերեն</span >';
                    }
                    if ($row->ru_title){
                        $langs .= '<span class="text-primary d-block text-center" > Ռուսերեն</span >';
                    }

                    return $langs;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->diffForHumans();
                })
                ->rawColumns(['action', 'langs', 'image', 'source'])
                ->make(true);
        }

        $activePage = 'all_posts';
        return view('admin.posts-list')->with(compact('activePage'));
    }

    /**
     * Get post facebook template code
     *
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFacebookArticleCode(Post $post)
    {
        $fb = new FacebookArticleRepo($post, 'hy');
        $content = $fb->createContentHTML();
        return response()->json(compact('content'));
    }

    public function getTranslatedData(Request $request)
    {
        $request->validate([
            'hy_content' => Rule::requiredIf($request->hy_title),
            'hy_title' => Rule::requiredIf($request->hy_content),
        ]);

        $translator = new GoogleTranslate();

        $translated_content = $translator
            ->setSource('hy')
            ->setTarget('ru')
            ->translate($request->hy_content);

        $translated_title = $translator
            ->setSource('hy')
            ->setTarget('ru')
            ->translate($request->hy_title);


        $translated_description = '';

        if($request->hy_description) {
            $translated_description = $translator
                ->setSource('hy')
                ->setTarget('ru')
                ->translate($request->hy_description);
        }
        
            


        return response()->json([
            'status' => 'success',
            'message' => 'Փոստը հաջողությամբ թարգմանված է։' ,
            'data' => [
                'content' => $translated_content,
                'title' => $translated_title,
                'description' => $translated_description
            ]
        ]);
    }
}
