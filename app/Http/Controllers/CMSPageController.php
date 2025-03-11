<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Mail\InquiryMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;


class CMSPageController extends Controller
{
    public function collectionView($type) {

        if($type == 'about-us'){
            return view('website.cms_page.about-us');
        }
        elseif($type == 'refund-policy'){
            return view('website.cms_page.refund-policy');
        }
        elseif($type == 'contact-us'){
            return view('website.cms_page.contact-us');
        }
        elseif($type == 'terms-of-service'){
            return view('website.cms_page.terms-of-service');
        }
        elseif($type == 'grow-with-triptrack'){
            return view('website.cms_page.grow-with-triptrack');
        }
        else{
            $msg = 'Page Not Found';
            return view('customErrors.404',compact('msg'));
        }
        
    }

    public function contactUsOpration(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'mobile'     => 'required|numeric',
            'email'      => 'required|email',
            'message'    => 'required|string',
        ]);

        $inquiry = Inquiry::create($request->all());

        // Send Email to Admin
        Mail::to('triptrack88@gmail.com')->send(new InquiryMail($request->all()));

        return redirect()->back()->with('success', 'Inquiry submitted successfully!');
    }

}
