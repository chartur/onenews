<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use \App\Http\Controllers\PostsController;
use \App\Http\Controllers\LoaderController;

use \App\Http\Controllers\Admin\AdminController;
use \App\Http\Controllers\Admin\WidgetController;
use \App\Http\Controllers\Admin\PostsController as AdminPostsController;
use \App\Http\Controllers\Admin\TagsController;
use \App\Http\Controllers\Admin\PageController;
use \App\Http\Controllers\Admin\AuthController;
use \App\Http\Controllers\Admin\CategoryController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

Route::post('/change-locale', function (){
    $locale = request()->get('locale');
    $referer = request()->headers->get('referer');
    $domain = request()->headers->get('host');
    $segments = explode($domain, $referer);
    $segments = explode('/', $segments[1]);
    unset($segments[0]);
    $segments = array_values($segments);
    $segments[0] = $locale;
    $redirect = implode('/', $segments);
    return redirect()->to("/$redirect");
});

Route::group(['prefix' => 'auth'], function() {
    Route::get('/', [AuthController::class, 'loginPage']);
    Route::post('/try-login', [AuthController::class, 'postLogin']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

// ADMIN
Route::group(['prefix' => 'cabinet', 'middleware' => 'auth'], function (){
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/build', [AdminController::class, 'buildMainPage']);
    Route::post('/save-build', [WidgetController::class, 'saveMainPageStructure']);

    Route::group(['prefix' => 'posts'], function (){
        Route::get('/new', [AdminPostsController::class, 'newPostView']);
        Route::post('/store', [AdminPostsController::class, 'store']);
        Route::get('update/{post}', [AdminPostsController::class, 'updatePostView']);
        Route::get('list', [AdminPostsController::class, 'lists'])->name('posts.list');
        Route::post('instant-article/{post}', [AdminPostsController::class, 'getFacebookArticleCode']);
    });

    Route::group(['prefix' => 'seo'], function (){
       Route::get('/main', [PageController::class, 'getMainPage']);
       Route::get('/about', [PageController::class, 'getAboutPage']);
       Route::get('/contact', [PageController::class, 'getContactUsPage']);
       Route::post('/page-save', [PageController::class, 'savePageData']);
    });

    Route::group(['prefix' => 'tags'], function (){
        Route::post('add-new', [TagsController::class, 'addNewTag']);
        Route::get('search', [TagsController::class, 'adminTagSearch']);
        Route::post('save', [TagsController::class, 'saveTagData']);
        Route::post('delete', [TagsController::class, 'deleteTag']);
        Route::get('list', [TagsController::class, 'lists'])->name('tags.list');
        Route::get('update/{tag}', [TagsController::class, 'updateTagView'])->name('tag.update');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::post('add-new', [CategoryController::class, 'addNewCategory']);
    });
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function() {


    Route::get('/', [MainController::class, 'index']);
    Route::get('/categories', [MainController::class, 'categories']);
    Route::get('/category/{category}', [MainController::class, 'categoryPage']);
    Route::get('/videos', [MainController::class, 'videos']);
    Route::get('/about', [MainController::class, 'about']);
    Route::get('/contact', [MainController::class, 'contactUs']);
    Route::get('/article/{post}', [PostsController::class, 'article']);
    Route::get('/search', [MainController::class, 'search']);

    Route::group(['prefix' => 'posts'], function (){
        Route::get('/wp-data', [PostsController::class, 'getWpData']);
    });

    // POST LOADER
    Route::group(['prefix' => 'loader'], function (){
        Route::get('/main-post', [LoaderController::class, 'getMainPost']);
        Route::get('/breaking-news', [LoaderController::class, 'getBreakingNews']);
        Route::get('/place-loader/{place}', [LoaderController::class, 'getCategoriesByPlaces']);
    });

});



