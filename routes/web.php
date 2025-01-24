<?php

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\TermsConditionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckProfileCreated;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UnsignedPagesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\PendingBlogsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\MailController;


// Cropper.js paketi
// Jodit Texteditor
// mailgun kullanıldı
// cache kullanıldı



Route::controller(ProfileController::class)
    ->middleware('auth_user')
    ->group(function () {
        Route::get('/user/show', 'show')->name('profile.show');
        Route::get('/user/edit', 'edit')->name('profile.edit');
        Route::post('/user/edited', 'edited')->name('profile.edited');
        Route::get('/user/{id}', 'show_others')->name('profile.other.show');
        Route::get('/user/delete/user-image', 'deleteImage')->name('profile.image.deleted');
        Route::get('notifications/{id}/read', 'notification_read_redirect')->name('notification_read_redirect');

        Route::get('user/saved/blogs', 'saved_blogs')->name('saved_blogs');

    });

Route::controller(HomeController::class)
    ->middleware('auth_user')
    ->group(function () {

        Route::get('/home', 'home')->name('home');
        Route::get('email/authenticated-user/contact','contact')->name('logined_user_contact');
        Route::post('email/authenticated-user/contacted','contacted')->name('logined_user_contacted');


        Route::get('notifications/all', 'show_notifications')->name('show_notifications');
        Route::get('users/search-all','users_all')->name('users_all');

        Route::post('myCategory/deleted', 'myCategory_deleted')->name('myCategory.deleted');
        Route::post('myCategory/added', 'myCategory_added')->name('myCategory.added');

        Route::get('category/add/more', 'add_more_categories')->name('add_more_categories');
        Route::post('category/added/more', 'added_more_categories')->name('added_more_categories');

        Route::get('category/select', 'select_category')->name('category.select');
        Route::post('category/selected', 'selected_category')->name('category.selected');

        Route::get('create/profile', 'create_profile')->name('profile.create')->middleware(CheckProfileCreated::class);
        Route::post('created/profile', 'store_profile')->name('profile.store')->middleware(CheckProfileCreated::class);

        Route::get('category/{id}', 'show_blogs')->name('show.blogs');
    });


Route::controller(OAuthController::class)->group(function () {

    Route::get('auth/github/redirect', 'github_redirect')->name('auth_github_redirect');
    Route::get('auth/github/callback', 'github_callback')->name('auth_github_callback');

    Route::get('auth/google/redirect', 'google_redirect')->name('auth_google_redirect');
    Route::get('auth/google/callback', 'google_callback')->name('auth_google_callback');

});

Route::controller(AuthController::class)
    ->group(function () {

        Route::get('delete/user/all', 'delete_user')->name('delete_user_all');
        Route::get('logout', 'logout')->name('logout');

        Route::get('login', 'login')->name('login');
        Route::get('check_profile', 'check_profile')->name('check_profile')->middleware('auth');
        Route::post('login', 'auth_login')->name('auth_login');

        Route::get('register', 'register')->name('register');
        Route::post('register', 'create_user')->name('create_user');

        Route::get('forgot-password', 'forgot')->name('forgot-password');
        Route::post('forgot-password', 'forgot_password')->name('forgot-password-btn');
        Route::get('reset/{token}', 'reset')->name('reset-password');
        Route::post('reset/{token}', 'reset_post')->name('reset-password-btn');

        Route::get('verify/{token}', 'verify')->name('verify');
    });


Route::controller(BlogController::class)
    ->middleware('auth_user')
    ->group(function () {

        Route::get('create/myBlogs', 'create')->name('myBlogs.create');
        Route::post('created/myBlogs', 'store')->name('myBlogs.store');

        Route::get('blogs/{id}', 'show_blogs')->name('blogs.show');

        Route::get('blogs/{id}/edit', 'edit')->name('myBlogs.edit');
        Route::post('blogs/edited', 'edited')->name('myBlogs.edited');

        Route::post('blogs/deleted', 'delete')->name('myBlogs.deleted');
        Route::post('blog/saved', 'saved')->name('blog.saved');
        Route::post('blog/liked', 'liked')->name('blog.liked');

        Route::post('upload/image', 'upload')->name('upload');
        Route::get('blogs/search', 'search_blog')->name('search_blog_in_user');

    });


Route::controller(CommentController::class)
    ->middleware('auth_user')
    ->group(function () {

        Route::post('comment/created', 'created')->name('comment.created');
        Route::post('comment/deleted', 'deletedComment')->name('comment.deleted');
        Route::post('comment/replied', 'reply')->name('comment.replied');
        Route::post('comment/edited', 'edited')->name('comment.edited');
    });


