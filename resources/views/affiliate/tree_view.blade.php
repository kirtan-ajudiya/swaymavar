@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('tree/Treant.css') }}">
<link rel="stylesheet" href="{{ asset('tree/collapsable.css') }}">
<!-- <link rel="stylesheet" href="collapsable.css"> -->
<div class="panel">
	<?php
	 $parant="";
	 $children=array();
   
     function test($userid,$affiliate_users){
          $subchildren=array();
          $sutosubchildren=array();
      foreach ($affiliate_users as $key => $value) {
         if($value->ref_id == $userid){
            $subchildren[]=array('text'=>array('name'=>$value->user->name),'image'=>asset('img/tree_img/admin.png'),'children'=>test($value->user_id,$affiliate_users));
         }
     }   
     return $subchildren;
    }
     foreach ($affiliate_users as $key => $value) {
       if(!isset($user_name) && $user_name!= ""){
         if($value->user_id == $User_id){
         	$parant=$value->user->name;
         }
       }else{
         $parant=$user_name;
       }
         if($value->ref_id == $User_id){
         	$children[]=array('text'=>array('name'=>$value->user->name),'image'=>asset('img/tree_img/admin.png'),'children'=>test($value->user_id,$affiliate_users));
         }
     }
     $setdat= json_encode($children);
	?>
    <div class="panel-heading">
        <h3 class="panel-title">{{ __('Tree View')}} : <b style="font-size: 18px;">{{$root_name}}-( {{$root_email}})</b></h3>
    </div>
    <div class="panel-body">
<!--     	<button class="btn btn-primary" onclick="zoomout()">Zoom -</button>
    	<button class="btn btn-primary" onclick="zoomin()">Zoom +</button> -->
        <div class="chart" id="collapsable-example" ></div>
    </div>
</div>
 <script src="{{ asset('tree/vendor/raphael.js') }}"></script>
 <script src="{{ asset('tree/Treant.js') }}"></script>
<script>
	   var data=<?php echo $setdat ;?>;
	   var chart_config = {
        chart: {
            container: "#collapsable-example",

            animateOnInit: true,
            
            node: {
                collapsable: true
            },
            animation: {
                nodeAnimation: "easeOutBounce",
                nodeSpeed: 700,
                connectorsAnimation: "bounce",
                connectorsSpeed: 700
            }
        },
        nodeStructure: {
            text: {
                name: '<?php echo $parant; ?>',

            },
            image: '<?php echo asset('img/tree_img/mainadmin.png');?>',
            children: data
        }
    };
        new Treant( chart_config );
    </script>
    <script>
    function zoomin(){
        var myImg = document.getElementsByClassName('img-size');  
        var currWidth = myImg[0].clientWidth;
        if(currWidth == 500){
            alert("Maximum zoom-in level reached.");
        } else{
        	for(var i=0; i< myImg.length;i++){
        		myImg[i].style.width = (currWidth + 10) + "px";
                myImg[i].style.height = (currWidth + 10) + "px";
			 }
            
        } 
    }
    function zoomout(){
        var myImg = document.getElementsByClassName('img-size');
        var currWidth = myImg[0].clientWidth;
        if(currWidth == 1){
            alert("Maximum zoom-out level reached.");
        } else{
            for(var i=0; i< myImg.length;i++){
        		myImg[i].style.width = (currWidth - 10) + "px";
                myImg[i].style.height = (currWidth - 10) + "px";
			 }
        }
    }
</script>
@endsection
