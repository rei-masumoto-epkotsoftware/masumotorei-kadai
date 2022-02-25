<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"content=text/html;charset=UTF-8">
<title>5(1)</title>
</head>
<body>
<?php

include'php_kadai5_function.php';

echo "足し算";
echo kasan(10,2);
echo"<br/>";

echo "引き算";
echo genzan(10,2);
echo"<br/>";

echo "掛け算";
echo jozan(10,2);
echo"<br/>";

echo "割り算";
echo josan(10,2);
echo"<br/>";

echo "剰余";
echo joyo(10,2);
echo"<br/><br/>";


//2
$a=10;
$b=2;
echo "足し算";
echo kasan2($a,$b);
echo"<br/>";

echo "引き算";
echo genzan2($a,$b);
echo"<br/>";

echo "掛け算";
echo jozan2($a,$b);
echo"<br/>";

echo "割り算";
echo josan2($a,$b);
echo"<br/>";

echo "剰余";
echo joyo2($a,$b);
?>
</body>
</html>