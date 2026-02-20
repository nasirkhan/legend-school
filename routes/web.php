<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([], __DIR__.'/web/frontRoutes.php');
Route::group([], __DIR__.'/web/zktecoRoutes.php');
Route::group([], __DIR__.'/web/studentLoginRoutes.php');
Route::group([], __DIR__.'/web/teacherLoginRoutes.php');
Route::group([], __DIR__.'/web/popularClassRoutes.php');
Route::group([], __DIR__.'/web/latestNewsRoutes.php');
Route::group([], __DIR__.'/web/partnerRoutes.php');
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified'
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});

Route::get('/clear-cache', function() {
    $exitCode = Illuminate\Support\Facades\Artisan::call('cache:clear');
//    $exitCode = Illuminate\Support\Facades\Artisan::call('make:model TestModel -m');
//    $exitCode = Illuminate\Support\Facades\Artisan::call('migrate');
    // return what you want
    return 'Success';
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('backend.home.view');
//    return view('dashboard');
//    return redirect('/');
})->name('dashboard');

Route::group([], __DIR__.'/web/adminRoutes.php');
Route::group([], __DIR__.'/web/classRoutes.php');
Route::group([], __DIR__.'/web/subjectRoutes.php');
Route::group([], __DIR__.'/web/hwRoutes.php');
Route::group([], __DIR__.'/web/batchRoutes.php');
Route::group([], __DIR__.'/web/sectionRoutes.php');
Route::group([], __DIR__.'/web/schoolRoutes.php');
Route::group([], __DIR__.'/web/studentRoutes.php');
Route::group([], __DIR__.'/web/itemRoutes.php');
Route::group([], __DIR__.'/web/teacherRoutes.php');
Route::group([], __DIR__.'/web/academicSessionRoutes.php');
Route::group([], __DIR__.'/web/yearRoutes.php');
Route::group([], __DIR__.'/web/monthRoutes.php');
Route::group([], __DIR__.'/web/menuRoutes.php');
Route::group([], __DIR__.'/web/pageRoutes.php');
Route::group([], __DIR__.'/web/subPageRoutes.php');
Route::group([], __DIR__.'/web/sliderRoutes.php');
Route::group([], __DIR__.'/web/leaderRoutes.php');
Route::group([], __DIR__.'/web/testimonialRoutes.php');
Route::group([], __DIR__.'/web/classRoutineRoutes.php');
Route::group([], __DIR__.'/web/galleryImageRoutes.php');
Route::group([], __DIR__.'/web/siteInfoRoutes.php');
Route::group([], __DIR__.'/web/browserSessionRoutes.php');

//Operations Routes
Route::group([], __DIR__.'/web/attendanceRoutes.php');
Route::group([], __DIR__.'/web/examRoutes.php');
Route::group([], __DIR__.'/web/syllabusRoutes.php');
Route::group([], __DIR__.'/web/paperRoutes.php');
Route::group([], __DIR__.'/web/examComponentRoutes.php');
Route::group([], __DIR__.'/web/resultRoutes.php');
Route::group([], __DIR__.'/web/transcriptRoutes.php');
Route::group([], __DIR__.'/web/ecaTypeRoutes.php');
Route::group([], __DIR__.'/web/ecaItemRoutes.php');
Route::group([], __DIR__.'/web/paymentRoutes.php');
Route::group([], __DIR__.'/web/smsRoutes.php');
Route::group([], __DIR__.'/web/dayRoutes.php');
Route::group([], __DIR__.'/web/periodRoutes.php');
Route::group([], __DIR__.'/web/expenseItemRoutes.php');
Route::group([], __DIR__.'/web/expenseRoutes.php');
Route::group([], __DIR__.'/web/beneficiaryRoutes.php');
Route::group([], __DIR__.'/web/academicSupervisionRoutes.php');

//Report Routes
Route::group([], __DIR__.'/web/reportRoutes.php');
Route::group([], __DIR__.'/web/invoiceRoutes.php');
//Bank Related Routes

Route::any('/printable-invoice', function (){
    return view('backend.students.invoice.printable');
});

Route::get('/pdf', function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) {
    $fpdf->AddPage();
    $fpdf->SetFont('Arial', 'B', 18);
    $fpdf->Cell(50, 25, 'Hello World!');
    $fpdf->Output();
    exit;
});

Route::get('/pdf-annotate', function () {
    $hw = App\Models\HW::find(1);
    return view('backend.pdf.pdf',['hw'=>$hw]);
});

if (App\Models\User::exists()){
    Route::get('/register', function() {
        return redirect('/login');
    });
}

Route::get('/sms', function (){
    return singleMessageSend('8801722454519','Hello World LIS','normal');
});
