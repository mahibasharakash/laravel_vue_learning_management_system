<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController,
    App\Http\Controllers\admin\UserController,
    App\Http\Controllers\admin\AnswerController,
    App\Http\Controllers\admin\CommentController,
    App\Http\Controllers\admin\CourseController,
    App\Http\Controllers\admin\EnrollmentController,
    App\Http\Controllers\admin\LessonController,
    App\Http\Controllers\admin\PaymentController,
    App\Http\Controllers\admin\QuestionController,
    App\Http\Controllers\admin\QuizAttemptController,
    App\Http\Controllers\admin\QuizController,
    App\Http\Controllers\admin\SectionController,
    App\Http\Controllers\admin\SettingsController;

Route::prefix('auth')->group(function() {
    Route::post('/login', [UserController::class, 'login'])->name('LOGIN.API.AUTH');
    Route::post('/registration', [UserController::class, 'registration'])->name('REGISTRATION.API.AUTH');
    Route::post('/forgot', [UserController::class, 'forgot'])->name('FORGOT.API.AUTH');
    Route::post('/reset', [UserController::class, 'reset'])->name('RESET.API.AUTH');
    Route::post('/verification', [UserController::class, 'verification'])->name('VERIFICATION.API.AUTH');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('profile')->group(function() {
        Route::get('/user-details', [UserController::class, 'details'])->name('USER.DETAILS.API.PROFILE');
        Route::post('/change-details', [UserController::class, 'changeDetails'])->name('USER.CHANGE.DETAILS.API.PROFILE');
        Route::post('/change-password', [UserController::class, 'changePassword'])->name('USER.CHANGE.PASSWORD.API.PROFILE');
        Route::post('/logout', [UserController::class, 'logout'])->name('USER.LOGOUT.API.PROFILE');
        Route::post('/delete-account', [UserController::class, 'deleteAccount'])->name('USER.DELETE.ACCOUNT.API.PROFILE');
        Route::post('/upload-image', [UserController::class, 'uploadImage'])->name('USER.UPLOAD.IMAGE.API.PROFILE');
        Route::post('/remove-image', [UserController::class, 'removeImage'])->name('USER.REMOVE.IMAGE.API.PROFILE');
    });

    Route::prefix('dashboard')->group(function() {
        Route::get('/get', [DashboardController::class, 'index'])->name('GET.API.DASHBOARD');
    });

    Route::prefix('answer')->group(function() {
        Route::get('/list', [AnswerController::class, 'index'])->name('LIST.API.ANSWER');
        Route::post('/store', [AnswerController::class, 'store'])->name('STORE.API.ANSWER');
        Route::get('/show/{id}', [AnswerController::class, 'show'])->name('SHOW.API.ANSWER');
        Route::put('/update/{id}', [AnswerController::class, 'update'])->name('UPDATE.API.ANSWER');
        Route::delete('/delete/{id}', [AnswerController::class, 'destroy'])->name('DELETE.API.ANSWER');
    });

    Route::prefix('comment')->group(function() {
        Route::get('/list', [CommentController::class, 'index'])->name('LIST.API.COMMENT');
        Route::post('/store', [CommentController::class, 'store'])->name('STORE.API.COMMENT');
        Route::get('/show/{id}', [CommentController::class, 'show'])->name('SHOW.API.COMMENT');
        Route::put('/update/{id}', [CommentController::class, 'update'])->name('UPDATE.API.COMMENT');
        Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name('DELETE.API.COMMENT');
    });

    Route::prefix('course')->group(function() {
        Route::get('/list', [CourseController::class, 'index'])->name('LIST.API.COURSE');
        Route::post('/store', [CourseController::class, 'store'])->name('STORE.API.COURSE');
        Route::get('/show/{id}', [CourseController::class, 'show'])->name('SHOW.API.COURSE');
        Route::put('/update/{id}', [CourseController::class, 'update'])->name('UPDATE.API.COURSE');
        Route::delete('/delete/{id}', [CourseController::class, 'destroy'])->name('DELETE.API.COURSE');
    });

    Route::prefix('enrollment')->group(function() {
        Route::get('/list', [EnrollmentController::class, 'index'])->name('LIST.API.ENROLLMENT');
        Route::post('/store', [EnrollmentController::class, 'store'])->name('STORE.API.ENROLLMENT');
        Route::get('/show/{id}', [EnrollmentController::class, 'show'])->name('SHOW.API.ENROLLMENT');
        Route::put('/update/{id}', [EnrollmentController::class, 'update'])->name('UPDATE.API.ENROLLMENT');
        Route::delete('/delete/{id}', [EnrollmentController::class, 'destroy'])->name('DELETE.API.ENROLLMENT');
    });

    Route::prefix('lesson')->group(function() {
        Route::get('/list', [LessonController::class, 'index'])->name('LIST.API.LESSON');
        Route::post('/store', [LessonController::class, 'store'])->name('STORE.API.LESSON');
        Route::get('/show/{id}', [LessonController::class, 'show'])->name('SHOW.API.LESSON');
        Route::put('/update/{id}', [LessonController::class, 'update'])->name('UPDATE.API.LESSON');
        Route::delete('/delete/{id}', [LessonController::class, 'destroy'])->name('DELETE.API.LESSON');
    });

    Route::prefix('payment')->group(function() {
        Route::get('/list', [PaymentController::class, 'index'])->name('LIST.API.PAYMENT');
        Route::post('/store', [PaymentController::class, 'store'])->name('STORE.API.PAYMENT');
        Route::get('/show/{id}', [PaymentController::class, 'show'])->name('SHOW.API.PAYMENT');
        Route::put('/update/{id}', [PaymentController::class, 'update'])->name('UPDATE.API.PAYMENT');
        Route::delete('/delete/{id}', [PaymentController::class, 'destroy'])->name('DELETE.API.PAYMENT');
    });

    Route::prefix('question')->group(function() {
        Route::get('/list', [QuestionController::class, 'index'])->name('LIST.API.QUESTION');
        Route::post('/store', [QuestionController::class, 'store'])->name('STORE.API.QUESTION');
        Route::get('/show/{id}', [QuestionController::class, 'show'])->name('SHOW.API.QUESTION');
        Route::put('/update/{id}', [QuestionController::class, 'update'])->name('UPDATE.API.QUESTION');
        Route::delete('/delete/{id}', [QuestionController::class, 'destroy'])->name('DELETE.API.QUESTION');
    });

    Route::prefix('quiz-attempt')->group(function() {
        Route::get('/list', [QuizAttemptController::class, 'index'])->name('LIST.API.QUIZ.ATTEMPT');
        Route::post('/store', [QuizAttemptController::class, 'store'])->name('STORE.API.QUIZ.ATTEMPT');
        Route::get('/show/{id}', [QuizAttemptController::class, 'show'])->name('SHOW.API.QUIZ.ATTEMPT');
        Route::put('/update/{id}', [QuizAttemptController::class, 'update'])->name('UPDATE.API.QUIZ.ATTEMPT');
        Route::delete('/delete/{id}', [QuizAttemptController::class, 'destroy'])->name('DELETE.API.QUIZ.ATTEMPT');
    });

    Route::prefix('quiz')->group(function() {
        Route::get('/list', [QuizController::class, 'index'])->name('LIST.API.QUIZ');
        Route::post('/store', [QuizController::class, 'store'])->name('STORE.API.QUIZ');
        Route::get('/show/{id}', [QuizController::class, 'show'])->name('SHOW.API.QUIZ');
        Route::put('/update/{id}', [QuizController::class, 'update'])->name('UPDATE.API.QUIZ');
        Route::delete('/delete/{id}', [QuizController::class, 'destroy'])->name('DELETE.API.QUIZ');
    });

    Route::prefix('section')->group(function() {
        Route::get('/list', [SectionController::class, 'index'])->name('LIST.API.SECTION');
        Route::post('/store', [SectionController::class, 'store'])->name('STORE.API.SECTION');
        Route::get('/show/{id}', [SectionController::class, 'show'])->name('SHOW.API.SECTION');
        Route::put('/update/{id}', [SectionController::class, 'update'])->name('UPDATE.API.SECTION');
        Route::delete('/delete/{id}', [SectionController::class, 'destroy'])->name('DELETE.API.SECTION');
    });

    Route::prefix('settings')->group(function() {
        Route::get('/list', [SettingsController::class, 'index'])->name('LIST.API.SETTINGS');
        Route::post('/store', [SettingsController::class, 'store'])->name('STORE.API.SETTINGS');
        Route::get('/show/{id}', [SettingsController::class, 'show'])->name('SHOW.API.SETTINGS');
        Route::put('/update/{id}', [SettingsController::class, 'update'])->name('UPDATE.API.SETTINGS');
        Route::delete('/delete/{id}', [SettingsController::class, 'destroy'])->name('DELETE.API.SETTINGS');
    });

});
