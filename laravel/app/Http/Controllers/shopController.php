<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\common;
use App\Http\Controllers\Controller;
use App\Models\rokumaru_mail;
use Illuminate\Support\Facades\DB;

session_start();

class shopController extends Controller
{
    public function clear_cart(){
        $clearSession=Common::clearSession();
        return view('clear_cart')->with(['clearSession'=>$clearSession]);
    }

    public function kazu_change(){
        session_regenerate_id(true);
        $post =Common::sanitize($_POST);
        $max = $post['max'];

        for ($i = 0; $i < $max; $i++) {
            if (preg_match("/\A[0-9]+\z/", $post['kazu'.$i]) == 0) {
                print '入力した数値に誤りがあります。<br/>';
                print '<a href="./shop_cartlook">カートに戻る</a>';
                exit();
            }
            if ($post['kazu'.$i] < 1 || 10 < $post['kazu'.$i]) {
                print '数値は必ず１個以上、１０個までです。<br/>';
                print '<a href="./shop_cartlook">カートに戻る</a>';
                exit();
            }
            $kazu[] = $post['kazu'.$i];
        }

        $cart = $_SESSION['cart'];

        for ($i = $max; 0 <= $i; $i--) {
            if (isset($_POST['sakujo'.$i]) == true) {
                array_splice($cart, $i, 1);
                array_splice($kazu, $i, 1);
            }
        }

        $_SESSION['cart'] = $cart;
        $_SESSION['kazu'] = $kazu;

        header('Location:./shop_cartlook');
        exit();

        return view('shop_cartlook')->with(['cart'=>$cart,'kazu'=>$kazu]);
    }

    public function member_login() {
        $view_data=[];
        return view('member_login',$view_data);
    }

    public function member_login_check(){
        try{
            $post=Common::sanitize($_POST);
            $member_email=$post['email'];
            $member_pass=$post['pass'];
            $member_pass=md5($member_pass);
            $view_data=[];
            $rec =DB::table('dat_member')->select('code','name')->where('email','=',$member_email)
            ->where('password','=',$member_pass)->first();
            if($rec==false)
            {
                print'メールアドレスかパスワードが間違っています。<br/>';
                print'<a href="./member_login">戻る</a>';
            }
            else
            {
                $_SESSION['member_login']=1;
                $_SESSION['member_code']=$rec->code;
                $_SESSION['member_name']=$rec->name;
                header('Location: ./shop_list');
                exit();
            }
        }
        catch(Exception$e){
            displayError();
        }
        return view('shop_list',$view_data);
    }

    public function member_logout(){
            $clearSession=Common::clearSession();
            return view('member_logout')->with(['clearSession'=>$clearSession]);
    }

    public function shop_list(){
        session_regenerate_id(true);
        try {
            $rec=DB::table('mst_product')->select('name','code','price')->get();
        }
        catch (Exception $e) {
            displayError();
        }
        return view('shop_list')->with(['rec'=>$rec]);
    }

    public function shop_product(){
        session_regenerate_id(true);
        try {
            $pro_code = $_GET['procode'];
            $rec=DB::table('mst_product')->select('name','price','gazou')->where('code','=',$pro_code)->first();
            $pro_name = $rec->name;
            $pro_price = $rec->price;
            $pro_gazou_name = $rec->gazou;
            if ($pro_gazou_name == '') {
                $disp_gazou = '';
            } else {
                $disp_gazou = '<img src="/product/gazou/' . $pro_gazou_name . '">';
            }
        }
        catch (Exception $e) {
            displayError();
        }
        return view('shop_product')->with(['pro_code'=>$pro_code,'pro_name'=>$pro_name,'pro_price'=>$pro_price,'disp_gazou'=>$disp_gazou]);
    }

