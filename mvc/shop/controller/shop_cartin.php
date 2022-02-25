<?php
session_start();
session_regenerate_id(true);
function handle($params){
	require_once('./common/common.php');
	$pro_code=$_GET['procode'];
	$view_data=[];
	try{
		if(isset($_SESSION['cart'])==true){
			$cart=$_SESSION['cart'];
			$kazu=$_SESSION['kazu'];
			if(in_array($pro_code,$cart)==true){	
			print'その商品はすでにカートに入っています。<br/>';
			print'<a href="./shop_list">商品一覧に戻る</a>';
			exit();
			}
		}
		$cart[]=$pro_code;
		$kazu[]=1;
		$_SESSION['cart']=$cart;
		$_SESSION['kazu']=$kazu;
	}	
	catch(Exception$e)
	{
		displayError();
	}

	return $view_data;
}
?>
