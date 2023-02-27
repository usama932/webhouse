<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'Api\ArtistController@register');
Route::post('/login', 'Api\ArtistController@login');
Route::get('get-categories', 'Api\ArtistController@categories');
Route::get('all-video', 'Api\ArtistController@allVideo')->middleware('auth:api');
Route::get('user-video', 'Api\ArtistController@userVideo')->middleware('auth:api');
Route::get('all-audio', 'Api\ArtistController@allAudio')->middleware('auth:api');
Route::get('user-audio', 'Api\ArtistController@userAudio')->middleware('auth:api');
Route::get('all-event', 'Api\ArtistController@allEvent')->middleware('auth:api');
Route::get('user-event', 'Api\ArtistController@userEvent')->middleware('auth:api');
Route::get('all-album', 'Api\ArtistController@allAlbum')->middleware('auth:api');
Route::get('all-artist', 'Api\ArtistController@allArtist')->middleware('auth:api');
Route::get('all-favorate-audio', 'Api\ArtistController@allFavAudio')->middleware('auth:api');
Route::get('all-favorate-event', 'Api\ArtistController@allFavEvent')->middleware('auth:api');
Route::get('all-favorate-video', 'Api\ArtistController@allFavVideo')->middleware('auth:api');
Route::get('all-subscribe-artist', 'Api\ArtistController@allFavArtist')->middleware('auth:api');
Route::post('subscribe-artist', 'Api\ArtistController@subscribeArtist')->middleware('auth:api');
Route::post('favrate-audio', 'Api\ArtistController@favrateAudio')->middleware('auth:api');
Route::post('favrate-video', 'Api\ArtistController@favrateVideo')->middleware('auth:api');
Route::post('favrate-event', 'Api\ArtistController@favrateEvent')->middleware('auth:api');
Route::post('update-user-profile', 'Api\ArtistController@updateUserProfile')->middleware('auth:api');
Route::post('update-user-token', 'Api\ArtistController@updateToken')->middleware('auth:api');
Route::post('room-list', 'Api\ArtistController@roomList')->middleware('auth:api');


Route::post('video-search-artist', 'Api\ArtistController@videoSearchArtist')->middleware('auth:api');
Route::post('video-search-name', 'Api\ArtistController@videoSearchName')->middleware('auth:api');
Route::post('video-search-name-category', 'Api\ArtistController@videoSearchNameCat')->middleware('auth:api');
Route::post('video-search-category', 'Api\ArtistController@videoSearchCategory')->middleware('auth:api');
Route::post('video-search-user-album', 'Api\ArtistController@videoSearchUserAlbum')->middleware('auth:api');
Route::post('audio-search-artist', 'Api\ArtistController@audioSearchArtist')->middleware('auth:api');
Route::post('audio-search-name', 'Api\ArtistController@audioSearchName')->middleware('auth:api');
Route::post('audio-search-name-category', 'Api\ArtistController@audioSearchNameCat')->middleware('auth:api');
Route::post('audio-search-category', 'Api\ArtistController@audioSearchCategory')->middleware('auth:api');
Route::post('audio-search-user-album', 'Api\ArtistController@audioSearchUserAlbum')->middleware('auth:api');
Route::post('all-event-search', 'Api\ArtistController@allEventSearch')->middleware('auth:api');

Route::get('user-index', 'Api\ArtistController@index')->middleware('auth:api');


Route::post('/artist-register', 'Api\ArtistController@registerArtist');





Route::post('/artist-login', 'Api\ArtistController@artistLogin');
Route::get('artist-index', 'Api\ArtistController@index')->middleware('auth:artist-api');
Route::get('album-list', 'Api\ArtistController@albumList')->middleware('auth:artist-api');
Route::post('album-save', 'Api\ArtistController@albumSave')->middleware('auth:artist-api');
Route::post('album-update', 'Api\ArtistController@albumUpdate')->middleware('auth:artist-api');
Route::post('album-delete', 'Api\ArtistController@albumDelete')->middleware('auth:artist-api');
Route::get('video-list', 'Api\ArtistController@videoList')->middleware('auth:artist-api');
Route::post('video-search', 'Api\ArtistController@videoSearch')->middleware('auth:artist-api');
Route::post('video-search-album', 'Api\ArtistController@videoSearchAlbum')->middleware('auth:artist-api');

