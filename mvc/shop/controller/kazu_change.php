<?php
session_start();
session_regenerate_id(true);
require_once('./common/common.php');
function handle($params){
	$view_data=[];
	$post = sanitize($_POST);
    	$max = $post['max'];
    	for ($i = 0; $i < $max; $i++) {
        if (preg_match("/\A[0-9]+\z/", $post['kazu'.$i]) == 0) {
            print '入力した数値に誤りがあります。<br/>';
            print '<a href="shop_cartlook">カートに戻る</a>';
            exit();
        }
        if ($post['kazu'.$i] < 1 || 10 < $post['kazu'.$i]) {
            print '数値は必ず１個以上、１０個までです。<br/>';
            print '<a href="shop_cartlook">カートに戻る</a>';
            exit();
        }
        $kazu[] = $post['kazu'.$i];
    }
    $cart = $_SESSION['cart'];

    for ($i = $max; 0 <= $i; $i--) {
        if (isset($_POST['sakujo'.$i]) == true) {
            array_splice($cart, $i, 1);
            array_splice($kazu, $i, 1);
        }
    }

    $_SESSION['cart'] = $cart;
    $_SESSION['kazu'] = $kazu;

    header('Location: shop_cartlook');
    exit();

	$view_data['max']=$max;
	return $view_data;
}
?>