<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>3</title>
</head>
<body>
<?php

#1
$i=rand(1,7);
if($i==1)
{
print'月曜日';
}
elseif($i==2)
{
print'火曜日';
}
elseif($i==3)
{
print'水曜日';
}
elseif($i==4)
{
print'木曜日';
}
elseif($i==5)
{
print'金曜日';
}
elseif($i==6)
{
print'土曜日';
}
else
{
print'日曜日';
}
print'<br/>';


#2
$number=rand(3,8);
$result=($number==5) ? '当たりました！' : 'ハズレです！';
print $result;
print'<br/>';


#3
$i=rand(1,4);
switch($i)
{
case '1':
print'1です';
break;
case '2':
print'2です';
break;
case '3':
print'3です';
break;
case '4':
print'4です';
break;
}
print'<br/>';


#4
#A 式が一致するまですべての処理が実行される
$i=rand(1,4);
switch($i)
{
case '1':
print'1です';

case '2':
print'2です';

case '3':
print'3です';

case '4':
print'4です';
}
print'<br/>';



#5
$kazu=rand(1,6);
switch($kazu)
{
case '1':
print'1です';
break;
case '2':
print'2です';
break;
case '3':
print'3です';
break;
case '4':
print'4です';
break;
default:
print'エラー';
}
print'<br/>';


#6
$kazu=rand(1,4);
switch($kazu):
case '1':
print'1です';
break;
case '2':
print'2です';
break;
case '3':
print'3です';
break;
case '4':
print'4です';
break;
endswitch;
print'<br/>';


#7
$i = 1;
while($i<=10)
{
print $i.'回目のループ';
$i++;
}


#8
$i = 1;
do
{
print $i.'回目のループ';
$i++;
}
while($i<=10);


#9
for($counter=-3;$counter<10;$counter++)
{
if($counter==0)break;
print 100/$counter;
}


#10
#A 変数が0のときだけ処理を行わないで次のループへいく
for($counter=-3;$counter<10;$counter++)
{
if($counter==0)continue;
print 100/$counter;
}

?>
</body>
</html>
