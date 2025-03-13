<?php
use App\Http\Controllers\Admin\DashboardController; 
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTagController;
use App\Http\Controllers\CMSPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GrowWithTripTrackController;
use App\Http\Controllers\CollectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;  
use App\Models\User;
use Illuminate\Support\Facades\URL;
use App\Models\UserTag;
use Carbon\Carbon;



                                                             /**
                                                             * Website Routes
                                                             */


Route::get('/generate-tags/{qty}', [UserTagController::class, 'generateTags'])->name('generateTags');
Route::get('/scan/{id}', [UserTagController::class, 'scanResult'])->name('scanResult');
Route::get('bag-details/{tag_id}', [UserTagController::class, 'bagDetails'])->name('bag-details');
Route::post('/update-tag', [UserTagController::class, 'updateTagOperation'])->name('update_tag.operation');


// Auth Routes
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/signUp/{id?}', [UserController::class, 'signUp'])->name('register.view');
Route::post('/register', [UserController::class, 'registerOperation'])->name('register.operation');
Route::post('/scan_with_register', [UserController::class, 'scanWithRegisterOperation'])->name('scan_with_register.operation');

Route::get('/user-email/verify', [UserController::class, 'verifyEmail'])->name('user-email.verify');

Route::post('/login', [UserController::class, 'loginOperation'])->name('login.operation');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::find($id);
    if ($user) {
        Auth::login($user);

        if($user->user_status  == 'active'){
            return redirect()->route('home')->with('success', 'Your email is already verified');
        }

        $user->update(['user_status' => 'active']);
        return redirect()->route('home')->with('success', 'Your email has been verified, and your account is now active.');

    
    } else {
        return redirect()->route('login')->with('error', 'User not found.');
    }
})->middleware('signed')->name('verification.verify');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');


// cms pages
Route::get('/collection/page/{type}', [CMSPageController::class, 'collectionView'])->name('collection');
Route::post('/contact-us/opration', [CMSPageController::class, 'contactUsOpration'])->name('contact-us.operation');
Route::post('/grow-with-triptrack-register.operation', [GrowWithTripTrackController::class, 'register'])->name('/grow-with-triptrack-register.operation');


Route::get('/', [HomeController::class, 'dashboard'])->name('home');


// Authenticated & Verified Routes
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user-dashboard');

    Route::get('tag/status/{id}/{status}', [UserTagController::class, 'changeTagStatus'])->name('tag.status');

});


// Products 
Route::get('/collection/{type}/{slug?}', [CollectionController::class, 'collection']);


// QR Code & Tag Routes
Route::get('/customize-tag', function () {
    return view('website.customize-tag');
});
Route::post('/generate-tag-pdf', [QRCodeController::class, 'generatePDF']);
Route::post('/generate-preview', [QRCodeController::class, 'generatePreview']);
Route::get('/scan-redirect', [QRCodeController::class, 'handleScan']);

// File Upload & QR Code Processing Routes
Route::get('/upload', [QRCodeController::class, 'showUploadForm'])->name('upload.form');
Route::post('/generate-qrcodes', [QRCodeController::class, 'generateMultipleQRCodes'])->name('generate.qrcodes');
Route::post('/found-item', [QRCodeController::class, 'processFoundItem'])->name('found.item');
Route::get('/found-item', function () {
    abort(404);
});
Route::post('/send-location-email', [UserTagController::class, 'sendLocationEmail']);

Route::get('/get-location', [QRCodeController::class, 'getLocation']);

// Example Module Routes
Route::get('/location-map', function () {
    return view('location-map');
});



                                                            /**
                                                             * Admin Panel Routes
                                                             */

Route::get('/admin/login', [DashboardController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [DashboardController::class, 'loginOperation'])->name('admin.login.operation');

Route::prefix('admin')->middleware('admin')->group(function () {

  
    Route::get('logout', [DashboardController::class, 'logout'])->name('admin.logout');

    Route::get('/genrate-new-qr', [DashboardController::class, 'genrateNewQr'])->name('admin.genrate-new-qr');

    Route::post('/generate-qrcodes', [DashboardController::class, 'generateTags'])->name('admin.generate.qrcodes');


    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('product-categories', ProductCategoryController::class);

    Route::resource('products', ProductController::class);
    Route::get('/product-images/{id}', [ProductController::class, 'destroyImage'])->name('admin.product_images.destroyimage');



});

