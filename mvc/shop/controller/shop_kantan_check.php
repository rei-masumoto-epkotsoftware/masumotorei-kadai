<?php
session_start();
session_regenerate_id(true);

function handle($params){
	$code=$_SESSION['member_code'];
	require_once('./common/common.php');
  	$view_data=[];

	$sql='SELECT name,email,postal1,postal2,address,tel FROM dat_member WHERE code=?';
	$data[]=$code;
	$stmt=executeSql($sql,$data);

	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	$dbh=null;

	$onamae=$rec['name'];
	$email=$rec['email'];
	$postal1=$rec['postal1'];
	$postal2=$rec['postal2'];
	$address=$rec['address'];
	$tel=$rec['tel'];

	$view_data['onamae']=$onamae;
	$view_data['email']=$email;
	$view_data['postal1']=$postal1;
	$view_data['postal2']=$postal2;
	$view_data['address']=$address;
	$view_data['tel']=$tel;

	return $view_data;
}
?>