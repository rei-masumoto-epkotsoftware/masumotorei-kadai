<?php
function handle($params){
	try{
		require_once('./common/common.php');
		$post=sanitize($_POST);
		$member_email=$post['email'];
		$member_pass=$post['pass'];

		$member_pass=md5($member_pass);

		$view_data=[];

		$sql='SELECT code,name FROM dat_member WHERE email=? AND password=?';
		$data[]=$member_email;
		$data[]=$member_pass;
		$stmt=executeSql($sql,$data);
		$dbh=null;

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$view_data['rec']=$rec;
	}
	catch(Exception$e){
		displayError();
	}

	return $view_data;
}
?>
