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

print'<form method="post"action="./shop_kantan_done">';
print'<input type="hidden"name="onamae"value="'.$onamae.'">';
print'<input type="hidden"name="email"value="'.$email.'">';
print'<input type="hidden"name="postal1"value="'.$postal1.'">';
print'<input type="hidden"name="postal2"value="'.$postal2.'">';
print'<input type="hidden"name="address"value="'.$address.'">';
print'<input type="hidden"name="tel"value="'.$tel.'">';
print'<input type="button"onclick="history.back()"value="戻る">';
print'<input type="submit"value="OK"><br/>';
print'</form>';
?>
