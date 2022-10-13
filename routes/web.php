<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\IndexController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Dompdf\Dompdf;
use Mpdf\Mpdf;

// use Meneses\LaravelMpdf\Facades\LaravelMpdf as Mpdf;
// use Mpdf\Mpdf;

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

// $faker = Faker\Factory::create('fa_IR'); // create a French faker
// for ($i = 0; $i < 10; $i++) {
//     die ($faker->name);
// }

Route::get('', [IndexController::class, 'home'])->name('home');
Route::get('contract/{contract}', [IndexController::class, 'contract'])->name('contract');
Route::get('contracts/{category?}', [IndexController::class, 'contracts'])->name('contracts');
Route::get('contract/{contract}/form', [IndexController::class, 'form'])->name('form');
Route::post('contract/{contract}/generate', [IndexController::class, 'generate'])->name('generate');
Route::post('contract/{contract}/download', [IndexController::class, 'download'])->name('download');
// Route::get('login', [IndexController::class, 'home'])->name('login');
// Route::view('login', 'login')->name('login');
Route::get('payments', [IndexController::class, 'payments'])->name('payments');

Route::redirect('admin', 'admin/dashboard');
Route::redirect('dashboard', 'admin/dashboard');


Route::as('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('showLogin');
        Route::post('Login', [AuthController::class, 'login'])->name('login');
        Route::get('verify', [AuthController::class, 'showVerifyForm'])->name('showVerify');
        Route::post('verify', [AuthController::class, 'verify'])->name('verify');
    });
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function() {
    Route::resource('category', CategoryController::class);
    Route::resource('contract', ContractController::class);
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('fillables', 'admin.fillables')->name('fillables');
    Route::post('fillables', [ContractController::class, 'fillables'])->name('fillables');
});
Route::group(['middleware' => 'auth'], function() {
    Route::get('contract/{contract}/buy', [IndexController::class, 'buy'])->name('buy');
});
Route::any('transaction/{uuid}/back' , [IndexController::class,'callback'])->name('callback');


Route::get('foo', function() {
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->getCanvas()
        ->get_cpdf()
        ->setEncryption('test123', 'test456', ['print', 'modify', 'copy', 'add']);
    $dompdf->loadHtml('<p>سلام</p>');
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
});

Route::get('bar', function() {

    $data = [
        'content' => 'لورم ایپسوم'
    ];
    $pdf = PDF::loadView('pdf', $data);
    return $pdf->stream('pdf');
});

Route::get('baz', function() {
    // $data = [
    //     'content' => 'لورم ایپسوم'
    // ];
    // $pdf = new PDF(['format' => 'LETTER', 'orientation' => 'P']);
    // $pdf = $pdf->loadView('pdf', $data);
    // return $pdf->stream('pdf');
    // $pdf->SetProtection(
    //     ['print', 'modify', 'copy', 'annot-forms', 'fill-forms', 'extract', 'assemble', 'print-highres'],
    //     'test123', 'test456', 128
    // );
    // $pdf->loadView('pdf', $data);
    // $pdf->stream('pdf.pdf');


    // $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    // $fontData = $defaultFontConfig['fontdata'];

    $pdf = new Mpdf(['format' => 'A4', 'orientation' => 'P', 'mode' => 'utf-8',
        'fontDir' =>  public_path('fonts'),
        'fontdata' => [ // lowercase letters only in font key
                'Yekan' => [
                    'R' => 'Yekan-Light.ttf',
                ]
            ],
        'default_font' => 'Yekan']);

    $pdf->SetProtection([], null, null, 128);
    $pdf->autoScriptToLang = true;
    $pdf->autoLangToFont = true;
    $pdf->writeHTML('
<h1 style="direction: rtl;">فو بار باز</h1>');
    $pdf->Output();
});

Route::get('qux', function() {
    $pdf = new TCPDF('P', 'mm', 'A4');

    // set some language dependent data:
    $lg = Array();
    $lg['a_meta_charset'] = 'UTF-8';
    $lg['a_meta_dir'] = 'rtl';
    $lg['a_meta_language'] = 'fa';
    $lg['w_page'] = 'page';

    $pdf->setFont('dejavusans', '', 12);
    // set some language-dependent strings (optional)
    $pdf->setLanguageArray($lg);
    $pdf->SetProtection(
        ['print'], null, null, 3
    );
    $pdf->AddPage();
    $pdf->writeHTML('<h1>سلام</h1>');
    file_put_contents(public_path('output.pdf'), $pdf->Output('', 'S'));
});
