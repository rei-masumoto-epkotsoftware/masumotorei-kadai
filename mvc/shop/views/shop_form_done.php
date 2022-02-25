<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php

print $onamae.'様<br/>';
print'ご注文ありがとうございました。<br/>';
print $email.'にメールを送りましたのでご確認ください。<br/>';
print'商品は以下の住所に発送させていただきます。<br/>';
print $postal1.'-'.$postal2.'<br/>';
print $address.'<br/>';
print $tel.'<br/>';

if($chumon=='chumontouroku')
{
	print'会員登録が完了いたしました。<br/>';
	print'次回からメールアドレスとパスワードでログインしてください。<br/>';
	print'ご注文が簡単にできるようになります。<br/>';
	print'<br/>';
}

?>

<br/>
<a href="./shop_list">商品画面へ</a>

</body>
</html>