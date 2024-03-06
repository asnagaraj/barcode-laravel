<?php

namespace App\Http\Controllers;

use PDF;
use Picqer\Barcode\BarcodeGeneratorPNG;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128));
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'qrcode' => $qrcode,
            'barcode' => $barcode,
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->download('itsolutionstuff.pdf');
    }
}
