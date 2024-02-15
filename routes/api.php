<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsersPostController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication routes


Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('login');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

//////////////Posts routes///////////////////////////////////////////////////

Route::apiResources([
   
     'posts' =>PostController::class,
    "categories"=>CategoryController::class
]);

Route::apiResource("users/posts",UsersPostController::class)->scoped([
    "post"=>"slug"
]);


 Route::post("/posts/update/{post}",[PostController::class,"update"]);
 Route::post("/content/update/{post_content}",[PostController::class,"update"])->name('content.update');
 Route::post("/content",[PostController::class,"storePostContent"])->name('content.store');
 Route::post('/content_image/{post}',[PostController::class,'storeContentImage'])->name('content_image.store');


