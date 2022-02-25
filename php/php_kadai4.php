<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"content=text/html;charset=UTF-8">
<title>4</title>
</head>
<body>
<?php

#1
$youbi=array('月曜日','火曜日','水曜日','木曜日','金曜日');
foreach($youbi as $hei)
{
print $hei;
print'<br/>';
}


#2
$kyouka=array('math'=>'数学','history'=>'歴史','science'=>'理科');
foreach($kyouka as $key=>$val)
{
print $key.':'.$val;
print'<br/>';
}


#3(1)
$youbi=array('月曜日','火曜日','水曜日','木曜日','金曜日');
foreach($youbi as $key=>$hei)
{
if($key=='2')
print $hei;
print'<br/>';
}


#(2)
$kyouka=array('math'=>'数学','history'=>'歴史','science'=>'理科');
foreach($kyouka as $key=>$val)
{
if($key=='history')
print $val;
}


#4
$youbi=array('月曜日','火曜日','水曜日','木曜日','金曜日');
$n=count($youbi);
print'要素数は'.$n.'個<br/>';

$kyouka=array('math'=>'数学','history'=>'歴史','science'=>'理科');
$n=count($kyouka);
print'要素数は'.$n.'個<br/>';


#5
$item=array(
'スカート'=>array('price'=>4000,'stock'=>2),
'ニット'=>array('price'=>5000,'stock'=>10),
'コート'=>array('price'=>10000,'stock'=>5)
);
foreach($item as $key => $value) 
{
print $key.'<br/>';
foreach($value as $key2 => $value2)
	{
	print $key2.':'.$value2.'<br/>';
	}
}

?>
</body>
</html>