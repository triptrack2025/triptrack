<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QRDataImport;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Mail\TripTrackTagScannedMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;


class QRCodeController extends Controller
{
    
    public function getLocation(Request $request)
    {
        // Get user IP address
        $ip = $request->ip();
        
        // For local testing, use a public IP (replace '127.0.0.1' with a test IP)
        if ($ip == "127.0.0.1") {
            $ip = "8.8.8.8"; // Google's public IP (for testing)
        }

        // Fetch location data using ipinfo.io
        $response = Http::get("http://ipinfo.io/{$ip}/json");

        // Convert response to JSON
        $data = $response->json();

        return response()->json($data);
    }

    public function showUploadForm()
    {
        return view('upload_qr');
    }

    public function generateMultipleQRCodes(Request $request)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);

        $file = $request->file('file');
        $qrDataList = [];
        $headers = [];

        if ($file->getClientOriginalExtension() === 'csv') {
            if (($handle = fopen($file->getPathname(), "r")) !== false) {
                $rows = [];
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $rows[] = $data;
                }
                fclose($handle);
            }
        } else if($file->getClientOriginalExtension() === 'xlsx' || $file->getClientOriginalExtension() === 'xls') {
            $rows = Excel::toArray(new QRDataImport, $file)[0];
        } else{
            throw ValidationException::withMessages([
                'file' => 'Invalid file type. Only CSV, XLSX, and XLS files are allowed.'
            ]);
        }

        if (!empty($rows)) {
            $headers = array_map('trim', $rows[0]);
            unset($rows[0]); // Remove header row from data

            foreach ($rows as $row) {
                $formattedData = [];
                foreach ($headers as $index => $header) {
                    $formattedData[$header] = trim($row[$index] ?? '');
                }

                // Encrypt Data
                $encryptedData = Crypt::encrypt(json_encode($formattedData));

                // Generate QR Code with Encrypted Data in URL
                $qrText = url('/scan-redirect?data=' . urlencode($encryptedData));
                $qrCode = QrCode::size(100)->generate($qrText);

                $qrDataList[] = [
                    'data' => $formattedData,
                    'qrCode' => $qrCode,
                ];
            }
        }



        return view('qr_list', compact('qrDataList', 'headers'));
    }
    
    private function generateQRText($data)
    {
        $text = "";
        $i = 1;
        foreach ($data as $key => $value) {
            if(count($data) == $i){
                $text .= $key.'='.$value;
            }else{
                $text .= $key.'='.$value.'&';
            }
            $i++;
        }
        return $text;
    }

    public function handleScan(Request $request)
    {
        if (!$request->has('data')) {
            return abort(400, "Invalid QR Code");
        }

        try {
            $decryptedData = json_decode(Crypt::decrypt(urldecode($request->data)), true);
        } catch (\Exception $e) {
            return abort(400, "Invalid Data");
        }

        return view('auto_post_form', compact('decryptedData'));
    }

    private function generateGoogleMapUrl($latitude, $longitude)
    {
        if (!$latitude || !$longitude) {
            return null;
        }

        $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY'); // Ensure this is set in .env
        return "https://maps.googleapis.com/maps/api/staticmap?center={$latitude},{$longitude}&zoom=14&size=600x300&maptype=roadmap&markers=color:red%7C{$latitude},{$longitude}&key={$googleMapsApiKey}";
    }
  
    public function processFoundItem(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect('/')->with('error', 'Invalid access method.');
        }
    
        $data = $request->all();
        $email = '';
        $name = "TripTrack User";
        $latitude = $request->input('latitude'); // Get latitude from request
        $longitude = $request->input('longitude'); // Get longitude from request
        $location = '';
    
        if (!$latitude || !$longitude) {
            // Get location from IP if not provided
            $ip = $request->ip();

            if ($ip == "127.0.0.1") {
                $ip = "8.8.8.8"; // Use Google's IP for testing
            }
    
            // Fetch location data from ipinfo.io
            $response = Http::get("http://ipinfo.io/{$ip}/json");
    
            if ($response->successful()) {
                $locationData = $response->json();
                if (isset($locationData['loc'])) {
                    [$latitude, $longitude] = explode(',', $locationData['loc']);
                }
                if (isset($locationData['city']) && isset($locationData['region']) && isset($locationData['country'])) {
                    $location = "{$locationData['city']}, {$locationData['region']} {$locationData['postal']}, {$locationData['country']}";
                }
            }
        }
    
        // Extract user details from request
        foreach ($data as $key => $value) {
            if (in_array($key, ['Name', 'First Name', 'Owner Name'])) {
                $name = $value;
            }
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $email = $value;
                try {
                    Mail::to($email)->send(new TripTrackTagScannedMail($name, $latitude, $longitude, $location));
                    Log::info("Email successfully sent to: $email");
                } catch (\Exception $e) {
                    Log::error("Failed to send email: " . $e->getMessage());
                    return back()->with('error', 'Failed to send email.');
                }
            }
        }
    
        return view('found_item', compact('data'))->with('success', 'Process completed.');
    }

    public function generatePreview(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'footer' => 'nullable|string|max:255',
        ]);

        $qrCode = QrCode::size(150)->generate('https://triptrack.in/scan');

        return response()->json([
            'company_name' => $data['company_name'],
            'slogan' => $data['slogan'] ?? '',
            'footer' => $data['footer'] ?? '',
            'qr_code' => $qrCode
        ]);
    }

    public function generatePDF(Request $request)
    {
        $frontCustomBgImagePath = '';
        // Store image if provided
        if ($request->hasFile('front_custom_bg_image')) {
                $file = $request->file('front_custom_bg_image');
                $filename = time() . '_' . $file->getClientOriginalName(); // Unique filename
                $destinationPath = public_path('assets/images'); // Set destination path

                // Move file to public/assets/images
                $file->move($destinationPath, $filename);

                // Store relative path in database
                $frontCustomBgImagePath = 'assets/images/' . $filename;
            }
        

            $tagData = [
                
                'select_default_or_custom_page' => $request->input('select_default_or_custom_page', 'Default'),
                'tag_width_size' => $request->input('tag_width_size', 300),
                'tag_height_size' => $request->input('tag_height_size', 550),

                // 'front_custom_bg_image' => $request->input('front_custom_bg_image', 'Default'),
                'front_custom_bg_image' => $frontCustomBgImagePath,

                'front_custom_bg_image_width' => $request->input('front_custom_bg_image_width', '400'),
                'front_custom_bg_image_height' => $request->input('front_custom_bg_image_height', '600'),

            
                'front_bg_color' => $request->input('front_bg_color', '#343434'),
                'front_logo' => $request->input('front_logo', '/assets/images/triptrack-logo-front.png'), // Handle logo path properly
                'front_company_name' => $request->input('front_company_name', 'Trip Track'),
                'front_company_name_color' => $request->input('front_company_name_color', '#eec7af'),
                'front_company_name_size' => $request->input('front_company_name_size', 24),
                'front_slogan' => $request->input('front_slogan', 'S C A N - T R A C K - E X P L O R E'),
                'front_slogan_color' => $request->input('front_slogan_color', '#eec7af'),
                'front_slogan_size' => $request->input('front_slogan_size', 10),

                'back_bg_color' => $request->input('back_bg_color', '#f0e0d3'),
                'back_logo' => $request->input('back_logo', '/assets/images/triptrack-logo-back.png'), // Handle logo path properly
                'back_company_name' => $request->input('back_company_name', 'Trip Track'),
                'back_company_name_color' => $request->input('back_company_name_color', '#383434'),
                'back_company_name_size' => $request->input('back_company_name_size', 24),
                'back_slogan' => $request->input('back_slogan', 'S C A N - T R A C K - E X P L O R E'),
                'back_slogan_color' => $request->input('back_slogan_color', '#383434'),
                'back_slogan_size' => $request->input('back_slogan_size', 10),
                // 'back_middle_content' => $request->input('back_middle_content', 'FOUND ME?
                //                             SCAN QR   
                //                             TO RETURN                                  
                //                         '),
                'back_middle_content_color' => $request->input('back_middle_content_color', '#383434'),
                // 'footer' => $request->input('footer', 'Powered by TripTrack'),
            ];

            // dd($tagData);

            // return view('website.tag_pdf', compact('tagData'));
            $pdf = Pdf::loadView('website.tag_pdf', compact('tagData'));
            return $pdf->download('custom-tag.pdf');
    }
    

}
