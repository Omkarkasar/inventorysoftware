<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function clientstore(Request $request)
    {
        $data=new Client();
        $data->username=$request->username;
        $data->email=$request->email;
        $data->save();

        return response()->json(['success','Client Data Stored Succesfully']);
    }
}