Route::group(['middleware' => 'auth_admin'], function () {

    // Management_pages işlemleri
    Route::controller(AdminController::class)->group(function () {
        Route::get('panel/dashboard', 'dashboard')->name('dashboard');
        Route::get('panel/users', 'users')->name('users');
        Route::get('panel/categories', 'category')->name('categories');
        Route::get('panel/blogs_comments', 'blogs_comments')->name('blogs_comments');
        Route::get('panel/pending-blogs', 'pending_blogs')->name('pending_blogs');
        Route::get('panel/tags', 'tags_list')->name('tags_list');
        Route::get('panel/change_password', 'change_password')->name('change_password');
        Route::post('panel/changed_password', 'changed_password')->name('changed_password');
        Route::get('panel/website/settings', 'site_settings')->name('site_settings');
        Route::post('panel/website/settings/saved', 'save_site_settings')->name('save_site_settings');
    });

    // Management_pages User işlemleri
    Route::controller(UserController::class)->group(function () {
        Route::get('panel/user/add', 'add_user')->name('add-user');
        Route::post('panel/user/added', 'insert_user')->name('added-user');
        Route::get('panel/user/edit/{id}', 'edit_user')->name('edit-user');
        Route::post('panel/user/edited/{id}', 'update_user')->name('edited-user');
        Route::post('panel/user/deleted', 'delete_user')->name('delete-user');
        Route::get('panel/user/Account-Setting', 'AccountSetting')->name('AccountSetting');
        Route::post('panel/user/UpdateAccount-Setting', 'UpdateAccountSetting')->name('UpdateAccountSetting');
    });

    // Management_pages Category işlemleri
    Route::controller(CategoryController::class)->group(function () {
        Route::get('panel/category/add', 'add_category')->name('add-category');
        Route::post('panel/category/added', 'insert_category')->name('added-category');
        Route::get('panel/category/edit/{id}', 'edit_category')->name('edit-category');
        Route::post('panel/category/edited/{id}', 'update_category')->name('edited-category');
        Route::post('panel/category/delete', 'delete_category')->name('delete-category');
    });

    // Management_pages Blog işlemleri
    Route::controller(BlogCommentController::class)->group(function () {
        Route::get('panel/blog/user/{id}', 'list_user_blog')->name('list-user-blog');
        Route::get('panel/blog/search', 'search_blog')->name('search_blog');
        Route::get('panel/blog/add', 'add_blog')->name('add-blog');
        Route::post('panel/blog/added', 'added_blog')->name('added-blog');
        Route::get('panel/blog/detail/{id}', 'detail_blog')->name('detail-blog');
        Route::get('panel/blog/edit/{id}', 'edit_blog')->name('edit-blog');
        Route::post('panel/blog/edited', 'edited_blog')->name('edited-blog');
        Route::post('panel/blog/delete', 'delete_blog')->name('delete-blog');
        Route::post('panel/blog/comment/delete', 'delete_comment')->name('delete-comment');
    });

    // Management_pages Onaylanmamış bloglar işlemleri
    Route::controller(PendingBlogsController::class)->group(function () {
        Route::get('panel/pending-blogs/search', 'search_blog')->name('search_pending_blog');
        Route::get('panel/pending-blogs/detail/{id}', 'detail_blog')->name('detail-pending_blog');
        Route::get('panel/pending-blogs/user/{id}', 'list_user_blog')->name('list-user-pending_blogs');
        Route::post('panel/pending-blogs/confirm', 'confirm_blog')->name('confirm-blog');
        Route::get('panel/pending-blogs/edit/{id}', 'edit_blog')->name('edit-pending_blog');
        Route::post('panel/pending-blogs/edited', 'edited_blog')->name('edited-pending_blog');
        Route::post('panel/pending-blogs/delete', 'delete_blog')->name('delete-pending-blog');
    });

    // TAG İŞLEMLERİ
    Route::controller(TagController::class)->group(function () {
        Route::post('panel/tags/deleted', 'tag_deleted')->name('tag_deleted');
        Route::post('panel/tags/added', 'tag_added')->name('tag_added');
    });

});


// GİRİŞ YAPILMADAN ERİŞİME AÇIK ROUTES

Route::get('/', [UnsignedPagesController::class, 'welcome'])->name('welcome');
Route::get('about', [UnsignedPagesController::class, 'about'])->name('about');
Route::get('blogs', [UnsignedPagesController::class, 'blogs'])->name('blogs');
//Route::get('teams', [UnsignedPagesController::class, 'teams'])->name('teams');
//Route::get('gallery', [UnsignedPagesController::class, 'gallery'])->name('gallery');
Route::get('contact', [UnsignedPagesController::class, 'contact'])->name('contact');


Route::controller(TermsConditionsController::class)->group(function () {
    Route::get('terms-conditions', 'terms')->name('terms-conditions');
    Route::get('privacy-policy', 'privacy')->name('privacy-policy');
});

Route::controller(ErrorController::class)->group(function () {
    Route::get('errors/404', 'error_404')->name('error_404');
});


Route::controller(MailController::class)->group(function(){
    Route::post('email/contact','contact')->name('contact-email');

});
