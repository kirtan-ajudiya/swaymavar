<?php

namespace App\Http\Controllers\AppController;

use App\Http\Controllers\Controller;
use App\Country;
use Hash;
use DB;
use Illuminate\Http\Request;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");
class LocationController extends Controller
{

    public function getcountries(){
        $responseData = Country::get();
        return $responseData;
    }

}