Route::post('video-save', 'Api\ArtistController@videoSave')->middleware('auth:artist-api');
Route::post('video-delete', 'Api\ArtistController@videoDelete')->middleware('auth:artist-api');
Route::get('audio-list', 'Api\ArtistController@audioList')->middleware('auth:artist-api');
Route::post('audio-search', 'Api\ArtistController@audioSearch')->middleware('auth:artist-api');
Route::post('audio-search-album', 'Api\ArtistController@audioSearchAlbum')->middleware('auth:artist-api');
Route::post('audio-save', 'Api\ArtistController@audioSave')->middleware('auth:artist-api');
Route::post('audio-delete', 'Api\ArtistController@audioDelete')->middleware('auth:artist-api');
Route::get('image-list', 'Api\ArtistController@imageList')->middleware('auth:artist-api');
Route::post('image-save', 'Api\ArtistController@imageSave')->middleware('auth:artist-api');
Route::post('image-delete', 'Api\ArtistController@imageDelete')->middleware('auth:artist-api');
Route::get('event-list', 'Api\ArtistController@eventList')->middleware('auth:artist-api');
Route::post('event-save', 'Api\ArtistController@eventSave')->middleware('auth:artist-api');
Route::post('event-delete', 'Api\ArtistController@eventDelete')->middleware('auth:artist-api');
Route::post('update-profile', 'Api\ArtistController@updateProfile')->middleware('auth:artist-api');
Route::get('subscribe-users', 'Api\ArtistController@subscribeUsers')->middleware('auth:artist-api');
Route::get('subscribe-users-delete', 'Api\ArtistController@subscribeUsersDelete')->middleware('auth:artist-api');
Route::post('subscribe-users-status', 'Api\ArtistController@subscribeUsersStatus')->middleware('auth:artist-api');
Route::get('album-video', 'Api\ArtistController@albumVideo')->middleware('auth:artist-api');
Route::get('album-audio', 'Api\ArtistController@albumAudio')->middleware('auth:artist-api');
Route::post('update-artist-token', 'Api\ArtistController@updateTokenArtist')->middleware('auth:artist-api');
Route::post('add-room', 'Api\ArtistController@addRoom')->middleware('auth:artist-api');
Route::post('room-delete', 'Api\ArtistController@roomDelete')->middleware('auth:artist-api');


Route::post('add-videoComment', 'Api\VideoCommentController@store')->middleware('auth:api');
Route::post('add-ArtistvideoComment', 'Api\VideoCommentController@artistVideoComment')->middleware('auth:artist-api');


Route::post('add-videoLike', 'Api\VideoLikeController@store')->middleware('auth:api');
Route::post('add-ArtistvideoLike', 'Api\VideoLikeController@artistVideoLike')->middleware('auth:artist-api');


Route::post('add-audioComment', 'Api\AudioCommentController@store')->middleware('auth:api');
Route::post('add-ArtistaudioComment', 'Api\AudioCommentController@artistAudioComment')->middleware('auth:artist-api');

Route::post('get-videoComment', 'Api\VideoCommentController@index')->middleware('auth:api');
Route::post('get-audioComment', 'Api\AudioCommentController@index')->middleware('auth:api');

Route::post('get-ArtistvideoComment', 'Api\VideoCommentController@index')->middleware('auth:artist-api');
Route::post('get-ArtistaudioComment', 'Api\AudioCommentController@index')->middleware('auth:artist-api');


Route::post('add-audioLike', 'Api\AudioLikeController@store')->middleware('auth:api');
Route::post('add-ArtistaudioLike', 'Api\AudioLikeController@artistAudioLike')->middleware('auth:artist-api');


Route::post('add-profileViewer', 'Api\ProfileViewerController@store')->middleware('auth:api');

Route::get('get-TopArtists', 'Api\ArtistController@get_top_artists')->middleware('auth:api');

Route::post('get-videolikesComment', 'Api\VideoCommentController@VideolikesComment')->middleware('auth:api');
Route::post('get-audiolikesComment', 'Api\AudioCommentController@AudiolikesComment')->middleware('auth:api');

Route::post('get-ArtistvideolikesComment', 'Api\VideoCommentController@ArtistVideolikesComment')->middleware('auth:artist-api');
Route::post('get-ArtistaudiolikesComment', 'Api\AudioCommentController@ArtistAudiolikesComment')->middleware('auth:artist-api');
