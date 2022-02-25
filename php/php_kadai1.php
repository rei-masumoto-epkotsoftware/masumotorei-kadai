<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>1</title>
</head>
<body>
<?php

#1
$email='ccc@softbank.ne.jp';
$email2='CCC@Softbank.ne.jp';

if(strcasecmp($email,$email2)==0)
{
print'メールアドレスが一致しました。';
}
else
{
print'メールアドレスが一致しておりません。';
}


#2
print'私の'.'名前は'.'レイです。';
print'<br/>';


#3
print'来年で'.'123'.'歳';
print'<br/>';


#4
define("TAX",1.10);
$price=200*TAX.'円';
print $price;

const ZEI = 1.10;
$price=300*ZEI.'円';
print $price;


#5
print'現在の行は'.__LINE__.'行目です。<br/>';
print'ファイル名:'.__FILE__.'.';
print'<br/>';


#6
$suti=300;
print $suti/365;


#7
$i=800;
print $i++.'<br/>';
print $i;


#8
$i=250;
print $i--.'<br/>';
print $i;


#9
$i=800;
print $j=$i++.'<br/>';
print $j=++$i;


#10
$a=3;
$b=2;
print $a+$b;


#11
$str="1234";
var_dump($str);


#12
$locations=3;
$c=2+$locations;
print $c;

?>
</body>
</html>