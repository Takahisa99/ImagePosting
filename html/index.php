<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>画像投稿アプリ</title>
</head>
<body>
  <?php include('../dbConfig.php') ?>
  <?php include('../getDatas.php') ?>
  <?php include('./header.php') ?>
  
  <div class="imageList">
  <?php //getDatas.phpでリターンした変数$dataを入れて、ここの$dataの個々の要素に$imageという変数をつける   ?>
  <?php //imagesテーブルからSelect文で取ったきたデータが$dataに入っていて、$imageには１レコード分のデータがある   ?>
    <?php foreach($data as $image) {?>
    <?php //srcタグで、imagesフォルダのパスを指定。画像名をfile_nameカラムを呼び出す。 ?>
    <a href="./imageDetail.php?id=<?php echo $image['id']; ?>"><img src="../images/<?php echo $image['file_name']; ?> " alt="投稿画像"></a>
    <?php //↑imageタグの外側のaタグのURLを変更しhref属性に詳細画面のURLを設定している ?>
    <?php //?をつけることで?以降はクエリパラメータになることを示す。   ?>
    <?php //クエリパラメータはURLの末尾に「?パラメータ変数名　= 値」そ追記することで設定できる。今回はid ?>
    <?php  }; ?>
   </div>
</body>
</html>