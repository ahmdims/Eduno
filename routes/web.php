<?php

use App\Http\Controllers\Admin\AdminAdminController;
use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\CourseAdminController;
use App\Http\Controllers\Admin\FaqAdminController;
use App\Http\Controllers\Admin\MailAdminController;
use App\Http\Controllers\Admin\MaterialAdminController;
use App\Http\Controllers\Admin\QuizAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\WebsiteAdminController;
use App\Http\Controllers\App\ArticleAppController;
use App\Http\Controllers\App\ContactAppController;
use App\Http\Controllers\App\CourseAppController;
use App\Http\Controllers\App\FaqAppController;
use App\Http\Controllers\App\HomeAppController;
use App\Http\Controllers\App\ProfileAppController;
use App\Http\Controllers\App\QuizzesAppController;
use App\Http\Controllers\App\WebsiteAppController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile/setting', [ProfileAppController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileAppController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileAppController::class, 'destroy'])->name('profile.destroy');
});

//Dashboard
Route::get('/profile/{username}', [ProfileAppController::class, 'index'])->name('profile.index');

//Home
Route::get('/', [HomeAppController::class, 'index'])->name('home');

// Course
Route::get('/course', [CourseAppController::class, 'index'])->name('courses.index');
Route::middleware('auth')->group(function () {
    Route::post('/course/{slug}/review', [CourseAppController::class, 'storeReview'])->name('course.storeReview');
    Route::get('/course/{slug}', [CourseAppController::class, 'show'])->name('course.show');
    Route::get('/course/{slug}/material/{material}', [CourseAppController::class, 'showMaterial'])->name('materials.show');

    Route::get('/course/{slug}/quiz/{quiz}', [CourseAppController::class, 'showQuiz'])->name('quiz.show');
    Route::post('/course/{slug}/quiz/submit/{quiz}', [QuizzesAppController::class, 'submitQuiz'])->name('quiz.submit');
    Route::get('/course/{slug}/quiz/result/{quiz}', [QuizzesAppController::class, 'result'])->name('quiz.result');
});

//Article
Route::get('/article', [ArticleAppController::class, 'index'])->name('article.index');
Route::get('/article/{slug}', [ArticleAppController::class, 'show'])->name('article.show');

//Faq
Route::get('/faq', [FaqAppController::class, 'index'])->name('app.faq.index');

//Contact
Route::get('/contact', [WebsiteAppController::class, 'index'])->name('app.contact.index');
Route::post('/mail', [ContactAppController::class, 'store'])->name('app.mail.store');

// Admin
Route::middleware(['auth'])->group(function () {

    // Course
    Route::get('/admin/course', [CourseAdminController::class, 'index'])->name('admin.course.index');
    Route::post('/admin/course', [CourseAdminController::class, 'store'])->name('admin.course.store');
    Route::get('/admin/course/create', [CourseAdminController::class, 'create'])->name('admin.course.create');
    Route::get('/admin/course/{slug}/edit', [CourseAdminController::class, 'edit'])->name('admin.course.edit');
    Route::put('/admin/course/{slug}', [CourseAdminController::class, 'update'])->name('admin.course.update');
    Route::delete('/admin/course/{id}', [CourseAdminController::class, 'destroy'])->name('admin.course.destroy');

    // Material
    Route::post('/admin/material', [MaterialAdminController::class, 'store'])->name('admin.material.store');
    Route::get('/admin/material/{slug}/edit', [MaterialAdminController::class, 'edit'])->name('admin.material.edit');
    Route::put('/admin/material/{id}', [MaterialAdminController::class, 'update'])->name('admin.material.update');
    Route::delete('/admin/material/{id}', [MaterialAdminController::class, 'destroy'])->name('admin.material.destroy');

    // Quiz Routes
    Route::get('/admin/quiz', [QuizAdminController::class, 'index'])->name('admin.quiz.index');
    Route::post('/admin/quiz', [QuizAdminController::class, 'store'])->name('admin.quiz.store');
    Route::get('/admin/quiz/create', [QuizAdminController::class, 'create'])->name('admin.quiz.create');
    Route::get('/admin/quiz/{id}/edit', [QuizAdminController::class, 'edit'])->name('admin.quiz.edit');
    Route::put('/admin/quiz/{id}', [QuizAdminController::class, 'update'])->name('admin.quiz.update');
    Route::delete('/admin/quiz/{id}', [QuizAdminController::class, 'destroy'])->name('admin.quiz.destroy');

    // Article
    Route::get('/admin/article', [ArticleAdminController::class, 'index'])->name('admin.article.index');
    Route::post('/admin/article', [ArticleAdminController::class, 'store'])->name('admin.article.store');
    Route::get('/admin/article/{slug}/edit', [ArticleAdminController::class, 'edit'])->name('admin.article.edit');
    Route::get('/admin/article/create', [ArticleAdminController::class, 'create'])->name('admin.article.create');
    Route::put('/admin/article/{id}', [ArticleAdminController::class, 'update'])->name('admin.article.update');
    Route::delete('/admin/article/{id}', [ArticleAdminController::class, 'destroy'])->name('admin.article.destroy');

    // Faq
    Route::get('/admin/faq', [FaqAdminController::class, 'index'])->name('admin.faq.index');
    Route::post('/admin/faq', [FaqAdminController::class, 'store'])->name('faq.store');
    Route::get('/admin/faq/{id}/edit', [FaqAdminController::class, 'edit'])->name('faq.edit');
    Route::put('/admin/faq/{id}', [FaqAdminController::class, 'update'])->name('faq.update');
    Route::delete('/admin/faq/{id}', [FaqAdminController::class, 'destroy'])->name('faq.destroy');

    // Website
    Route::get('/admin/website', [WebsiteAdminController::class, 'index'])->name('admin.website.index');
    Route::put('/admin/website/{id}', [WebsiteAdminController::class, 'update'])->name('website.update');

    // User
    Route::get('/admin/user', [UserAdminController::class, 'index'])->name('admin.user.index');
    Route::post('/admin/user', [UserAdminController::class, 'store'])->name('user.store');
    Route::get('/admin/user/{id}/get', [UserAdminController::class, 'show'])->name('user.show');
    Route::put('/admin/user/{id}', [UserAdminController::class, 'update'])->name('user.update');
    Route::delete('/admin/user/{id}', [UserAdminController::class, 'destroy'])->name('user.destroy');

    // Admin
    Route::get('/admin/admin', [AdminAdminController::class, 'index'])->name('admin.admin.index');
    Route::post('/admin/admin', [AdminAdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/admin/{id}/get', [AdminAdminController::class, 'show'])->name('admin.show');
    Route::put('/admin/admin/{id}', [AdminAdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/admin/{id}', [AdminAdminController::class, 'destroy'])->name('admin.destroy');

    // Mail
    Route::get('/admin/mail', [MailAdminController::class, 'index'])->name('admin.mail.index');
    Route::post('/admin/mail', [MailAdminController::class, 'store'])->name('mail.store');
    Route::get('/admin/mail/{id}/get', [MailAdminController::class, 'show'])->name('mail.show');
    Route::delete('/admin//mail/{id}', [MailAdminController::class, 'destroy'])->name('mail.destroy');

});

require __DIR__ . '/auth.php';
