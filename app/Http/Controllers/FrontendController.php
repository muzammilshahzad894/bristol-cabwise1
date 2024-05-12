<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Fleet;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    public function index()
    {
        return view('frontend.index');
    }

    public function booking()
    {
        if(Auth::check())
        {
            $data=Fleet::all();
            return view('frontend.booking',compact('data'));
        }

        return redirect()->route('user.login.show');

    }

    public function quote()
    {
        $data=Fleet::all();
            return view('frontend.quote',compact('data'));

    }

    public function fleets()
    {
        $data=Fleet::all();
        return view('frontend.fleets',compact('data'));

    }

    public function fleetsDetails($id)
    {
        $data=Fleet::with('features','images')->findOrFail($id);
        return view('frontend.fleets_details',compact('data'));

    }

    public function services()
    {
        return view('frontend.services');
    }

}