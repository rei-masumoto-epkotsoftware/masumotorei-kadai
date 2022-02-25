<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php

if(isset($_SESSION['member_login'])==false)
{
	print'ようこそゲスト様 ';
	print'<a href="./member_login">会員ログイン</a><br/>';
	print'<br/>';
}
else
{
	print'ようこそ';
	print $_SESSION['member_name'];
	print'様 ';
	print'<a href="./member_logout">ログアウト</a><br/>';
	print'<br/>';
}
?>
商品一覧<br/><br/>
<?php
foreach($rec as $value)
{
	print'<a href="/shop/shop_product?procode='.$value->code.'">';
	print$value->name.'---';
	print$value->price.'円';
	print'</a>';
	print'<br/>';
}
?>

<br/>
<a href="./shop_cartlook">カートを見る</a><br/>

<br/>
<a href="./clear_cart">カートを空にする</a><br/>

</body>
</html>