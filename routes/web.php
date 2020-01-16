<?php
use Illuminate\Http\Request;

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
// Fan-Rideホーム画面
Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

// BMI計算 (練習用)
Route::get('/bmi', 'BmiController@index');
Route::post('/bmi', 'BmiController@calculate');

// 星座占い (宿題)
Route::get('/constellation', 'ConstellationController@index');
Route::get('/constellation/{seiza}', 'ConstellationController@calculate');

// post 募集
Route::get('/post', 'PostController@index');
Route::get('/post/detail/{post_id}', 'PostController@detail');
Route::post('/post/search', 'PostController@search');

Route::get('/welcome', 'HomeController@welcome')->name('home');
// ログインしていないと入れない
Route::group(['middleware' => ['auth']], function () {
    Route::get('post/create', 'PostController@create');
    Route::post('/post/store', 'PostController@store');
    Route::get('/post/edit/{post_id}', 'PostController@edit');
    Route::post('/post/update/{post_id}', 'PostController@update');
    Route::get('/post/delete/{post_id}', 'PostController@delete');
    
    Route::post('/comment/store', 'CommentController@store');
    Route::get('/comment/edit/{comment_id}/{post_id}', 'CommentController@edit');
    Route::post('/comment/update/{comment_id}', 'CommentController@update');
    Route::get('/comment/delete/{comment_id}/{post_id}', 'CommentController@delete');
    
    // Fan-Ride
    Route::get('/home', 'HomeController@index')->name('home');
    // user
    Route::get('/user/edit', 'UserController@edit');
    Route::get('/user/{user_id}', 'UserController@index');
    Route::post('/user/update', 'UserController@update');
    
    // community
    Route::get('/community/register', 'CommunityController@register');
    Route::post('/community/create', 'CommunityController@create');
    Route::get('/community/edit/{community_id}', 'CommunityController@edit');
    Route::post('/community/update/{community_id}', 'CommunityController@update');
    Route::get('/community/delete/{community_id}', 'CommunityController@delete');
    Route::get('/community/copi/register/{community_id}', 'CommunityController@copiRegister');
    Route::get('/community/new', 'CommunityController@new');
    Route::get('/community/popular', 'CommunityController@popular');


    // addAdministrator community
    Route::get('/addAdministrator/{community_id}', 'AddAdministratorController@index');
    Route::post('/addAdministor/create/{community_id}', 'AddAdministratorController@create');
    Route::get('/addAdministor/delete/{community_id}/{user_id}', 'AddAdministratorController@delete');
    // addAdministrator event
    Route::get('/addAdministrator/event/{event_id}', 'AddAdministratorController@eventIndex');
    Route::post('/addAdministor/event/create/{event_id}', 'AddAdministratorController@eventCreate');
    Route::get('/addAdministor/event/delete/{event_id}/{user_id}', 'AddAdministratorController@eventDelete');


    // blackList
    Route::get('/blackList/{community_id}', 'BlackListController@index');
    Route::post('/blackList/create/{community_id}', 'BlackListController@create');
    Route::get('/blackList/delete/{community_id}/{user_id}', 'BlackListController@delete');
    
    // event
    Route::get('/event/edit/{event_id}', 'EventController@edit');
    Route::post('/event/update/{event_id}', 'EventController@update');
    Route::get('/event/register', 'EventController@register');
    Route::post('/event/create', 'EventController@create');
    Route::get('/event/management', 'EventController@management');
    Route::get('/event/delete/{community_id}', 'EventController@delete');
    Route::get('/event/copi/register/{event_id}', 'EventController@copiRegister');
    Route::get('/event/new', 'EventController@new');
    Route::get('/event/popular', 'EventController@popular');

    // Route::get('/community/markdown', 'CommunityController@markdown');
    
    
    
    // -----------API--------------
    Route::post('/markdown/convert', 'MarkdownController@convert');
    Route::post('/calendar/show/{year}/{month}/{user_id}', 'CalendarController@show');
    Route::get('/community/unsubscribe/{community_id}', 'CommunityController@unsubscribe');
    Route::get('/community/subscribe/{community_id}', 'CommunityController@subscribe');
    Route::get('/event/unsubscribe/{event_id}', 'EventController@unsubscribe');
    Route::get('/event/subscribe/{event_id}', 'EventController@subscribe');
    Route::get('/follow/{user_id}', 'FollowController@follow');
    Route::get('/unfollow/{user_id}', 'FollowController@unfollow');
});
// markdown記法ページ
Route::get('/markdown', 'MarkdownController@markdown');

// opinion
Route::post('/opinion', 'OpinionController@opinion');

// maill
Route::get('/mailable', 'TaskController@suspension');

// グループ
Route::get('/community/{community_id}', 'CommunityController@index');


// イベント
Route::get('/event/{event_id}', 'EventController@index');
Route::post('/event/search', 'EventController@search');
Route::post('/event/research', 'EventController@research');

// Route::get('/test/{year}/{month}/{user_id}', 'CalendarController@show');