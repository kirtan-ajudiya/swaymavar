<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use Hash;
use App\Category;
use App\FlashDeal;
use App\Brand;
use App\SubCategory;
use App\SubSubCategory;
use App\Product;
use App\Fabric;
use App\Occasion;
use App\PickupPoint;
use App\CustomerPackage;
use App\CustomerProduct;
use App\User;
use App\Seller;
use App\Shop;
use App\MetalType;
use App\Color;
use App\MetalColor ;
use App\Order;
use App\JewelleryType;
use App\BusinessSetting;
use App\Http\Controllers\SearchController;
use ImageOptimizer;
use Cookie;
use Mail;
use App\Mail\EmailManager;

class HomeController extends Controller
{
    public function login()
    {
      
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('frontend.user_login');
    }

    public function registration(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        if($request->has('referral_code')){
            Cookie::queue('referral_code', $request->referral_code, 43200);
        }
        return view('frontend.user_registration');
    }

    public function user_login(Request $request)
    {
        $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $request->email)->first();
        if($user != null){
            if(Hash::check($request->password, $user->password)){
                if($request->has('remember')){
                    auth()->login($user, true);
                }
                else{
                    auth()->login($user, false);
                }
                return redirect()->route('dashboard');
            }
        }
        return back();
    }

    public function contactus(){
        return view("frontend.pages.contact-us");
    }

    public function forgotPassword()
    {
        return view('frontend.forgot-password');
    }

    public function cart_login(Request $request)
    {
        $user = User::whereIn('user_type', 'customer')->where('email', $request->email)->first();
        if($user != null){
            updateCartSetup();
            if(Hash::check($request->password, $user->password)){
                if($request->has('remember')){
                    auth()->login($user, true);
                }
                else{
                    auth()->login($user, false);
                }
            }
            flash(__('Login successfully!'))->success();
        }else{
             flash(__('Email Or Phone Is Wrong!'))->error();
        }
        return back();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard()
    {
        return view('dashboard');
    }

    /**
     * Show the customer/seller dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if(Auth::user()->user_type == 'customer'){
            $user = User::where('id', Auth::user()->id)->first();
            $orders = Order::where('user_id', Auth::user()->id)->get()->take(10);
            return view('frontend.dashboard.dashboard', compact('user', 'orders'));
        }
        else {
            abort(404);
        }
    }

    public function gift_balnce()
    {
        return view('frontend.dashboard.gift_balance');
    }

    public function profileEdit(Request $request)
    {
        if(Auth::user()->user_type == 'customer'){
            $user = User::where('id', Auth::user()->id)->first();
        
            return view('frontend.dashboard.profile-edit', compact('user'));
        }
    }

    public function customer_update_profile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);
        $receive_newsletters = isset($data['receive_newsletters']) && $data['receive_newsletters']=='1'?true:false;
        $get_updates = isset($data['get_updates']) && $data['get_updates']=='1'?true:false;

        $user = Auth::user();
        $user->title = $request->title;
        $user->name = $request->name;
        $user->birth_date = $request->birth_date;
        $user->birth_month = $request->birth_month;
        $user->birth_year = $request->birth_year;
        $user->anniversary_date = $request->anniversary_date;
        $user->anniversary_month = $request->anniversary_month;
        $user->encircle_id = $request->encircle_id;
        $user->receive_newsletters = $receive_newsletters;
        $user->get_updates = $get_updates;
        $user->phone = $request->phone;

        if($user->save()){
            flash(__('Your Profile has been updated successfully!'))->success();
            return redirect()->route('dashboard');
        }

        flash(__('Sorry! Something went wrong.'))->error();
        return redirect()->route('dashboard');
    }

    public function pincode(Request $request)
    {
       // dd($request->code);
        $url = 'https://api.postalpincode.in/pincode/'.$request->code;
        $json = json_decode(file_get_contents($url), true);
     //  dd($json);
        $district = $json[0]['PostOffice'][0]['District'];
        $state = $json[0]['PostOffice'][0]['State'];

        if($district && $state){
            return response()->json(['district'=>$district, 'state'=>$state, 'status'=>true]);
        }else{
            return response()->json(['status'=>false]);
        }

    }


    public function seller_update_profile(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->postal_code = $request->postal_code;
        $user->phone = $request->phone;

        if($request->new_password != null && ($request->new_password == $request->confirm_password)){
            $user->password = Hash::make($request->new_password);
        }

        if($request->hasFile('photo')){
            $user->avatar_original = $request->photo->store('uploads');
        }

        $seller = $user->seller;
        $seller->cash_on_delivery_status = $request->cash_on_delivery_status;
        $seller->bank_payment_status = $request->bank_payment_status;
        $seller->bank_name = $request->bank_name;
        $seller->bank_acc_name = $request->bank_acc_name;
        $seller->bank_acc_no = $request->bank_acc_no;
        $seller->bank_routing_no = $request->bank_routing_no;

        if($user->save() && $seller->save()){
            flash(__('Your Profile has been updated successfully!'))->success();
            return back();
        }

        flash(__('Sorry! Something went wrong.'))->error();
        return back();
    }

    public function passwordreset()
    {
        return view('frontend.password-reset');
    }

    public function ForgotPassword_verify(Request $request)
    {
        $email = $request->email;
        if(isset($email)){
            $user = User::where('email', $email)->first();
            if($user != null){
                $to = $email;
                $subject = 'Forgot Password';
                $from = 'kp.codealphainfotech@gmail.com';
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $otp = rand(1000, 9999);
                $headers .= 'From: '.$from."\r\n".
                    'Reply-To: '.$from."\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                 
                $message = '<html><body>';
                $message .= ' <p>Your One Time Otp is:'.$otp.'</p>';
                $message .= '</body></html>';
                 
                try {
                  $mail = mail($to, $subject, $message, $headers);
                  if($mail == true){
                    $user = User::where('email', $email)
                    ->update(['verification_code' => $otp]);
                    if($user == true){
                        return response()->json(['otp'=>$otp, 'status'=>true]);
                    }
                  }
                } catch (\Throwable $th) {
                    // dd($th) ;
                    abort(404);
                }
            }else{
                return response()->json(['status'=>false]);
            }
        }else{
            flash(__('Email Or Phone Is Wrong!'))->error();
            return back();
        }
    }   

    public function PasswordSubmit(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(isset($user) && $user != ""){
            if($user->otp == $request->otp){
                $user = User::where('email',  $request->email)->update(['password' => Hash::make($request->password)]);
                if($user == true){
                    return response()->json(['status'=>true]);
                }
            }else{
                return response()->json(['status'=>false, 'type'=>2]);
            }

        }else{
            return response()->json(['status'=>false]);
        }
    }

    public function userOtpSubmit(Request $request)
    {
        $user = User::where('email', $request->email)->where('verification_code', $request->otp)->where('user_type', 'customer')->first();
        if($user != ""){
            Session::put('email',$request->email);
            return response()->json(['email'=> $request->email, 'status'=>true]);
        }else{
            return response()->json(['status'=>false]);
        }
    }

    public function NewPassword()
    {
        return view('frontend.new-password');
    }

    public function login_with_password(Request $request)
    {
        if($request->phone == ''){
            return array('status'=>false);
        }

        if(is_numeric($request->phone)){
            $user = User::whereIn('user_type', ['customer'])->where('phone', $request->phone)->first();
        }else{
            $user = User::where('email', $request->phone)->first();
        }

        if($user != null){
            if(Hash::check($request->password, $user->password)){  
                auth()->login($user, true);
                return array('status'=>true);
            }
        }
        return array('status'=>false);

    }

    public function userNewpassword(Request $request)
    {
        $email=Session::get('email');
        $newpassword = $request->newpassword;
        $conpassword = $request->newcpassword;
        if($newpassword == $conpassword){
            $user = User::where('email', $email)->update(['password' => Hash::make($newpassword)]);
            if($user == true){
                flash(__('Password Change Successfully..'))->success();
                return redirect()->route('user.login');
            }
        }else{
            flash(__('Password does not match with Conform Password..'))->error();
            return back();
        }
    }

    public function document(Request $request)
    {
         return view('frontend.seller.document');
    }

    public function upload_doc(Request $request){
     

         $seller = Auth::user()->seller;
         if($request->hasFile('adharfront')){
          $seller->adhar_front = $request->adharfront->store('uploads/seller_docs');       
         }
         if($request->hasFile('adharback')){
          $seller->adhar_back = $request->adharback->store('uploads/seller_docs');
         }
         if($request->hasFile('panfront')){
          $seller->pan_front = $request->panfront->store('uploads/seller_docs');
         }
         if($request->hasFile('gstpdf')){
          $seller->gst_pdf = $request->gstpdf->store('uploads/seller_docs');
         }

        $seller->adhar_no = $request->adharno;
        $seller->pan_no = $request->panno;
        $seller->gst_no = $request->gstno;
        if($seller->save()){
            flash(__('Your Document has been updated successfully!'))->success();
            return back();
        }
        flash(__('Sorry! Something went wrong.'))->error();
        return back();
    }

    /**
     * Show the application frontend home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.index');
    }

    public function flash_deal_details($slug)
    {
        $flash_deal = FlashDeal::where('slug', $slug)->first();
        if($flash_deal != null)
            return view('frontend.flash_deal_details', compact('flash_deal'));
        else {
            abort(404);
        }
    }

    public function load_featured_section(){
        return view('frontend.partials.featured_products_section');
    }

    public function load_best_selling_section(){
        return view('frontend.partials.best_selling_section');
    }

    public function load_home_categories_section(){
        return view('frontend.partials.home_categories_section');
    }

    public function load_best_sellers_section(){
        return view('frontend.partials.best_sellers_section');
    }

    public function trackOrder(Request $request)
    {
        if($request->has('order_code')){
            $order = Order::where('code', $request->order_code)->first();
            if($order != null){
                return view('frontend.track_order', compact('order'));
            }
        }
        return view('frontend.track_order');
    }

    public function product(Request $request, $slug)
    {
        $detailedProduct  = Product::where('slug', $slug)->first();
        $detailedProduct->most_view = $detailedProduct->most_view + 1;
        $detailedProduct->save();
        if($detailedProduct!=null && $detailedProduct->published){
            updateCartSetup();
            if($request->has('referral_code')){
                Cookie::queue('referral_code', $request->referral_code, 43200);
            }
            return view('frontend.product_details', compact('detailedProduct'));
        }
        abort(404);
    }

    public function shop($slug)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if($shop!=null){
            $seller = Seller::where('user_id', $shop->user_id)->first();
            if ($seller->verification_status != 0){
                return view('frontend.seller_shop', compact('shop'));
            }
            else{
                return view('frontend.seller_shop_without_verification', compact('shop', 'seller'));
            }
        }
        abort(404);
    }

    public function filter_shop($slug, $type)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if($shop!=null && $type != null){
            return view('frontend.seller_shop', compact('shop', 'type'));
        }
        abort(404);
    }

    public function listing(Request $request)
    {
        // $products = filter_products(Product::orderBy('created_at', 'desc'))->paginate(12);
        // return view('frontend.product_listing', compact('products'));
        return $this->search($request);
    }

    public function all_categories(Request $request)
    {
        $categories = Category::all();
        return view('frontend.all_category', compact('categories'));
    }
    public function all_brands(Request $request)
    {
        $categories = Category::all();
        return view('frontend.all_brand', compact('categories'));
    }

    public function show_product_upload_form(Request $request)
    {
        $categories = Category::all();
        return view('frontend.seller.product_upload', compact('categories'));
    }

    public function show_product_edit_form(Request $request, $id)
    {
        $categories = Category::all();
        $product = Product::find(decrypt($id));
        return view('frontend.seller.product_edit', compact('categories', 'product'));
    }

    public function seller_product_list(Request $request)
    {
        $products = Product::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.seller.products', compact('products'));
    }

    public function ajax_search(Request $request)
    {
        $keywords = array();
        $products = Product::where('published', 1)->where('tags', 'like', '%'.$request->search.'%')->get();
        foreach ($products as $key => $product) {
            foreach (explode(',',$product->tags) as $key => $tag) {
                if(stripos($tag, $request->search) !== false){
                    if(sizeof($keywords) > 5){
                        break;
                    }
                    else{
                        if(!in_array(strtolower($tag), $keywords)){
                            array_push($keywords, strtolower($tag));
                        }
                    }
                }
            }
        }

        $products = filter_products(Product::where('published', 1)->where('name', 'like', '%'.$request->search.'%'))->get()->take(3);

        $subsubcategories = SubSubCategory::where('name', 'like', '%'.$request->search.'%')->get()->take(3);

        $shops = Shop::whereIn('user_id', verified_sellers_id())->where('name', 'like', '%'.$request->search.'%')->get()->take(3);

        if(sizeof($keywords)>0 || sizeof($subsubcategories)>0 || sizeof($products)>0 || sizeof($shops) >0){
            return view('frontend.partials.search_content', compact('products', 'subsubcategories', 'keywords', 'shops'));
        }
        return '0';
    }

    public function ajax_lode_more_product(Request $request)
    { 
      try {
        $query = $request->q;
        $totol_product = 0;
        $discount_filter = 3;
        $price_filter = 5;
        // $limit = 6;
        // if(isset($request->page)){
        //     $page = $request->page;
        // }else{
        //     $page = 1;
        // }
        
        // $limit = $page * $limit;
        $sort_by = $request->sort;
        $category_id = (Category::where('slug', $request->category)->first() != null) ? Category::where('slug', $request->category)->first()->id : null;
        $subcategory_id = (SubCategory::where('slug', $request->subcategory)->first() != null) ? SubCategory::where('slug', $request->subcategory)->first()->id : null;
        $colors = array();
        $gender = array();
        if($request->gender != null){
            array_push($gender,$request->gender);
        }
        if($request->color !=null && $request->colorss != null){
            $id = MetalColor::where('slug', $request->colorss)->first();
            if(isset($id)){
                array_push($colors, $id->id);
                $colors = array_merge($colors, $request->color);
                $colors = array_unique($colors);
            }
        }elseif ($request->color != null) {
            $colors = array_merge($colors, $request->color);
        }else{
            $id = MetalColor::where('slug', $request->colorss)->first();
            if(isset($id)){
                array_push($colors, $id->id);
            }
        }
        $priceval = $request->price;
        $minprice = array();
        $price = null;
        $frice = array();
        if($priceval !="" && $request->hprice != ""){
            foreach($priceval as $prices){
                $price = explode("-", $prices) ;
                array_push($minprice, $price[0], $price[1]);
            }
            $ex =  explode("-", $request->hprice);
            array_push($minprice, $ex[0], $ex[1]);
            array_push($frice, $request->hprice, $request->price);
            $frice = array_merge($frice, $request->price);
        }elseif($priceval != ""){
            foreach($priceval as $prices){
                $price = explode("-", $prices) ;
                array_push($minprice, $price[0], $price[1]);
                array_push($frice, $request->price);
                $frice = array_merge($frice, $request->price);
            }
        }elseif($request->hprice != ""){
            $ex = explode("-", $request->hprice);
            array_push($minprice, $ex[0], $ex[1]);
            array_push($frice, $request->hprice);
        }else{
            $minprice = null;
            $frice = null;
        }

        if(isset($minprice)){
            $finalprice = array_unique($minprice);
            $min_price = min($minprice);
            $max_price = max($minprice);
        }

        $jewellery_type = $request->jewellery_type;
        $metals = $request->metal;
        $purityies = $request->purity;
        $cliarity = $request->cliarity;
        $categories = $request->category;
        $diamond_type =$request->type;
       
        $conditions = ['published' => 1];
        // if($category_id != null){
        //     $conditions = array_merge($conditions, ['category_id' => $category_id]);
        // }
        if($subcategory_id != null){
            $conditions = array_merge($conditions, ['subcategory_id' => $subcategory_id]);
        }

        $products = Product::where($conditions);
        if($query != null){
            $products = $products->where('name', 'like', '%'.$query.'%');
        }

        $filtered_array = "";
        if(!empty($gender)){
            $filtered_array = array_filter($gender[0]);
            if(!empty( $filtered_array )){
                $products = $products->whereIn('gender',$filtered_array);
            }
        }
        if(!empty($colors)){
            $products = $products->whereIn('metal_color', $colors);
        }

        if(!empty($categories)){
            if(!is_array($categories)){
                $cat = Category::where('slug', $request->category)->first()->id;
                $categories = array();
                array_push($categories, $cat);
            }
            $products = $products->whereIn('category_id',$categories);
        }

        if(!empty($jewellery_type)){
            $products = $products->whereIn('jewellery_type',$jewellery_type);
        }

        if(!empty($purityies)){
            $products = $products->whereIn('carat_type',$purityies);
        }

        if(isset($diamond_type) && $diamond_type != ""){
            $type = $diamond_type;
            if($type == 'diamond-jewellery'){
                $name= 'DIAMOND JEWELLERY';
                $diamond = JewelleryType::where('name', $name)->first();
            }elseif($type == 'gold-jewellery'){
                $name= 'GOLD JEWELLERY';
                $diamond = JewelleryType::where('name', $name)->first();
            }
            $products = $products->where('jewellery_type', $diamond->id);
            $jewellery_type = array($diamond->id);
        }
        if($sort_by != null){
            switch ($sort_by) {
                case '1':
                    $products->orderBy('created_at', 'desc');
                    break;
                case '2':
                    $products->where('most_view','!=', 0)->orderBy('most_view', 'desc');
                    break;
                default:
                  //code...
                // break;
            }
        }

       
        $products = filter_products($products)->get();
        $product_array = array();
        $product_array_final = array();
        $totol_product = 0;
        $numcounter = 1;
        foreach($products as $key=>$product){
            $numcounter += 1;
            $product['final_price_filter'] = $product->unit_price;
            $product['discount_filter'] = "";
            $product['final_price'] = $product->unit_price;
            $product['discount'] ="";
            if(isset($min_price) && isset($max_price)){
                if($min_price <= $product['final_price_filter'] && $max_price >= $product['final_price_filter']){
                    $product_array_final[] = $product;
                }
            }else{
                $product_array_final[] = $product;
            }
        }

        foreach($product_array_final as $key=>$product_data){
                $product_array[] = $product_data;
            $totol_product += 1;
        }

 
        if($request->sort == 3){
            $discount_filter = 4;
            if(!empty($product_array)){
                foreach ($product_array as $key => $part) {
                    $sort[$key] = $part['discount_filter'];
                }
                array_multisort($sort, SORT_DESC, $product_array);
            }
        }
        if($request->sort == 4){
            $discount_filter = 3;
            if(!empty($product_array)){
                foreach ($product_array as $key => $part) {
                    $sort[$key] = $part['discount_filter'];
                }
                array_multisort($sort, SORT_ASC , $product_array);
            }
        }

        if($request->sort == 5){
            $price_filter = 6;
            if(!empty($product_array)){
                foreach ($product_array as $key => $part) {
                    $sort[$key] = $part['final_price_filter'];
                }
             array_multisort($sort, SORT_DESC , $product_array);
            }
        }
        if($request->sort == 6){
            $price_filter = 5;
            if(!empty($product_array)){
                foreach ($product_array as $key => $part) {
                    $sort[$key] = $part['final_price_filter'];
                }
               array_multisort($sort, SORT_ASC , $product_array);
            }
        }
        $products = $product_array;
        $flag=true;
        // if($totol_product >= $limit){
        //     $flag=false;
        // }

        $count_product = count($products);
        $product_string = "You are viewing ".$count_product." out of ".$totol_product." products";
        $returnHTML = view('frontend.lode_more',compact('frice','purityies','colors','jewellery_type','categories','count_product',
                            'filtered_array', 'price_filter','discount_filter', 'products', 'query', 'category_id', 
                            'subcategory_id','sort_by'))->render();
        return response()->json(['html'=>$returnHTML, 'page_flag'=>$flag, 'product_string'=>$product_string]);
        } catch (\Throwable $th) {
            dd($th);
            abort(404);
        }
    }

    public function search(Request $request)
    {
        return view('frontend.product_listing');
    }

    public function product_content(Request $request){
        $connector  = $request->connector;
        $selector   = $request->selector;
        $select     = $request->select;
        $type       = $request->type;
        productDescCache($connector,$selector,$select,$type);
    }

    public function home_settings(Request $request)
    {
        return view('home_settings.index');
    }

    public function top_10_settings(Request $request)
    {
        foreach (Category::all() as $key => $category) {
            if(in_array($category->id, $request->top_categories)){
                $category->top = 1;
                $category->save();
            }
            else{
                $category->top = 0;
                $category->save();
            }
        }

        foreach (Brand::all() as $key => $brand) {
            if(in_array($brand->id, $request->top_brands)){
                $brand->top = 1;
                $brand->save();
            }
            else{
                $brand->top = 0;
                $brand->save();
            }
        }

        flash(__('Top 10 categories and brands have been updated successfully'))->success();
        return redirect()->route('home_settings.index');
    }

    public function variant_price(Request $request)
    {
        $product = Product::find($request->id);
        $str = '';
        $quantity = 0;

        if($request->has('color')){
            $data['color'] = $request['color'];
            $str = Color::where('code', $request['color'])->first()->name;
        }

        foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
            if($str != null){
                $str .= '-'.str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
            }
            else{
                $str .= str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
            }
        }

        if($str != null && $product->variant_product){
            $product_stock = $product->stocks->where('variant', $str)->first();
            $price = $product_stock->price;
            $quantity = $product_stock->qty;
        }
        else{
            $price = $product->unit_price;
            $quantity = $product->current_stock;
        }
        
        //discount calculation
        $flash_deals = \App\FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $key => $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
                $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $price -= ($price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }

        if($product->tax_type == 'percent'){
            $price += ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $price += $product->tax;
        }
        return array('price' => single_price($price), 'quantity' => $quantity , 'attprice'=>single_price($product_stock->price));
    }

    public function exchangepolicy(){
        return view("frontend.policies.exchangepolicy");
    }

    public function byubackpolicy(){
        return view("frontend.policies.byubackpolicy");
    }

    public function returnpolicy(){
        return view("frontend.policies.returnpolicy");
    }

    public function faq(){
        return view("frontend.policies.faq");
    }

    public function terms(){
        return view("frontend.policies.terms");
    }

    public function privacypolicy(){
        return view("frontend.policies.privacypolicy");
    }

    public function get_pick_ip_points(Request $request)
    {
        $pick_up_points = PickupPoint::all();
        return view('frontend.partials.pick_up_points', compact('pick_up_points'));
    }

    public function get_category_items(Request $request){
        $category = Category::findOrFail($request->id);
        return view('frontend.partials.category_elements', compact('category'));
    }

    public function premium_package_index()
    {
        $customer_packages = CustomerPackage::all();
        return view('frontend.partials.customer_packages_lists',compact('customer_packages'));
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function quickview(Request $request)
    {
        // dd($request->all());
        $product = Product::findorFail($request->id);
        return view('frontend.partials.quick-view',compact('product'));
    }
}
