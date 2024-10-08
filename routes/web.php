<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorReportController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\RateController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use Laravel\Fortify\Features;
use Inertia\Inertia;

Route::get('/', function () {
    return inertia('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


// Homeworks routes -----------------------------------------------------------
// ---------------------------------------------------------------------------- 
Route::resource('/homeworks', HomeworkController::class)->except('index', 'show')->middleware(['auth', 'verified']);
Route::get('/homeworks/no-collaboration', [HomeworkController::class, 'noCollaboration'])->name('homeworks.no-collaboration')->middleware(['auth', 'verified']);
Route::get('/homeworks/on-collaboration', [HomeworkController::class, 'onCollaboration'])->name('homeworks.on-collaboration')->middleware(['auth', 'verified']);
Route::get('/homeworks/completed', [HomeworkController::class, 'completed'])->name('homeworks.completed')->middleware(['auth', 'verified']);
Route::get('/homeworks/claims', [HomeworkController::class, 'claims'])->name('homeworks.claims')->middleware(['auth', 'verified']);
Route::post('/homeworks/send-message', [HomeworkController::class, 'sendMessage'])->name('homeworks.send-message')->middleware(['auth', 'verified']);
Route::post('/homeworks/delete-file', [HomeworkController::class, 'deleteFile'])->name('homeworks.delete-file')->middleware(['auth', 'verified']);
Route::post('/homeworks/update-with-resources/{homework}', [HomeworkController::class, 'updateWithResources'])->name('homeworks.update-with-resources')->middleware(['auth', 'verified']);


// Collaborations routes -----------------------------------------------------------
// ---------------------------------------------------------------------------------
Route::resource('/collaborations', CollaborationController::class)->except('show')->middleware(['auth', 'verified']);
Route::get('/collaborations/approve-pendent', [CollaborationController::class, 'approvePendent'])->name('collaborations.approve-pendent')->middleware(['auth', 'verified']);
Route::get('/collaborations/in-process', [CollaborationController::class, 'inProcess'])->name('collaborations.in-process')->middleware(['auth', 'verified']);
Route::get('/collaborations/completed', [CollaborationController::class, 'completed'])->name('collaborations.completed')->middleware(['auth', 'verified']);
Route::get('/collaborations/claims', [CollaborationController::class, 'claims'])->name('collaborations.claims')->middleware(['auth', 'verified']);
Route::post('/collaborations/read-collaboration', [CollaborationController::class, 'readCollaboration'])->name('collaborations.read-collaboration')->middleware(['auth', 'verified']);
Route::post('/collaborations/update-p', [CollaborationController::class, 'updateP'])->name('collaborations.update-p')->middleware(['auth', 'verified']);
Route::put('/collaborations/approve/{collaboration}', [CollaborationController::class, 'approve'])->name('collaborations.approve')->middleware(['auth', 'verified']);
Route::put('/collaborations/release-payment/{collaboration}', [CollaborationController::class, 'releasePayment'])->name('collaborations.release-payment')->middleware(['auth', 'verified']);
Route::get('collaboration/{collaboration}/payment', [CollaborationController::class, 'payment'])->name('payment')->middleware(['auth', 'verified']);
Route::post('collaboration/payment-method-create', [CollaborationController::class, 'paymentMethodCreate'])->name('collaborations.payment-method.create')->middleware(['auth', 'verified']);
Route::post('collaboration/store-bank-data', [CollaborationController::class, 'storeBankData'])->name('collaborations.store-bank-data')->middleware(['auth', 'verified']);
Route::post('collaboration/payed', [CollaborationController::class, 'payed'])->name('collaborations.payed')->middleware(['auth', 'verified']);


// Ranking routes ------------------------------------------------------------------
// ---------------------------------------------------------------------------------
Route::get('/ranking', [RankingController::class,'ranking'])->name('ranking.index')->middleware(['auth', 'verified']);
Route::get('/ranking/awards', [RankingController::class,'awards'])->name('ranking.awards')->middleware(['auth', 'verified']);
Route::get('/ranking/motivation', [RankingController::class,'motivation'])->name('ranking.motivation')->middleware(['auth', 'verified']);
Route::get('/ranking/levels', [RankingController::class,'levels'])->name('ranking.levels')->middleware(['auth', 'verified']);


// Admin routes --------------------------------------------------------------------
// ---------------------------------------------------------------------------------
Route::get('/admin/finances', [AdminController::class,'finances'])->name('admin.finances')->middleware(['auth', 'verified']);
Route::get('/admin/configurations', [AdminController::class,'configurations'])->name('admin.configurations')->middleware(['auth', 'verified']);
Route::get('/admin/claims', [AdminController::class,'claims'])->name('admin.claims')->middleware(['auth', 'verified']);
Route::get('/admin/notifications', [AdminController::class,'notifications'])->name('admin.notifications')->middleware(['auth', 'verified']);
Route::get('/admin/users', [AdminController::class,'users'])->name('admin.users')->middleware(['auth', 'verified']);
Route::get('/admin/errors', [AdminController::class,'errors'])->name('admin.errors')->middleware(['auth', 'verified']);
Route::get('/admin/collaborations', [AdminController::class,'collaborations'])->name('admin.collaborations')->middleware(['auth', 'verified']);


// Claims routes -------------------------------------------------------------------
// ---------------------------------------------------------------------------------
Route::resource('/claims', ClaimController::class)->except('show')->middleware(['auth', 'verified']);


// Library routes -------------------------------------------------------------------
// ----------------------------------------------------------------------------------
Route::get('/library', [LibraryController::class,'index'])->name('library.index')->middleware(['auth', 'verified']);


// Chat routes ----------------------------------------------------------------------
// ----------------------------------------------------------------------------------
Route::resource('chat', ChatController::class);
Route::post('/chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send-message');
Route::post('/chat/read-messages', [ChatController::class, 'readMessage'])->name('chat.read-message');


// Rates routes ----------------------------------------------------------------------
// -----------------------------------------------------------------------------------
Route::resource('rates', RateController::class)->middleware(['auth']);


// error reports routes ----------------------------------------------------------------------
// -------------------------------------------------------------------------------------------
Route::resource('error-reports', ErrorReportController::class);
Route::put('error-reports/mark-as-read/{error}', [ErrorReportController::class, 'markAsRead'])->name('error-reports.mark-as-read');


// notifications routes ----------------------------------------------------------------------
// -------------------------------------------------------------------------------------------
Route::get('notifications/{user}', [NotificationController::class, 'all'])->middleware(['auth'])->name('notifications.all');
Route::post('notifications/{user}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');


// profile user routes ----------------------------------------------------------------------
// -------------------------------------------------------------------------------------------
Route::get('/profile/{user}', function ($user_id){
    $user = User::with('collaborations', 'homeworks')->find($user_id);
    // $user = new UserResource($user);
    return inertia('ProfileUser', ['user' => $user]);
})->name('profile-view');


// Privacy and policy --------------------------
// --------------------------------------------- 
Route::get('/privacy-policy', function (){
    return inertia('PrivacyPolicy');
})->name('privacy-policy');


// Terms and conditions --------------------------
// ----------------------------------------------
Route::get('/terms-of-service', function (){
    return inertia('TermsOfService');
})->name('terms-of-service');


// Email Verification...
$enableViews = config('fortify.views', true);
$verificationLimiter = config('fortify.limiters.verification', '6,1');

if (Features::enabled(Features::emailVerification())) {
    if ($enableViews) {
        Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
            ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])
            ->name('verification.notice');
    }

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'signed', 'throttle:'.$verificationLimiter])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'throttle:'.$verificationLimiter])
        ->name('verification.send');
}
