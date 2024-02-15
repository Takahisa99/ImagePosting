<?php

//DB接続
include('./dbConfig.php');

//画像の保存先を指定
$targetDirectory = 'images/';

$fileName = basename($_FILES["file"]["name"]);
// $targetDirectory と $fileNameを繋げている。phpでは文字列をドットで繋げる.
$targetFilePath = $targetDirectory.$fileName;
//これら一連の処理で「image/画像データ」というパスを作成し、


//拡張子取得
//pathinfoで画像情報を取ってきて、第二引数に拡張子を取るように指定している。
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
//postImageForm.phpのhtmlでPOST属性が指定されている.
//!empty()はから出ないことを確認している。ここでは画像名を確認
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($fileName)){
    $arrImageType = array('jpg', 'png', 'jpeg', 'gif', 'pdf' );
    //in_arrayで $arrImageType で格納した拡張子を確認している。
    if (in_array($fileType, $arrImageType)){
        //move_uploaded_fileでimagesフォルダに画像をアップロード
        //第一引数で$_FILES["file"]["tmp_name"]で一時ファイル名を指定して、第二引数で保存先を指定・
        //これにより、DBに保存する前に画像をアップロードする。成功したらiamgesテーブルに格納
        $postImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

        if ($postImageForServer){
            //inset文でテーブルに書き込む
            // INSERT INTO テーブル名（カラム名）VALUES (保存する値);
            //imagesテーブルのfile_nameカラムに$fileNameの値を保存する
            //保存する値が文字列の場合はシングルクォーテーションかダブルクォーテーションにする必要がある。
            //query関数はクラスの関数を使用するため->で使用する。
            $insert = $db->query("INSERT INTO imageposting (file_name) VALUES ('". $fileName . "')");
        }

    }
}
//header()メソッドは指定したページに移動する。今回は画像一覧ページを指定
//
header('Location: ' . './html/index.php', true, 303);
exit();