<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\GalleryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\InstitutionalController;
use App\Http\Controllers\Front\PageController as FrontPageController;
use App\Http\Controllers\Front\PostController as FrontPostController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Front\TagController as FrontTagController;

// FrontEnd Routes [Public routes]
Route::get('/', [InstitutionalController::class, 'home'])->name('webhome');
Route::get('/sobre-nos', [InstitutionalController::class, 'about'])->name('about');
Route::get('/servicos', [ServiceController::class, 'index'])->name('services');
Route::get('/galeria', [GalleryController::class, 'index'])->name('gallery');
Route::get('/contactos', [ContactController::class, 'index'])->name('contacts');
Route::get('/blog', HomeController::class)->name('blog.index');
Route::post('/post/comment/{post}', [CommentController::class,'makeComment'])->name('post.comment');
Route::resource('/comment', CommentController::class, ['only' => ['destroy']]);
Route::get('/post/{slug}', [FrontPostController::class, 'getPostBySlug'])->name('post.show');
Route::get('/category/{slug}', [FrontCategoryController::class, 'getCategoryBySlug'])->name('category.show');
Route::get('/page/{slug}', [FrontPageController::class, 'getPageBySlug'])->name('page.show');
Route::get('/tag/{slug}', [FrontTagController::class, 'getPostsPerTags'])->name('tag.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
