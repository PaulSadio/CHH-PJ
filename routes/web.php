<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'login'])->middleware('auth')->name('home');
Route::patch('/update-annual-fee-status/{id}', [PageController::class, 'updateAnnualFeeStatus'])
    ->name('updateAnnualFeeStatus');
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::middleware('auth')->group(function () {
    Route::get('/admin', [PageController::class, 'admin'])->name('admin');
    Route::get('/member', [PageController::class, 'member'])->name('member');
});
Route::get('/', [PageController::class, 'signin'])->name('signin');

Route::get('/registermember', [PageController::class, 'registermember']);

Route::get('/adminproposal', [PageController::class, 'adminproposal'])->name('adminproposal');

// Route::get('/admin', [PageController::class, 'admin'])->name('admin');

// Route::get('/member', [PageController::class, 'member'])->name('member');
Route::get('/evaluation', [PageController::class, 'evaluation'])->name('evaluation');
Route::get('/members/{member}/view', [PageController::class, 'view'])->name('view');
Route::post('/view/{member}/store-remark', [PageController::class, 'viewstore'])->name('viewstore');



// Route::get('/evaluation', [PageController::class, 'evaluation'])->name('evaluation');
// Route::get('/view/{member}', [PageController::class, 'view'])->name('view');
// Route::post('/view/{member}/remarks', [PageController::class, 'viewstore'])->name('viewstore');

Route::get('/adminmembers', [PageController::class, 'adminmembers'])->name('adminmembers');

Route::get('/attendance', [PageController::class, 'attendance'])->name('attendance');

Route::get('/edit/{member}', [PageController::class, 'edit'])->name('edit');
Route::put('/edit/{member}/update', [PageController::class, 'update'])->name('update');

Route::get('/annualfee', [PageController::class,'annualfee'])->name('annualfee');
Route::get('/fundraiser', [PageController::class, 'fundraiser'])->name('fundraiser');
Route::post('/fundraiser', [PageController::class, 'fundstore'])->name('fundstore');
Route::get('/treasury', [PageController::class, 'treasury'])->name('treasury');

Route::get('/addmember', [PageController::class, 'addmember'])->name('addmember');
Route::post('/addmember', [PageController::class, 'store'])->name('store');
Route::patch('/updatestatus/{id}', [PageController::class, 'updatestatus'])
    ->name('updatestatus');

// Route::get('/proposal', [PageController::class, 'proposal'])->name('proposal');
// Route::post('/proposal', [PageController::class, 'propstore'])->name('propstore');

Route::get('/registration', [PageController::class, 'registration'])->name('registration');
Route::post('/registration', [PageController::class, 'regstore'])->name('regstore');

Route::controller(EventController::class)->group(function () {
    Route::get('/adminhome', 'index')->name('event.get');
    Route::post('/adminhome', 'store')->name('event.store');
});



require __DIR__.'/auth.php';

// download file -proposal page
Route::get('/download/{propfile}', [PageController::class, 'download'])->name('download');
Route::get('/proposal', [PageController::class, 'proposal'])->name('proposal');
Route::post('/propstore', [PageController::class, 'propstore'])->name('propstore');
// download file -proposal page

// download file memo page
Route::get('/adminmemo', [PageController::class, 'adminmemo'])->name('adminmemo');
Route::get('/adminmemo/{memofile}', [PageController::class, 'downloadmemo'])->name('downloadmemo');
Route::post('/adminmemo/store', [PageController::class, 'memostore'])->name('memostore');
// download file memo page

// download member announcement
Route::get('/announcement', [PageController::class, 'announcement'])->name('announcement');
Route::get('/announcement/{memofile}', [PageController::class, 'downloadannouncement'])->name('downloadannouncement');

Route::post('/proposal/approve/{proposal}', [PageController::class, 'proposalApprove'])->name('proposalApprove');
Route::delete('/proposal/decline/{proposal}', [PageController::class, 'proposalDecline'])->name('proposalDecline');

// In your routes/web.php file
Route::get('/attendance/{id}', [PageController::class, 'attendanceid'])->name('attendanceid');

Route::get('/proposallist', [PageController::class, 'proposallist'])->name('proposallist');

Route::get('/eventsumarry', [PageController::class, 'eventsumarry'])->name('eventsumarry');
