<?php
function handle($params){
	require_once('./common/common.php');
	$post=sanitize($_POST);

	$view_data=[];

	$onamae=$post['onamae'];
	$email=$post['email'];
	$postal1=$post['postal1'];
	$postal2=$post['postal2'];
	$address=$post['address'];
	$tel=$post['tel'];
	$chumon=$post['chumon'];
	$pass=$post['pass'];
	$pass2=$post['pass2'];
	$danjo=$post['danjo'];
	$birth=$post['birth'];

	$okflg = true;

	$view_data['onamae']=$onamae;
	$view_data['email']=$email;
	$view_data['postal1']=$postal1;
	$view_data['postal2']=$postal2;
	$view_data['address']=$address;
	$view_data['tel']=$tel;
	$view_data['chumon']=$chumon;
	$view_data['pass']=$pass;
	$view_data['pass2']=$pass2;
	$view_data['danjo']=$danjo;
	$view_data['birth']=$birth;
	$view_data['okflg']=true;
	return $view_data;

}
?>