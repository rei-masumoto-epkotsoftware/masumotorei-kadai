<?php
if($rec==false)
{
	print'メールアドレスかパスワードが間違っています。<br/>';
	print'<a href="./member_login">戻る</a>';
}
else
{
	session_start();
	$_SESSION['member_login']=1;
	$_SESSION['member_code']=$rec['code'];
	$_SESSION['member_name']=$rec['name'];
	header('Location:./shop_list');
	exit();
}
?>
