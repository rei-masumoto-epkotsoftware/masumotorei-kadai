<?php
session_start();
session_regenerate_id(true);
function handle($params){
	require_once('./common/common.php');
	$view_data=[];
	try
	{
		$sql='SELECT code,name,price FROM mst_product WHERE 1';
		$data=null;
		$stmt=executeSql($sql,$data);

		while(true) {
			$rec= $stmt->fetch(PDO::FETCH_ASSOC);

            		if($rec==false) {
    		            break;
            		}

         	$view_data['rec'][]=$rec;
        	}

	}
	catch(Exception$e)
	{
		displayError();
	}

	return $view_data;
}
?>
