function apple(){
  document.getElementById("detail").innerText="価格:108円\n\n産地:青森県\n糖度:13度";
}

function check(){
  var num=document.getElementById("old").value;
  if(0<=num&&num<=19){
    alert("年齢:"+num+"歳\n"+"未成年です");
  }
  else  if(20<=num){
    alert("年齢:"+num+"歳\n"+"成人です");
  }
  else{
    alert("正しく入力して下さい");
  }
}