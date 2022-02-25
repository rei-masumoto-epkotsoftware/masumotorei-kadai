<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
<?php
if($onamae=='')
{
	print'お名前が入力されていません。<br/><br/>';
	$okflg=false;
}
else
{
	print'お名前<br/>';
	print $onamae;
	print'<br/><br/>';
}

if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$email)==0)
{
	print'メールアドレスを正確に入力してください。<br/><br/>';
	$okflg=false;
}
else
{
	print'メールアドレス<br/>';
	print $email;
	print'<br/><br/>';
}

if(preg_match('/\A[0-9]+\z/',$postal1)==0)
{
	print'郵便番号は半角数字で入力してください。<br/><br/>';
	$okflg=false;
}
else
{
	print'郵便番号<br/>';
	print $postal1;
	print'-';
	print $postal2;
	print'<br/><br/>';
}

if(preg_match('/\A[0-9]+\z/',$postal2)==0)
{
	print'郵便番号は半角数字で入力してください。<br/><br/>';
	$okflg=false;
}

if($address=='')
{
	print'住所が入力されていません。<br/><br/>';
	$okflg=false;
}
else
{
	print'住所<br/>';
	print $address;
	print'<br/><br/>';
}

if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/',$tel)==0)
{
	print'電話番号を正確に入力してください。<br/><br/>';
	$okflg=false;
}
else
{
	print'電話番号<br/>';
	print $tel;
	print'<br/><br/>';
}

if($chumon=='chumontouroku')
{
	if($pass=='')
	{
		print'パスワードが入力されていません。<br/><br/>';
		$okflg=false;
	}

	if($pass!=$pass2)
	{
		print'パスワードが一致しません。<br/><br/>';
		$okflg=false;
	}

	print'性別<br/>';
	if($danjo=='dan')
	{
		print'男性';
	}
	else
	{
		print'女性';
	}
	print'<br/><br/>';

	print'生まれ年<br/>';
	print $birth;
	print'年代';
	print'<br/><br/>';

}
?>
@if($okflg==true)
<form method="post"action="/shop/shop_form_done">
	@csrf
<input type="hidden"name="onamae"value={{$onamae}}>
<input type="hidden"name="email"value={{$email}}>
<input type="hidden"name="postal1"value={{$postal1}}>
<input type="hidden"name="postal2"value={{$postal2}}>
<input type="hidden"name="address"value={{$address}}>
<input type="hidden"name="tel"value={{$tel}}>
<input type="hidden"name="chumon"value={{$chumon}}>
<input type="hidden"name="pass"value={{$pass}}>
<input type="hidden"name="danjo"value={{$danjo}}>
<input type="hidden"name="birth"value={{$birth}}>
<input type="button"onclick="history.back()"value="戻る">
<input type="submit"value="OK"><br/>
</form>
@else
<form>
	@csrf
<input type="button"onclick="history.back()"value="戻る">
</form>
@endif
</body>