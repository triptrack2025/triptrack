<?php

namespace App\Http\Controllers;

use App\Models\UserTag;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Mail\TagStatusMail;
use Illuminate\Support\Facades\Log;
use App\Mail\TripTrackTagScannedMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class UserTagController extends Controller
{

    public function generateTags($qty)
    {
        
        $quantity = (int) $qty; // Ensure integer
        $tags = [];
    
        for ($i = 0; $i < $quantity; $i++) {
    
            // Generate a unique tag_id
            do {
                $tag_id = strtoupper(Str::random(7, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'));
            } while (UserTag::where('tag_id', $tag_id)->exists());
    
            // Create the QR Code URL
            $link = url('scan/' . $tag_id);
            
            // Convert QR code to PNG and store it
            $qrCode = QrCode::format('png')->size(150)->generate($link);
            $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCode);
    
            // Save the tag
            $tag = UserTag::create([
                'tag_id' => $tag_id,
                'qr_code' => $qrCodeBase64, // Storing as Base64
            ]);
    
            $tags[] = [
                'tag_id' => $tag->tag_id,
                'qr_code' => $qrCodeBase64,
                'scan_url' => $link,
            ];
        }
    
        return response()->json([
            'message' => 'Tags generated successfully',
            'tags' => $tags,
        ]);
    }

    public function bagDetails($tag_id)
    {   
        $userTag =  UserTag::with('user:id,country_code,mobile')->where('tag_id',$tag_id)->first();

        if(empty($userTag)){
            $msg = 'Invalid Tag Id';
            return view('customErrors.404',compact('msg'));
        }
        else{

            return view('auth.update', compact('userTag'));
        }

    }

    public function updateTagOperation(Request $request)
    {
        $request->validate([
            'valuable_type' => ['required'],
            'display_name' => ['required', 'string', 'max:255'],
            'bag_brand' => ['required', 'string', 'max:255'],
            'country_code' => ['required', 'string', 'max:10'],
            'mobile' => ['required', 'string', 'max:12'],
            'tag_id' => ['required'],
            'tag_image_file_name' => ['required']
        ]);
    
        // Retrieve the UserTag along with its associated user
        $userTag = UserTag::with('user')->where('tag_id', $request->tag_id)->firstOrFail();
    
        // Update UserTag fields
        $userTag->display_name = $request->display_name;
        $userTag->bag_brand = $request->bag_brand;
        $userTag->valuable_type = $request->valuable_type;
        $userTag->tag_image = $request->tag_image_file_name;
        $userTag->save(); // Save UserTag
    
        // Update associated User model
        if ($userTag->user) {
            $userTag->user->country_code = $request->country_code;
            $userTag->user->mobile = $request->mobile;
            $userTag->user->save(); // Explicitly save user model
        }
    
        return redirect()->route('user-dashboard')->with('success', 'Bag Details Updated Successfully.');
    }
    
    public function changeTagStatus($id, $status)
    {
        $tag = UserTag::with('user')->where('tag_id', $id)->first();
    
        if ($tag) {
            if ($status == 'report_lost') {
                $tag->tag_status = 'Report Lost';
                $tag->save();
    
                // Send Mail for Lost
                // Mail::to($tag->user->email)->send(new TagStatusMail($tag->user->first_name, $tag->tag_id, 'Lost'));
            }
            elseif ($status == 'report_found') {
                $tag->tag_status = 'active';
                $tag->save();
    
                // Send Mail for Found
                Mail::to($tag->user->email)->send(new TagStatusMail($tag->user->first_name, $tag->tag_id, 'Found'));
            }
            else {
                $tag->tag_status = $status;
                $tag->save();
    
                // Send Mail for Active/Inactive Status
                Mail::to($tag->user->email)->send(new TagStatusMail($tag->user->first_name, $tag->tag_id, ucfirst($status)));
            }
    
            return redirect()->back()->with('success', 'Tag Status Updated Successfully!');
        } else {
            return redirect()->back()->with('error', 'Tag Not Found!');
        }
    }
    
    public function scanResult($tag_id)  {
        try {

            $userTag = UserTag::with('user')->where('tag_id', $tag_id)->first();

            if(empty($userTag)){
                $msg = 'Invalid Tag Id';
                return view('customErrors.404',compact('msg'));
                
            }
            elseif($userTag->tag_status == 'fresh'){

                return redirect('signUp/' .$tag_id);
                
            }else{

                $email = $userTag->user->email;
            
                // Mail::to($email)->send(new TripTrackTagScannedMail($userTag->display_name));
                // Log::info("Email successfully sent to: $email");
                return view('found_item', compact('userTag'))->with('success', 'Process completed.');
            }

        } catch (\Exception $e) {
            Log::error("Failed to send email: " . $e->getMessage());
            return back()->with('error', 'Failed to send email.');
        }
    }

    public function sendLocationEmail(Request $request) {
        try {
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            
            $email = $request->userTag['user']['email'];
            
            $googleMapUrl = "https://www.google.com/maps/?q={$latitude},{$longitude}";

            // $googleMapUrl = "https://www.google.com/maps?q={$latitude},{$longitude}&z=18&hl=en&output=embed";
    
            // Screenshot URL with Puppeteer
            $screenshotPath = $this->captureMapScreenshot($googleMapUrl, uniqid('map_', true)); // Unique filename with prefix
            
            if (!$screenshotPath) {
                \Log::error("Screenshot generation failed for URL: {$googleMapUrl}");
            }
            
            // Send email with screenshot
            Mail::send('emails.triptrack_tag_scanned', [    
                'mapImage' => $screenshotPath ?: asset('assets/images/default_map.jpg'), // Fallback Image
                'userTag' => $request->userTag,
                'googleMapUrl' => $googleMapUrl
            ], function ($message) use ($email) {
                $message->to($email)->subject('Important Alert: TripTrack Bag Security Tag Scanned');
            });
            
            return response()->json(['message' => 'Email Sent Successfully']);
        } catch (\Exception $e) {
            \Log::error("Error in sendLocationEmail: " . $e->getMessage());
            return response()->json(['message' => 'Something went wrong. Please try again later.'], 500);
        }
    }
    
    private function captureMapScreenshot($url, $fileName)
    {
        $folderPath = storage_path("app/public/map_screenshots");
    
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0777, true, true);
        }
    
        $imagePath = $folderPath . "/$fileName";
        $command = "/usr/bin/node /var/www/html/puppeteer/screenshot.mjs \"$url\" \"$imagePath\" 2>&1";
        putenv("HOME=/var/www/html");
        putenv("USER=root");
        $output = shell_exec($command);
    
        Log::info("Screenshot command output: " . $output);
    
        if (file_exists($imagePath)) {
            Log::info("Screenshot generated successfully: " . $imagePath);
            return asset("storage/map_screenshots/$fileName"); // Public URL return 
        } else {
            Log::error("Screenshot generation failed for URL: $url");
            return null;
        }
    }

}

