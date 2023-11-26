<?php
// DB接続ファイル
    $dbName = 'mysql:host=localhost;dbname=image Posting;charset=utf8';
    $userName = 'root';

    try {
        //PDOクラスはDB操作するクラス
        $db = new PDO($dbName, $userName);
        var_dump('success');

    } catch (\Throwable $th) {
        exit();
    }