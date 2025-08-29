<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\FrontendController;

Route::get('/', function () {
    return view('home.index');
});
/*...................................................................................... */

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');
/*...................................................................................... */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//logout
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
/*...................................................................................... */

//profile data
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/profile/store', [AdminController::class, 'ProfileStore'])->name('profile.store');
    Route::post('/admin/password/update', [AdminController::class, 'PasswordUpdate'])->name('admin.password.update');

});
/*...................................................................................... */
//home page
Route::middleware('auth')->group(function () {
//review data
Route::controller(ReviewController::class)->group(function(){
    Route::get('/all/review', 'AllReview')->name('all.review');

    Route::get('/add/review', 'AddReview')->name('add.review');
    Route::post('/store/review', 'StoreReview')->name('store.review');

    Route::get('/edit/review/{id}', 'EditReview')->name('edit.review');
    Route::post('/update/review', 'UpdateReview')->name('update.review');

    Route::get('/delete/review/{id}', 'DeleteReview')->name('delete.review');
});
/*...................................................................................... */

//slider,feature,review and answer data
Route::controller(SliderController::class)->group(function(){
    Route::get('/get/slider', 'GetSlider')->name('get.slider');
    Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
    Route::post('/edit-slider/{id}', 'EditSlider');
    Route::post('/edit-features/{id}', 'EditFeatures');
    Route::post('/edit-reviews/{id}', 'EditReview');
    Route::post('/edit-answers/{id}', 'EditAnswers');
});
/*...................................................................................... */

//feature data
Route::controller(HomeController::class)->group(function(){
    Route::get('/all/feature', 'AllFeature')->name('all.feature');

    Route::get('/add/feature', 'AddFeature')->name('add.feature');
    Route::post('/store/feature', 'StoreFeature')->name('store.feature');

    Route::get('/edit/feature/{id}', 'EditFeature')->name('edit.feature');
    Route::post('/update/feature', 'UpdateFeature')->name('update.feature');

    Route::get('/delete/feature/{id}', 'DeleteFeature')->name('delete.feature');
});

/*...................................................................................... */

//clarifies data
Route::controller(HomeController::class)->group(function(){
    Route::get('/get/clarifies', 'GetClarifies')->name('get.clarifies');
    Route::post('/update/clarify', 'UpdateClarify')->name('update.clarify');
});

/*...................................................................................... */

//financial data
Route::controller(HomeController::class)->group(function(){
    Route::get('/get/financial', 'GetFinancial')->name('get.financial');
    Route::post('/update/financial', 'UpdateFinancial')->name('update.financial');
});
/*...................................................................................... */

//usability
Route::controller(HomeController::class)->group(function(){
    Route::get('/get/usability', 'GetUsability')->name('get.usability');
    Route::post('/update/usability', 'UpdateUsability')->name('update.usability');
});
/*...................................................................................... */

//usability data
Route::controller(HomeController::class)->group(function(){
    Route::get('/all/connect', 'AllUsabilityConnect')->name('all.connect');

    Route::get('/add/connect', 'AddUsabilityConnect')->name('add.connect');
    Route::post('/store/connect', 'StoreUsabilityConnect')->name('store.connect');

    Route::get('/edit/connect/{id}', 'EditUsabilityConnect')->name('edit.connect');
    Route::post('/update/connect', 'UpdateUsabilityConnect')->name('update.connect');

    Route::get('/delete/connect/{id}', 'DeleteUsabilityConnect')->name('delete.connect');

    Route::post('/update-connect/{id}', 'UpdateConnect');
});
/*...................................................................................... */

//faqs
Route::controller(HomeController::class)->group(function(){
    Route::get('/all/faqs', 'AllFaqs')->name('all.faqs');

    Route::get('/add/faqs', 'AddFaqs')->name('add.faqs');
    Route::post('/store/faqs', 'StoreFaqs')->name('store.faqs');

    Route::get('/edit/faqs/{id}', 'EditFaqs')->name('edit.faqs');
    Route::post('/update/faqs', 'UpdateFaqs')->name('update.faqs');

    Route::get('/delete/faqs/{id}', 'DeleteFaqs')->name('delete.faqs');
});
/*...................................................................................... */

//apps
Route::controller(HomeController::class)->group(function(){
    Route::post('/update-app/{id}', 'UpdateApps');
    Route::post('/upload-app-image/{id}', 'UpdateAppsImage');
});

});
/*...................................................................................... */

//our team page
Route::get('/team', [FrontendController::class, 'OurTeam'])->name('our.team');

Route::middleware('auth')->group(function () {
    //route for insert,delete,edit team's data
    Route::controller(TeamController::class)->group(function(){
        Route::get('/all/team', 'AllTeam')->name('all.team');

        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/store/team', 'StoreTeam')->name('store.team');

        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/update/team', 'UpdateTeam')->name('update.team');

        Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');
    });

});
/*...................................................................................... */


//our about-us page
Route::get('/about-us', [FrontendController::class, 'AboutUs'])->name('about.us');

Route::middleware('auth')->group(function () {
    //route for data in about page
    Route::controller(FrontendController::class)->group(function(){
        Route::get('/get/aboutus', 'GetAboutUs')->name('get.aboutus');
        Route::post('/update/aboutus', 'UpdateAboutUs')->name('update.about');
    });

});
/*...................................................................................... */

//our Blog page
Route::get('/blog', [FrontendController::class, 'BlogPage'])->name('blog.page');
Route::get('/blog/details/{slug}', [FrontendController::class, 'BlogDetails']);
Route::get('/blog/category/{id}', [FrontendController::class, 'BlogCategory']);//لعرض البوست الخاصه ب كاتوجري معينه

Route::middleware('auth')->group(function () {
    //routes for data in blog page
    Route::controller(BlogController::class)->group(function(){
        Route::get('/blog/category', 'BlogCategory')->name('all.blog.category');

        Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');

        Route::get('/edit/blog/category/{id}', 'EditBlogCategory');

        Route::post('/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');

        Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
        /*...................................................................................... */

        //routes for posts in blog page
        Route::get('/all/blog/post', 'AllBlogPost')->name('all.blog.post');

        Route::get('/add/blog/post', 'AddBlogPost')->name('add.blog.post');
        Route::post('/store/blog/post', 'StoreBlogPost')->name('store.blog.post');

        Route::get('/edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post');
        Route::post('/update/blog/post', 'UpdateBlogPost')->name('update.blog.post');

        Route::get('/delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');


    });

});