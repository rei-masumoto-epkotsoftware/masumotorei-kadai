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
	print'ログインされていません。<br/>';
	print'<a href="./shop_list">商品一覧へ</a>';
	exit();
}

print'お名前<br/>';
print $onamae;
print'<br/><br/>';

print'メールアドレス<br/>';
print $email;
print'<br/><br/>';

print'郵便番号<br/>';
print $postal1;
print'-';
print $postal2;
print'<br/><br/>';

print'住所<br/>';
print $address;
print'<br/><br/>';

print'電話番号<br/>';
print $tel;
print'<br/><br/>';
?>
<form method="post"action="./shop_kantan_done">
@csrf
<input type="hidden"name="onamae"value={{$onamae}}>
<input type="hidden"name="email"value={{$email}}>
<input type="hidden"name="postal1"value={{$postal1}}>
<input type="hidden"name="postal2"value={{$postal2}}>
<input type="hidden"name="address"value={{$address}}>
<input type="hidden"name="tel"value={{$tel}}>
<input type="button"onclick="history.back()"value="戻る">
<input type="submit"value="OK"><br/>
</form>
</body>
</html>
