<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminUser;
use App\Models\UserTag;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;


class DashboardController extends Controller
{

    public function genrateNewQr() {

        return view('admin.genrate-new-qr.create');

    }

    public function generateTags(Request $request)
    {
        $request->validate([
            'qr_code_quantity' => 'required|numeric|min:0',
        ]);

        $qty = $request->qr_code_quantity;
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
            $qrCode = QrCode::format('png')->size(50)->generate($link);
            $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCode);
            $qrCodeImage = QrCode::size(100)->generate($link);

            // Save the tag
            $tag = UserTag::create([
                'tag_id' => $tag_id,
                'qr_code' => $qrCodeBase64, // Storing as Base64
            ]);
    
            $tags[] = [
                'tag_id' => $tag_id,
                'qr_code' => $qrCodeImage,
            ];
        }

        return view('admin.genrate-new-qr.index',compact('tags'));

    }

    public function dashboard(){

        return view('admin.index');
    }

    public function showLoginForm(Request $request)
    {        
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
        
    }

    public function loginOperation(Request $request)
    {
        
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $admin = AdminUser::where('email', $request->username)
                  ->orWhere('username', $request->username)
                  ->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'User not found'])->withInput();
        }

        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['password' => 'Incorrect password'])->withInput();
        }

        if ($admin->status != 'active') {
            return back()->withErrors(['status' => 'Account is inactive'])->withInput();
        }

        Auth::guard('admin')->login($admin);
        
        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout(); // Custom Guard Logout

        return redirect()->route('admin.login');
       
    }
}