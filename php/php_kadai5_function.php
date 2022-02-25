<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"content=text/html;charset=UTF-8">
<title>5(1)</title>
</head>
<body>
<?php

function kasan($num1,$num2)
{
$kotae=$num1+$num2;
$num1=$kotae;
return $num1+$num2;
}


function genzan($num1,$num2)
{
$kotae=$num1-$num2;
$num1=$kotae;
return $num1-$num2;
}


function jozan($num1,$num2)
{
$kotae=$num1*$num2;
$num1=$kotae;
return $num1*$num2;
}


function josan($num1,$num2)
{
$kotae=$num1/$num2;
$num1=$kotae;
return $num1/$num2;
}


function joyo($num1,$num2)
{
$kotae=$num1%$num2;
$num1=$kotae;
return $num1%$num2;
}


//(2)
function kasan2(&$num1,&$num2)
{
$kotae=$num1+$num2;
$num1=$kotae;
return $num1+$num2;
}


function genzan2(&$num1,&$num2)
{
$kotae=$num1-$num2;
$num1=$kotae;
return $num1-$num2;
}


function jozan2(&$num1,&$num2)
{
$kotae=$num1*$num2;
$num1=$kotae;
return $num1*$num2;
}


function josan2(&$num1,&$num2)
{
$kotae=$num1/$num2;
$num1=$kotae;
return $num1/$num2;
}


function joyo2(&$num1,&$num2)
{
$kotae=$num1%$num2;
$num1=$kotae;
return $num1%$num2;
}

?>
</body>
</html>