    public function shop_cartin(){
        session_regenerate_id(true);
        $pro_code=$_GET['procode'];
        try{
            if(isset($_SESSION['cart'])==true){
                $cart=$_SESSION['cart'];
                $kazu=$_SESSION['kazu'];
                if(in_array($pro_code,$cart)==true){
                    print'その商品はすでにカートに入っています。<br/>';
                    print'<a href="./shop_list">商品一覧に戻る</a>';
                    exit();
                }
            }
            $cart[]=$pro_code;
            $kazu[]=1;
            $_SESSION['cart']=$cart;
            $_SESSION['kazu']=$kazu;
        }
        catch(Exception$e){
            displayError();
        }
        return view('shop_cartin')->with(['_SESSION'=>$_SESSION]);
    }

    public function shop_cartlook(){
        session_regenerate_id(true);
        try {
            if (isset($_SESSION['cart']) == true) {
                $cart = $_SESSION['cart'];
                $kazu = $_SESSION['kazu'];
                $max = count($cart);
            } else {
                $max = 0;
            }
            if ($max == 0) {
                print 'カートに商品が入っていません。<br/>';
                print '<br/>';
                print '<a href="./shop_list">商品一覧に戻る</a>';
                exit();
            }
            foreach ($cart as $key => $val) {
                $rec=DB::table('mst_product')->select('code','name','price','gazou')->where('code','=',$val)->first();
                $pro_name[] = $rec->name;
                $pro_price[] = $rec->price;
                if ($rec->gazou == '') {
                    $pro_gazou[] = '';
                } else {
                    $pro_gazou[] = '<img src="/product/gazou/'.$rec->gazou.'">';
                }
            }
            $dbh = null;
        } catch (Exception $e) {
            displayError();
        }
        return view('shop_cartlook')->with(['kazu'=>$kazu,'max'=>$max,'pro_name'=>$pro_name,'pro_price'=>$pro_price,'pro_gazou'=>$pro_gazou]);
    }

    public function shop_form(){
        $view_data=[];
        return view('shop_form',$view_data);
    }

    public function shop_form_check(){
        $post=Common::sanitize($_POST);
        $onamae=$post['onamae'];
        $email=$post['email'];
        $postal1=$post['postal1'];
        $postal2=$post['postal2'];
        $address=$post['address'];
        $tel=$post['tel'];
        $chumon=$post['chumon'];
        $pass=$post['pass'];
        $pass2=$post['pass2'];
        $danjo=$post['danjo'];
        $birth=$post['birth'];
        $okflg = true;

        return view('shop_form_check')->with(['onamae'=>$onamae,'email'=>$email,'postal1'=>$postal1,'postal2'=>$postal2,'address'=>$address,'tel'=>$tel,'chumon'=>$chumon,'pass'=>$pass,'pass2'=>$pass2,'danjo'=>$danjo,'birth'=>$birth,'okflg'=>$okflg]);
    }

