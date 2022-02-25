<?php

    for ($i = 0; $i < $max; $i++) {
        if (preg_match("/\A[0-9]+\z/", $post['kazu'.$i]) == 0) {
            print '入力した数値に誤りがあります。<br/>';
            print '<a href="shop_cartlook">カートに戻る</a>';
            exit();
        }
        if ($post['kazu'.$i] < 1 || 10 < $post['kazu'.$i]) {
            print '数値は必ず１個以上、１０個までです。<br/>';
            print '<a href="shop_cartlook">カートに戻る</a>';
            exit();
        }
        $kazu[] = $post['kazu'.$i];
    }


?>
