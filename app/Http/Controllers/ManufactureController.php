<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManufactureController extends Controller
{
    public function storeManufacturer(Request $request)
    {
       $manufacture = new Manufacturer();
         $manufacture->name = $request->name;
            $manufacture->email = $request->email;
            $manufacture->contact = $request->contact;
            $manufacture->address = $request->address;
            $manufacture->status = $request->status;
            $manufacture->password = Hash::make($request->password);
            $manufacture->save();
            // if($manufacture->status == 'pending'){

            // }
            return redirect()->route('filament.manufacturer.auth.login');
    }
}