    public function shop_form_done(){
        session_regenerate_id(true);
        try {
                $post = Common::sanitize($_POST);
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
                    $rec =DB::table('mst_product')->select('name','price')->where('code','=', $cart[$i])->first();

                    $name = $rec->name;
                    $price = $rec->price;
                    $kakaku[] = $price;
                    $suryo = $kazu[$i];
                    $shokei = $price * $suryo;
                    $mailData[] = [$name, $price, $suryo, $shokei];
                }

                // $sql = 'LOCK TABLES dat_sales WRITE,dat_sales_product WRITE';
                // $stmt = executeSql($sql);

                $lastmembercode = 0;
                if ($chumon == 'chumontouroku') {
                    if ($danjo == 'dan') {
                        $danjo= 1;
                    } else {
                        $danjo= 2;
                    }
                    DB::table('dat_member')->insert(['password'=>md5($pass),'name'=>$onamae,'email'=>$email,'postal1'=>$postal1,'postal2'=>$postal2,'address'=>$address,'tel'=>$tel,'danjo'=>$danjo,'born'=>$birth]);
                    $lastmembercode = DB::getPdo()->lastInsertId();
                }

                DB::table('dat_sales')->insert(['code_member'=>$lastmembercode,'name'=>$onamae,'email'=>$email,'postal1'=>$postal1,'postal2'=>$postal2,'address'=>$address,'tel'=>$tel]);
                $lastcode = DB::getPdo()->lastInsertId();

                for ($i = 0; $i < $max; $i++) {
                    DB::table('dat_sales_product')->insert (['code_sales'=>$lastcode,'code_product'=>$cart[$i],'price'=>$kakaku[$i],'quantity'=>$kazu[$i]]);
                }

                // $sql = 'UNLOCK TABLES';
                // $stmt = executeSql($sql);

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
        }
        catch (Exception $e) {
            displayError();
        }
        return view('shop_form_done')->with(['onamae'=>$onamae,'email'=>$email,'postal1'=>$postal1,'postal2'=>$postal2,'address'=>$address,'tel'=>$tel,'chumon'=>$chumon]);
    }

    public function shop_kantan_check(){
        session_regenerate_id(true);
        $code = $_SESSION['member_code'];

        $rec = DB::table('dat_member')->select('name','email','postal1','postal2','address','tel')->where('code','=',$code)->first();

        $onamae = $rec->name;
        $email= $rec->email;
        $postal1= $rec->postal1;
        $postal2 = $rec->postal2;
        $address = $rec->address;
        $tel= $rec->tel;

        return view('shop_kantan_check')->with(['onamae'=>$onamae,'email'=>$email,'postal1'=>$postal1,'postal2'=>$postal2,'address'=>$address,'tel'=>$tel]);
    }

    public function shop_kantan_done(){
        session_regenerate_id(true);
        try {
            $post = Common::sanitize($_POST);
            $onamae = $post['onamae'];
            $email = $post['email'];
            $postal1 = $post['postal1'];
            $postal2 = $post['postal2'];
            $address = $post['address'];
            $tel = $post['tel'];

            $cart = $_SESSION['cart'];
            $kazu = $_SESSION['kazu'];
            $max = count($cart);

            for ($i = 0; $i < $max; $i++) {
                $rec =DB::table('mst_product')->select('name','price')->where('code','=',$cart[$i])->first();

                $name = $rec->name;
                $price = $rec->price;
                $kakaku[] = $price;
                $suryo = $kazu[$i];
                $shokei = $price * $suryo;
                $mailData[] = [$name, $price, $suryo, $shokei];
            }

            // $sql = 'LOCK TABLES dat_sales WRITE,dat_sales_product WRITE';
            // $stmt = executeSql($sql);

            $lastmembercode = $_SESSION['member_code'];

            DB::table('dat_sales')->insert(['code_member'=>$lastmembercode, 'name'=>$onamae, 'email'=>$email, 'postal1'=>$postal1, 'postal2'=>$postal2, 'address'=>$address, 'tel'=>$tel]);                $lastcode=DB::getPdo()->lastInsertId();

            for ($i = 0; $i < $max; $i++) {
                DB::table('dat_sales_product')->insert(['code_sales'=> $lastcode,'code_product'=>$cart[$i],'price'=>$kakaku[$i],'quantity'=>$kazu[$i]]);
            }

            // $sql = 'UNLOCK TABLES';
            // $stmt = executeSql($sql);

            $header = 'From: info@rokumarunouen.co.jp';
            $mail = new Rokumaru_Mail($header);
            $title = 'ご注文ありがとうございました。';
            $mail->makeMail($title, $onamae, $mailData);
            $mail->sendMail($email);

            $header = 'From: ' . $email;
            $mail = new Rokumaru_Mail($header);
            $title = 'お客様からご注文がありました。';
            $mail->makeMail($title, $onamae, $mailData);
            $email = 'info@rokumarunouen.co.jp';
            $mail->sendMail($email);
        }
        catch (Exception $e) {
            displayError();
        }
        return view('shop_kantan_done')->with(['onamae'=>$onamae,'email'=>$email,'postal1'=>$postal1,'postal2'=>$postal2,'address'=>$address,'tel'=>$tel]);
    }
}
?>
