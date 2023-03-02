<?php

use App\Http\Controllers\FileUpload;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\FoodItem;
use App\Http\Controllers\FoodItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Payment\CheckoutController;
use TsaiYiHua\ECPay\Collections\CheckoutPostCollection;


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

// Route::get('/create',function(){
//     return view('app');
// })->where('any','.*');

// Route::get('/home',function(){
//     return view('app');
// })->where('any','.*');

// Route::get('/edit',function(){
//     return view('app');
// })->where('any','.*');

// Route::get('/test', function(){
//     return trans('auth.throttle');
// });

// Route::get('welcome/{locale}', function ($locale) {
//     App::setLocale($locale);
//     return view('welcome');
// });

// Route::get('/qrcode', [QrCodeController::class, 'index']);


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/image-upload', [FileUpload::class, 'index']);
// Route::post('/image-upload', [FileUpload::class, 'fileUpload'])->name('imageUpload');


// Route::get('image-view',[ImageController::class, 'index']);
// Route::post('image-view',[ImageController::class, 'store']);

Route::any('/products/export/', [FoodItemController::class, 'export']);

Route::any('/ecpay', [CheckoutController::class, 'sendOrder']);

//Route::any('/test', [CheckoutPostCollection::class, 'sendOrder']);

//Route::get('/category', [CategoryController::class, 'index1']);




Route::any('/excel', function () {
    //return view('excel');   
    /*********************************************/
    // $spreadsheet = IOFactory::load('template.xlsx');

    // $worksheet = $spreadsheet->getActiveSheet();

    // $worksheet->getCell('A1')->setValue('John');
    // $worksheet->getCell('A2')->setValue('Smith');

    // $writer = IOFactory::createWriter($spreadsheet, 'Xls');
    // $writer->save('write.xls');

    /*********************************************/

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $FoodItems = FoodItem::all()->toArray();

    $sheet->setCellValue('A1', 'id');
    $sheet->setCellValue('B1', 'Name');
    $sheet->setCellValue('C1', 'Quantity');
    $sheet->setCellValue('D1', 'Unit_Price');
    $sheet->setCellValue('E1', 'ItemCategory');
    //$sheet->setCellValue('F1', 'remark');
    $i=2;

    foreach($FoodItems as $FoodItem){

        $sheet->setCellValue('A'.$i, $FoodItem['id']);
        $sheet->setCellValue('B'.$i, $FoodItem['Name']);
        $sheet->setCellValue('C'.$i, $FoodItem['Quantity']);
        $sheet->setCellValue('D'.$i, $FoodItem['Unit_Price']);
        $sheet->setCellValue('E'.$i, $FoodItem['ItemCategory']);
        //$sheet->setCellValue('F'.$i, $FoodItems['remark']);
        $i++;
    }

    // for($i=2;$i<=10;$i++){
        
    //         $sheet->setCellValue('A'.$i, $FoodItems[i-2].id);
    //         $sheet->setCellValue('B'.$i, $FoodItems[i-2].Name);
    //         $sheet->setCellValue('C'.$i, $FoodItems[i-2].Quantity);
    //         $sheet->setCellValue('D'.$i, $FoodItems[i-2].Unit_Price);
    //         $sheet->setCellValue('E'.$i, $FoodItems[i-2].ItemCategory);
    //         $sheet->setCellValue('F'.$i, $FoodItems[i-2].remark);
        
    // }
    //$sheet->setCellValue('A1', 'Hello World !');

    $writer = new Xlsx($spreadsheet);
    $writer->save('hello world.xlsx');
    // redirect output to client browser
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="report.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
});

Route::get('/products/excel', 'FoodItemController@export');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::view('{any}', 'dashboard')->middleware('auth')->where('any','.*');


// Route::controller(FoodItemController::class)->group(function () {
//     Route::get('/products', 'index');
// });