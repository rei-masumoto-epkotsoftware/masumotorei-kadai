<?php
	if(isset($_SESSION['member_login'])==false)
	{
	print'ログインされていません。<br/>';
	print'<a href="./shop_list">商品一覧へ</a>';
	exit();
	}

	print $onamae.'様<br/>';
	print 'ご注文ありがとうございました。<br/>';
	print $email.'にメールを送りましたのでご確認ください。<br/>';
	print '商品は以下の住所に発送させていただきます。<br/>';
	print '〒'.$postal1.'-'.$postal2.'<br/>';
	print $address.'<br/>';
	print $tel.'<br/>';

	print'<br/>';
	print'<a href="./shop_list">商品画面へ</a>';
?>