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
カートに追加しました。<br/>
<br/>
<a href="/shop/shop_list">商品一覧に戻る</a>

</body>
</html>