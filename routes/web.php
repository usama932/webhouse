<?php

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

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/login', 'HomeController@index')->name('login');
Route::get('/artist-login', 'HomeController@artistLogin')->name('artist-login');

Route::get('/artist/register', 'HomeController@artistRegister')->name('artist.register');
Route::post('/artist/register', 'Auth\ArtistLoginController@registration')->name('artist.register.submit');
// Route::get('/sent-notification', 'HomeController@sendNotification')->name('home');



Route::get('/clear',function(){
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});
Route::group([
    'middleware'    => ['auth'],
    'prefix'        => 'user',
    'namespace'     => 'User'
], function ()
{
    Route::get('/dashboard', 'UserController@index')->name('user.dashboard');
    Route::get('/profile-setting', 'UserController@profileSetting')->name('user.profile');
    Route::post('/profile-setting', 'UserController@updateProfile')->name('user.updateprofile');
    Route::get('/cache-clear', 'UserController@configCache')->name('user.cache_clear');
    Route::get('/logout', 'UserController@logout')->name('user.logout');

    Route::get('/notifications', 'UserController@notifications')->name('user.notifications');


    Route::get('/audio-songs', 'SongsController@audio_songs')->name('user.audioSongs');
    Route::post('/audioSongs/search', 'SongsController@audioSearch')->name('audioSongs-search');
    Route::post('/favourAudio/{id}', 'SongsController@favourAudio')->name('audioFavour');


    Route::get('/video-songs', 'SongsController@video_songs')->name('user.videoSongs');
    Route::post('/videoSongs/search', 'SongsController@videoSearch')->name('videoSongs-search');
    Route::post('/favourVideo/{id}', 'SongsController@favourVideo')->name('videoFavour');

    Route::post('/dislike_video/{id}', 'SongsController@dislike_video')->name('dislike_video');
    Route::post('/dislike_audio/{id}', 'SongsController@dislike_audio')->name('dislike_audio');

    Route::get('/videoFavourite-songs', 'SongsController@videoFavourite_songs')->name('videoFavourite-songs');
    Route::get('/audioFavourite-songs', 'SongsController@audioFavourite_songs')->name('audioFavourite-songs');

    Route::get('/category', 'SongsController@category')->name('user.category');
    Route::get('/artist', 'SongsController@artist')->name('user.artist');
    Route::get('/sub_artist', 'SongsController@sub_artist')->name('user.sub_artist');



});
Route::group([
    'middleware'    => ['auth:artist'],
    'prefix'        => 'artist',
    'namespace'     => 'Artist'
], function ()
{
    Route::get('/dashboard', 'ArtistController@index')->name('artist.dashboard');
    Route::get('/profile-setting', 'ArtistController@profileSetting')->name('artist.profile');
    Route::post('/profile-setting', 'ArtistController@updateProfile')->name('artist.updateprofile');

    Route::resource('artist-videos','VideosController');
    Route::post('/videos/search', 'VideosController@search')->name('artist-video-search');
    Route::post('/single-videos/search', 'VideosController@singleSearch')->name('artist-singlevideo-search');

    Route::resource('artist-audios','AudioController');
    Route::post('/audios/search', 'AudioController@search')->name('artist-audio-search');
    Route::post('/single-audios/search', 'AudioController@singleSearch')->name('artist-singleaudio-search');

    Route::resource('artist-albums','AlbumsController');
    Route::post('/albums/search', 'AlbumsController@search')->name('artist-albums-search');

    Route::resource('artist-events','EventsController');
    Route::get('/eventDetail/{id}', 'EventsController@eventDetail')->name('artist.eventDetail');

    

    Route::resource('artist-images','ImagesController');

    Route::resource('artist-subscribers','SubscribersController');
    Route::post('/subscribe/search', 'SubscribersController@subscribeSearch')->name('artist-subscribe-search');
    Route::post('/request/search', 'SubscribersController@requestSearch')->name('artist-request-search');


    Route::post('/UnSubscribe/{id}', 'SubscribersController@unSubscribe')->name('artist-unSubscribe');
    Route::post('/acceptRequest/{id}', 'SubscribersController@accept')->name('artist-acceptRequest');
    Route::post('/rejectRequest/{id}', 'SubscribersController@reject')->name('artist-rejectRequest');

});

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');


});
Route::prefix('artist')->group(function() {
    Route::get('/login', 'Auth\ArtistLoginController@showLoginForm')->name('artist.login');
    Route::post('/login', 'Auth\ArtistLoginController@login')->name('artist.login.submit');
    Route::get('/logout', 'Auth\ArtistLoginController@logout')->name('artist.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\ArtistForgotPasswordController@sendResetLinkEmail')->name('artist.password.email');
    Route::get('/password/reset', 'Auth\ArtistForgotPasswordController@showLinkRequestForm')->name('artist.password.request');
    Route::post('/password/reset', 'Auth\ArtistResetPasswordController@reset')->name('artist.password.update');
    Route::get('/password/reset/{token}', 'Auth\ArtistResetPasswordController@showResetForm')->name('artist.password.reset');


});
Route::group([
    'middleware'    => ['auth:admin'],
    'prefix'        => 'admin',
    'namespace'     => 'Admin'
], function ()
{
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile', 'AdminController@edit')->name('admin-profile');
    Route::post('/admin-update', 'AdminController@update')->name('admin-update');



    //Setting Routes
    Route::resource('setting','SettingController');
    Route::get('/cache-clear', 'AdminController@configCache')->name('admin.cache_clear');

    //User Routes
    Route::resource('users','UsersController');
    Route::get('users/edit/{id}', 'UsersController@edit')->name('admin-edit');
    Route::post('get-users', 'UsersController@getUsers')->name('admin.getUsers');
    Route::post('get-user', 'UsersController@userDetail')->name('admin.getUser');
    Route::get('users/delete/{id}', 'UsersController@destroy')->name('user-delete');
    Route::post('delete-selected-users', 'UsersController@DeleteSelectedUsers')->name('delete-selected-users');
    Route::get('edit-profile/{id}', 'UsersController@show')->name('edit-profile');

    //Artist Routes
    Route::resource('artists','ArtistsController');
    Route::post('get-artists', 'ArtistsController@getUsers')->name('admin.getArtists');
    Route::post('get-artist', 'ArtistsController@userDetail')->name('admin.getArtist');
    Route::get('artists/delete/{id}', 'ArtistsController@destroy')->name('artist-delete');
    Route::get('artists/events/{id}', 'ArtistsController@events')->name('artist-events');
    Route::get('artists/albums/{id}', 'ArtistsController@albums')->name('artist-albums');
    Route::get('artists/audios/{id}', 'ArtistsController@audios')->name('artist-audios');
    Route::get('artists/videos/{id}', 'ArtistsController@videos')->name('artist-videos');
    Route::get('artists/images/{id}', 'ArtistsController@images')->name('artist-images');
    Route::get('artists/event/{id}', 'ArtistsController@event')->name('artist-event');
    Route::get('artist/album/{id}', 'ArtistsController@album')->name('artist-album');
    Route::get('artists/audio/{id}', 'ArtistsController@audio')->name('artist-audio');
    Route::get('artists/video/{id}', 'ArtistsController@video')->name('artist-video');
    Route::get('artists/image/{id}', 'ArtistsController@image')->name('artist-image');
    Route::post('artists-event-status', 'ArtistsController@eventStatus')->name('artist-event-status');
    Route::post('artist-album-status', 'ArtistsController@albumStatus')->name('artist-album-status');
    Route::post('artists-audio-status', 'ArtistsController@audioStatus')->name('artist-audio-status');
    Route::post('artists-video-status', 'ArtistsController@videoStatus')->name('artist-video-status');
    Route::post('artists-image-status', 'ArtistsController@imageStatus')->name('artist-image-status');
    Route::post('delete-selected-artists', 'ArtistsController@DeleteSelectedUsers')->name('delete-selected-artists');

    //Image Routes
    // Route::resource('images','ImagesController');
    // Route::post('get-images', 'ImagesController@getUsers')->name('admin.getImage');
    // Route::post('get-image', 'ImagesController@userDetail')->name('admin.getImages');
    // Route::get('images/delete/{id}', 'ImagesController@destroy')->name('images-delete');
    // Route::post('delete-selected-images', 'ImagesController@DeleteSelectedUsers')->name('delete-selected-images');

    //User Routes
    Route::resource('messages','MessageController');
    Route::get('messages/edit/{id}', 'MessageController@edit')->name('admin.edit_message');
    Route::post('get-messages', 'MessageController@getMessages')->name('admin.getMessages');
    Route::post('get-message', 'MessageController@messageDetail')->name('admin.getMessage');
    Route::get('messages/delete/{id}', 'MessageController@destroy')->name('admin.deleteMessage');
    Route::post('delete-selected-messages', 'MessageController@deleteSelectedMessages')->name('admin.deleteSelectedMessages');

    //Category Routes
    Route::resource('categories','CategoriesController');
    Route::get('categories/edit/{id}', 'CategoriesController@edit')->name('admin-categories-edit');
    Route::post('get-categories', 'CategoriesController@getCategories')->name('admin-getAddedCategories');
    Route::get('categories/delete/{id}', 'CategoriesController@destroy')->name('admin-categories-delete');
    Route::post('delete-selected-categories', 'CategoriesController@DeleteSelectedCategories')->name('delete-selected-categories');
    Route::post('categories/detail', 'CategoriesController@getCategoryDetail')->name('admin-getCategories');

});
