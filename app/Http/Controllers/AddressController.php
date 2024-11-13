<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            "address"=>"required",
            "city"=>"required",
            "state"=>"required",
            "zip"=>"required",
            "country_id"=>"required"
        ]);
        $address = new UserAddress();

        $address->user_id = Auth::user()->id; 
        $address->address = $request->address;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->zip = $request->zip;
        $address->country_id = $request->country_id;
        $address->save();

        return response()->json([
            'message' => 'Address successfully created!',
            'data' => $address
        ], 200);

    }
}
