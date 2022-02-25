<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>2</title>
</head>
<body>
<?php

#1
$a=2+4-5;
$b=4-5+2;
$c=4*5/2;
$d=5/2*4;

if($a==$b)
print'1<br/>';
if($c==$d)
print'10<br/>';


#2
$a=2*3+4+1;
$b=2*(3+4+1);
if($a==11)
{
print'答えは11';
}
else
{
print'11以外';
}
if($b==16)
{
print'答えは16';
}
else
{
print'16以外';
}
print'<br/>';


#3
$username="Admin";
$username="admin";

if($username=="Admin")
{
echo("Welcome to the admin page.");
}
else
{
echo("Welcome to the user page.");
}


#4
$yasai=array('tomato ','negi ','nasu ','imo ');
foreach($yasai as $value)
{
print $value;
}


#5
$yasai=array('tomato ','negi ','nasu ','imo ');
sort($yasai);
foreach($yasai as $val)
{
print $val;
}
print'<br/>';


#6
$fruits=array('出荷'=>array
('りんご'=>'青森','バナナ'=>'フィリピン','メロン'=>'静岡')
);
foreach($fruits as $key=>$val)
{
print $key;
	foreach($val as $key2=>$val2)
	{print $key2.':'.$val2.'産';}
}
print'<br/>';


$fruits=array('出荷'=>array
('りんご'=>'青森産','バナナ'=>'フィリピン産','メロン'=>'静岡産')
);
$i = 0;
$max=count($fruits);
while($i<$max)
{
print_r($fruits);
$i++;
}

?>
</body>
</html>
