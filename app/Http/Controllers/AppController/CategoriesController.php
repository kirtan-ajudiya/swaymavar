<?php

namespace App\Http\Controllers\AppController;

use App\Http\Controllers\Controller;
use App\Category;
use Hash;
use DB;
use Illuminate\Http\Request;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");
class CategoriesController extends Controller
{

    public function getcategories(){
        $responseData = Category::get();
         $userResponse = json_encode($responseData);
        return $userResponse;
    }

}
