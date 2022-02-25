<?php
session_start();
session_regenerate_id(true);

function handle($params){
    	require_once('./common/common.php');
    	require_once('./common/mail_class.php');
	    $view_data=[];
            try {
                $post = sanitize($_POST);
                $onamae = $post['onamae'];
                $email  = $post['email'];
                $postal1 = $post['postal1'];
                $postal2 = $post['postal2'];
                $address = $post['address'];
                $tel = $post['tel'];
                $chumon = $post['chumon'];
                $pass = $post['pass'];
                $danjo = $post['danjo'];
                $birth = $post['birth'];


                $cart = $_SESSION['cart'];
                $kazu = $_SESSION['kazu'];
                $max = count($cart);

                for ($i = 0; $i < $max; $i++) {
                    $sql = 'SELECT name, price FROM mst_product WHERE code=?';
                    $data = [];
                    $data[] = $cart[$i];
                    $stmt = executeSql($sql, $data);
                    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

                    $name=$rec['name'];
                    $price = $rec['price'];
                    $kakaku[] = $price;
                    $suryo = $kazu[$i];
                    $shokei = $price * $suryo;
	 	 
                    $mailData[] = [$name, $price, $suryo, $shokei];
		
		
                }

                 //$sql = 'LOCK TABLES dat_sales WRITE,dat_sales_product WRITE';
                // $stmt = executeSql($sql);

                $lastmembercode = 0;
                if ($chumon == 'chumontouroku') {
                    $sql = 'INSERT INTO dat_member (password,name,email,postal1,postal2,address,tel,danjo,born) VALUES (?,?,?,?,?,?,?,?,?)';
                    $data = [];
                    $data[] = md5($pass);
                    $data[] = $onamae;
                    $data[] = $email;
                    $data[] = $postal1;
                    $data[] = $postal2;
                    $data[] = $address;
                    $data[] = $tel;
                    if ($danjo == 'dan') {
                        $data[] = 1;
                    } else {
                        $data[] = 2;
                    }
                    $data[] = $birth;
                    $stmt = executeSql($sql, $data);

                    $sql = 'SELECT LAST_INSERT_ID()';
                    $stmt = executeSql($sql);
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    $lastmembercode = $rec['LAST_INSERT_ID()'];
                }

                $sql = 'INSERT INTO dat_sales (code_member,name,email,postal1,postal2,address,tel) VALUES (?,?,?,?,?,?,?)';
                $data = [];
                $data[]=$lastmembercode;
                $data[]=$onamae;
                $data[]=$email;
                $data[]=$postal1;
                $data[]=$postal2;
                $data[]=$address;
                $data[]=$tel;
                $stmt=executeSql($sql, $data);

                $sql = 'SELECT LAST_INSERT_ID()';
                $stmt=executeSql($sql);
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                $lastcode=$rec['LAST_INSERT_ID()'];

                for ($i=0; $i<$max; $i++) {
                    $sql = 'INSERT INTO dat_sales_product (code_sales,code_product,price,quantity) VALUES (?,?,?,?)';
                    $data = [];
                    $data[] = $lastcode;
                    $data[] = $cart[$i];
                    $data[] = $kakaku[$i];
                    $data[] = $kazu[$i];
                    $stmt = executeSql($sql, $data);
                }

                // $sql = 'UNLOCK TABLES';
                // $stmt = executeSql($sql);
		$dbh=null;

                if ($chumon == 'chumontouroku') {
                    print '会員登録が完了いたしました。<br/>';
                    print '次回からメールアドレスとパスワードでログインしてください。<br/>';
                    print 'ご注文が簡単にできるようになります。<br/>';
                    print '<br/>';
                }

                $header = 'From: info@rokumarunouen.co.jp';
                $mail = new Rokumaru_Mail($header);
                $title = 'ご注文ありがとうございました。';
                $mail->makeMail($title, $onamae, $mailData, $chumon);
                $mail->sendMail($email);

                $header = 'From: ' . $email;
                $mail = new Rokumaru_Mail($header);
                $title = 'お客様からご注文がありました。';
                $mail->makeMail($title, $onamae, $mailData, $chumon);
                $email = 'info@rokumarunouen.co.jp';
                $mail->sendMail($email);
            } catch (Exception $e) {
                displayError();
            }

		$view_data['onamae']=$onamae;
		$view_data['email']=$email;
		$view_data['postal1']=$postal1;
		$view_data['postal2']=$postal2;
		$view_data['address']=$address;
		$view_data['tel']=$tel;
        $view_data['chumon']=$chumon;
		return $view_data;
}
?>
