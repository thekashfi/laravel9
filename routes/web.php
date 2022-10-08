<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContractController;
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

Route::redirect('admin', 'admin/dashboard');
Route::redirect('dashboard', 'admin/dashboard');

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function() {
    Route::resource('category', CategoryController::class);
    Route::resource('contract', ContractController::class);
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('fillables', 'admin.fillables')->name('fillables');
});

Route::get('foo', function() {
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->getCanvas()
        ->get_cpdf()
        ->setEncryption('test123', 'test456', ['print', 'modify', 'copy', 'add']);
    $dompdf->loadHtml('<p>is this text encrypted?</p>');
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

    $pdf = new Mpdf(['format' => 'LETTER', 'orientation' => 'P', 'mode' => 'utf-8',
        'fontDir' =>  public_path('fonts'),
        'fontdata' => [ // lowercase letters only in font key
                'vazir' => [
                    'I' => 'Vazirmatn-Bold.ttf',
                    'R' => 'Vazirmatn-Light.ttf',
                ]
            ],
        'default_font' => 'vazir']);

    $pdf->SetProtection([], null, null, 128);
    $pdf->autoScriptToLang = true;
    $pdf->autoLangToFont = true;
    $pdf->writeHTML('
<div style="position:absolute; width:100%; height:100%; opacity: 0 !important; z-index: 999"></div>
<h1 style="font-family: dejavusanscondensed; direction: rtl;">فو بار باز</h1>');
    $pdf->Output();
});

Route::get('qux', function() {
    $pdf = new TCPDF('P', 'mm', 'LETTER');
    $pdf->SetProtection(
        [], null, null, 3
    );
    $pdf->AddPage();
    $pdf->writeHTML('<h1>world</h1>');
    file_put_contents(public_path('output.pdf'), $pdf->Output('', 'S'));
});
