<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    /**
     * Generate a PDF report.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */

    public function generateDailyPDF()
{
    $data = [
        'title' => 'Daily Report',
        'date' => date('Y-m-d'),
        'logo' => public_path('img/aioh_logo.png'),
        'image' => public_path('img/aioh_blue.png')
    ]; 
    $pdf = Pdf::loadView('admin.dailyReports', compact('data'));


    return $pdf->download('Daily_Monitoring_Doc.pdf');
}


}
