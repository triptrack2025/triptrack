<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserTag;
use App\Models\Product;


use Carbon\Carbon;

class UserController extends Controller
{

    private $bestSellers;
    private $populerProducts;

    public function __construct()
    {
        // Fetch only 4 Best Seller Products
        $this->bestSellers = Product::with('images')
            ->where('is_best_seller', 1)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();

        // Fetch only 8 Popular Products
        $this->populerProducts = Product::with('images')
            ->where('is_popular_product', 1)
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();
    }

    public function login(): View
    {
        if (Auth::check()) {
            return view('website.index', [
                'bestSellers' => $this->bestSellers,
                'populerProducts' => $this->populerProducts
            ]);
        }
        return view('auth.login');
    }
    
    public function loginOperation(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Check if user exists with email and password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            
            // Check if the logged-in user is active
            if (Auth::user()->user_status === 'active') {
                return redirect('/dashboard');
            }
    
            // Logout and return error if user is inactive
            Auth::logout();
            return back()->withErrors(['email' => 'User is inactive.'])->withInput();
        }
    
        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function signUp($tag_id = 0)
    {
       if($tag_id ==  0){

            if (Auth::check()) {
                return view('website.index', [
                    'bestSellers' => $this->bestSellers,
                    'populerProducts' => $this->populerProducts
                ]);
            }
            return view('auth.register');

       }else{

            $userTag = UserTag::where(['tag_id' => $tag_id, 'tag_status' => 'active'])->first();

            if($userTag){

                return redirect('/scan/'.$tag_id);
            
            }else{
                return view('auth.scan_with_register',compact('tag_id'));

            }
       }
        
    }

    public function registerOperation(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'country_code' => ['required', 'string','max:3'],
            'mobile' => ['required', 'string', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
        ]);

       $user =  User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country_code' => $request->country_code,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Fire the Registered event to send email verification
        event(new Registered($user));

        return redirect('login')->with('success', 'Account created successfully. Please Verify Your Email To Activate your account.');
    }

    public function scanWithRegisterOperation(Request $request)
    {
        $request->validate([
            'valuable_type' => ['required'],
            'display_name' => ['required', 'string', 'max:255'],
            'bag_brand' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'country_code' => ['required', 'string','max:3'],
            'mobile' => ['required', 'string', 'max:12'],
            'password' => ['required', Password::defaults()],
            'tag_id' => ['required'],
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        // Handle Image Upload
        $imagePath = null;
        if ($request->hasFile('imageUpload')) {
            $file = $request->file('imageUpload');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/'), $imageName); 
            $imagePath = 'assets/images/' . $imageName;
        } else {
            $imagePath = 'assets/images/' . $request->input('tag_image_file_name'); // Use provided image filename
        }
    
        if (!empty($user)) {
            $isFreshUserTag = UserTag::where('tag_id', $request->tag_id)
                                      ->where('tag_status', 'fresh')
                                      ->first();
    
            if ($isFreshUserTag) {
                $userTag = UserTag::updateOrCreate(
                    ['tag_id' => $request->tag_id],
                    [
                        'user_id' => $user->id,
                        'valuable_type' => $request->valuable_type,
                        'display_name' => $request->display_name,
                        'bag_brand' => $request->bag_brand,
                        'tag_active_date' => Carbon::now()->toDateString(),
                        'tag_status' => 'active',
                        'tag_image' => $imagePath
                    ]
                );
    
                $user->update([
                    'country_code' => $request->country_code,
                    'mobile' => $request->mobile,
                    'password' => Hash::make($request->password),
                    'user_status' => 'active'
                ]);
    
                Auth::logout();
    
                if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
                    return response()->json(['message' => 'Dashboard Redirect', 'redirect' => route('user-dashboard')]);
                }
            } else {
                return response()->json(['error' => 'Invalid Tag Id.'], 404);
            }
        } else {
            // Encrypt only simple data (avoid serializing files)
            $encryptedEmail = encrypt($request->email);
            $encryptedData = encrypt([
                'valuable_type' => $request->input('valuable_type'),
                'display_name' => $request->input('display_name'),
                'bag_brand' => $request->input('bag_brand'),
                'country_code' => $request->input('country_code'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
                'tag_id' => $request->input('tag_id'),
                'tag_image_file_name' => $imagePath // Store image path, not file
            ]);
    
            // Send verification email
            $verifyLink = route('user-email.verify', ['email' => $encryptedEmail, 'data' => $encryptedData]);
    
            $message = "Please verify your email by clicking below:";
            $emailContent = "<p>{$message}</p><a href='{$verifyLink}' style='padding:10px 20px;background:#007BFF;color:#fff;text-decoration:none;border-radius:5px;'>Verify Email</a>";
    
            Mail::html($emailContent, function ($message) use ($request) {
                $message->to($request->email)->subject('Email Verification');
            });
    
            return response()->json(['message' => 'Verification email sent successfully!']);
        }
    
        return response()->json(['error' => 'User not found.'], 404);
    }

    public function verifyEmail(Request $request)
    {
        try {
            $requestData = decrypt($request->input('data'));
            $email = decrypt($request->input('email'));

            // Create User
            $user = User::create([
                'first_name' => $requestData['display_name'],
                'email' => $email,
                'country_code' => $requestData['country_code'],
                'mobile' => $requestData['mobile'],
                'password' => Hash::make($requestData['password']),
                'user_status' => 'active'
            ]);

            // Prepare UserTag Data
            $userTagData = [
                'user_id' => $user->id,
                'valuable_type' => $requestData['valuable_type'],
                'display_name' => $requestData['display_name'],
                'bag_brand' => $requestData['bag_brand'],
                'tag_active_date' => Carbon::now()->toDateString(),
                'tag_status' => 'active',
                'tag_image' => $requestData['tag_image_file_name'] // Use stored image path
            ];

            // Create or Update UserTag
            UserTag::updateOrCreate(
                ['tag_id' => $requestData['tag_id']],
                $userTagData
            );

            // Logout and Login User
            Auth::logout();

            if (Auth::attempt(['email' => $user->email, 'password' => $requestData['password']])) {
                return redirect('/dashboard')->with('success', 'Email verified successfully!');
            }

            return redirect('/login')->with('error', 'Login failed. Please try again.');

        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Invalid or expired verification link.');
        }
    }

    public function dashboard() {
        $userTags = UserTag::where('user_id', auth()->user()->id)->OrderBy('tag_active_date', 'desc')->paginate(3); // Paginate with 5 items per page
        return view('website.dashboard', compact('userTags'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
