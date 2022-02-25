<?php
session_start();
session_regenerate_id(true);
function handle($params){
	require_once('./common/common.php');
	require_once('./common/mail_class.php');
	$view_data=[];
	try{
		$post=sanitize($_POST);
		$onamae=$post['onamae'];
		$email=$post['email'];
		$postal1=$post['postal1'];
		$postal2=$post['postal2'];
		$address=$post['address'];
		$tel=$post['tel'];;

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

		//$sql='LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
		//$stmt=$dbh->prepare($sql);
		$stmt->execute();

		$lastmembercode=$_SESSION['member_code'];

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

		//$sql='UNLOCK TABLES';
		//$stmt=$dbh->prepare($sql);	
		$stmt->execute();

		$dbh=null;

		$customer=new Rokumaru_Mail("From:info@rokumarunouen.co.jp");
		$customer->makeMail("ご注文ありがとうございます。",$onamae,$mailData);
		$customer->sendMail($email);

		$me=new Rokumaru_Mail("From:.$customer->email");
		$me->makeMail("お客様からご注文がありました。",$onamae,$mailData);
		$me->sendMail("info@rokumarunouen.co.jp");

	}
	catch(Exception $e)
	{
		displayError();
	}

        	$view_data['onamae'] = $onamae;
       		$view_data['email'] = $email;
       		$view_data['postal1'] = $postal1;
       	 	$view_data['postal2'] = $postal2;
        	$view_data['address'] = $address;
        	$view_data['tel'] = $tel;
		return $view_data;
}
?>
