<?php
	session_start();
	session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>

<?php

try
{

require_once('../common/common.php');

$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];
$chumon=$post['chumon'];
$pass=$post['pass'];
$danjo=$post['danjo'];
$birth=$post['birth'];

print $onamae.'様<br/>';
print'ご注文ありがとうございました。<br/>';
print $email.'にメールを送りましたのでご確認ください。<br/>';
print'商品は以下の住所に発送させていただきます。<br/>';
print $postal1.'-'.$postal2.'<br/>';
print $address.'<br/>';
print $tel.'<br/>';

$cart=$_SESSION['cart'];
$kazu=$_SESSION['kazu'];
$max=count($cart);

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$mailData=array();

for($i=0;$i<$max;$i++)
{
	$sql='SELECT name,price FROM mst_product WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data[0]=$cart[$i];
	$stmt->execute($data);

	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	$name=$rec['name'];
	$price=$rec['price'];
	$kakaku[]=$price;
	$suryo=$kazu[$i];
	$shokei=$price*$suryo;

	$mailData[]=[$name,$price,$suryo,$shokei];
	
}

$sql='LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$lastmembercode=0;
if($chumon=='chumontouroku')
{
	$sql='INSERT INTO dat_member(password,name,email,postal1,postal2,address,tel,danjo,born)VALUES(?,?,?,?,?,?,?,?,?)';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=md5($pass);
	$data[]=$onamae;
	$data[]=$email;
	$data[]=$postal1;
	$data[]=$postal2;
	$data[]=$address;
	$data[]=$tel;
	if($danjo=='dan')
	{
		$data[]=1;
	}
	else
	{
		$data[]=2;
	}
	$data[]=$birth;
	$stmt->execute($data);

	$sql='SELECT LAST_INSERT_ID()';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	$lastmembercode=$rec['LAST_INSERT_ID()'];
}

$sql='INSERT INTO dat_sales (code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data=array();
$data[]=$lastmembercode;
$data[]=$onamae;
$data[]=$email;
$data[]=$postal1;
$data[]=$postal2;
$data[]=$address;
$data[]=$tel;
$stmt->execute($data);

$sql='SELECT LAST_INSERT_ID()';
$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$lastcode=$rec['LAST_INSERT_ID()'];

for($i=0;$i<$max;$i++)
{
	$sql='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity)VALUES(?,?,?,?)';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=$lastcode;
	$data[]=$cart[$i];
	$data[]=$kakaku[$i];
	$data[]=$kazu[$i];
	$stmt->execute($data);
}

$sql='UNLOCK TABLES';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

if($chumon=='chumontouroku')
{
	print'会員登録が完了いたしました。<br/>';
	print'次回からメールアドレスとパスワードでログインしてください。<br/>';
	print'ご注文が簡単にできるようになります。<br/>';
	print'<br/>';
}

require_once('../shop/mail_class.php');

$customer=new Rokumaru_Mail("From:info@rokumarunouen.co.jp");
$customer->makeMail("ご注文ありがとうございます。",$onamae,$mailData,$chumon);
$customer->sendMail($email);

$me=new Rokumaru_Mail("From:.$customer->email");
$me->makeMail("お客様からご注文がありました。",$onamae,$mailData,$chumon);
$me->sendMail("info@rokumarunouen.co.jp");

}
catch(Exception $e)
{
		displayError();
}

?>

<br/>
<a href="shop_list.php">商品画面へ</a>

</body>
</html>