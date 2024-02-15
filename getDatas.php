<?php

    //現在のURLを取得する
    $uri = $_SERVER['REQUEST_URI'];

    //strpo()は$uriの中に「imageDeatail.php」が含まれているかを確認する。
    //含まれていた場合は詳細画面へ、そうでない場合は一覧画面へ
    if(strpos($uri, 'imageDetail.php') !== false) {
        //クエリパラメータに設定したidの値を取ることが出来る。
        //それを $imageId変数に入れて、詳細画面用のSELECT文を記載
        $imageId = $_GET['id'];
        //SELECT * FROM images WHERE id = クエリパラメータのid;
        //クエリパラメータのidは$imageIdに入れている、
        //phpでは文字列をドットで繋げる
        $sql = "SELECT * FROM imageposting WHERE id = " . $imageId ;
        // $sql = "SELECT * FROM images WHERE id = " . $imageId;

        // prepare関数$sqlで準備する。引数には$sql
        $sth = $db->prepare($sql);
        // exeute関数で実効
        $sth->execute();
        //fetch関数で1レコード分取り出す
        $data['image_test'] = $sth->fetch();
  


    } else {
            //　imagesテーブルから全カラムの情報を取得する。
            //　アスタリスクでそれを指定する。
            //  カラムを指定する場合は　$sql = "SELECT id FROM images" ;
            $sql = "SELECT * FROM imageposting ORDER BY create_data DESC" ;

            // prepare関数$sqlで準備する。引数には$sql
            $sth = $db->prepare($sql);
            // exeute関数で実効
            $sth->execute();
            // fetchAll関数で全部取り出す
            $data = $sth->fetchAll();
    }





    //getDatas.phpを呼び出すと戻り値に設定した$dataが使用できる
    return $data;
    
