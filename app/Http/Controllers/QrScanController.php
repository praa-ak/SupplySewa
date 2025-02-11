<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zxing\QrReader;

class QrScanController extends Controller
{
    public function index()
    {
        return view('filament.distributor.qr_scan');
    }


    public function store(Request $request)
    {
        $image = $request->input('image');

        // Decode the image
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageData = base64_decode($image);

        // Generate a unique file name
        $fileName = uniqid() . '.jpeg';

        // Save the image to the public/images directory
        $path = public_path('images/' . $fileName);
        file_put_contents($path, $imageData);

        $qrReader = new QrReader($path); // Path to the saved image
        $qrText = $qrReader->text();
        // Check if the QR code contains a valid URL
        if (filter_var($qrText, FILTER_VALIDATE_URL)) {
            return redirect($qrText); // Redirect to the extracted URL
        }

        return 'error' ;

}
}
