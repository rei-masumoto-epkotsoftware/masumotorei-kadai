<?php
class Rokumaru_Mail
{
	public $email;
	public $title;
	public $header;
	public $honbun;
	public $footer;

	public function  __construct($header){
		$this->header=$header;
		$this->footer='';
		$this->footer.="□□□□□□□□□□□□□□\n";
		$this->footer.=" ～安心野菜のろくまる農園～\n";
		$this->footer.="\n";
		$this->footer.="〇〇県六丸郡六丸村 123-4\n";
		$this->footer.="電話 090-6060-xxxx\n";
		$this->footer.="メール info@rokumarunouen.co.jp\n";
		$this->footer.="□□□□□□□□□□□□□□\n";
	}

	public function makeMail($title,$onamae,$mailData,$chumon=null){
		$this->title=$title;
		$this->onamae=$onamae;
		$this->honbun='';
		$this->honbun.=$this->onamae;
		$this->honbun.="様\n\nこのたびはご注文ありがとうございました。\n";
		$this->honbun.="\n";
		$this->honbun.="ご注文商品\n";
		$this->honbun.="--------------------\n";
		foreach($mailData as $value){
			$this->honbun.=  $value[0].''.$value[1].'円x'.$value[2].'個='.$value[3]."円\n";
		}
		$this->honbun.="\n";
		$this->honbun.="送料は無料です。\n";
		$this->honbun.="--------------------\n";
		$this->honbun.="\n";
		$this->honbun.="代金は以下の口座にお振込ください。\n";
		$this->honbun.="ろくまる銀行 やさい支店 普通口座 １２３４５６７\n";
		$this->honbun.="入金確認が取れ次第、梱包、発送させていただきます。\n";
		$this->honbun.="\n";
		if($chumon=='chumontouroku'){
			$this->honbun.='会員登録が完了いたしました。<br/>';
			$this->honbun.='次回からメールアドレスとパスワードでログインしてください。<br/>';
			$this->honbun.='ご注文が簡単にできるようになります。<br/>';
			$this->honbun.='<br/>';
		}
		$this->honbun.=$this->footer;
	}

	public function sendMail($email){
		$this->email=$email;
		$this->honbun=html_entity_decode($this->honbun,ENT_QUOTES,'UTF-8');
		mb_language('japanese');
		mb_internal_encoding('UTF-8');
		mb_send_mail($this->email,$this->title,$this->honbun,$this->header);
	}
}

?>
