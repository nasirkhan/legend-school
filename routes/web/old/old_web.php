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
//    return view('dashboard');
    return redirect('/');
})->name('dashboard');

Route::group([], __DIR__.'/web/adminRoutes.php');
Route::group([], __DIR__.'/web/categoryRoutes.php');
Route::group([], __DIR__.'/web/measurementCategoryRoutes.php');
Route::group([], __DIR__.'/web/subCategoryRoutes.php');
Route::group([], __DIR__.'/web/brandRoutes.php');
Route::group([], __DIR__.'/web/countryRoutes.php');
Route::group([], __DIR__.'/web/unitRoutes.php');
Route::group([], __DIR__.'/web/unitConversionRoutes.php');
Route::group([], __DIR__.'/web/productRoutes.php');
Route::group([], __DIR__.'/web/clientTypeRoutes.php');

Route::group([], __DIR__.'/web/clientRoutes.php');
Route::group([], __DIR__.'/web/purchaseRoutes.php');
Route::group([], __DIR__.'/web/stockRoutes.php');
Route::group([], __DIR__.'/web/saleRoutes.php');
Route::group([], __DIR__.'/web/siteInfoRoutes.php');

//Bank Related Routes
Route::group([], __DIR__.'/web/bankRoutes.php');
Route::group([], __DIR__.'/web/bankAccountRoutes.php');
Route::group([], __DIR__.'/web/bankLoanRoutes.php');
Route::group([], __DIR__.'/web/bankLoanTransactionRoutes.php');
Route::group([], __DIR__.'/web/bankTransactionRoutes.php');

//Income & Expense
Route::group([], __DIR__.'/web/transactionSectorRoutes.php');
Route::group([], __DIR__.'/web/transactionItemRoutes.php');
Route::group([], __DIR__.'/web/transactionRoutes.php');

//Report
Route::group([], __DIR__.'/web/reportRoutes.php');
Route::group([], __DIR__.'/web/cashBookRoutes.php');


Route::get('/pdf', function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) {
    $fpdf->AddPage();
    $fpdf->SetFont('Arial', 'B', 18);
    $fpdf->Cell(50, 25, 'Hello World!');
    $fpdf->Output();
    exit;
});

//if (App\Models\User::exists()){
//    Route::get('/register', function() {
//        return redirect('/login');
//    });
//}
