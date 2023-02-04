<?php
//0.セッションチェック
include('funcs.php');

//1.  DB接続します
$pdo = db_conn();

//２．SQL文を用意(データ取得：SELECT) sell_flagが1(出品OK)のデータのみ表示
$stmt = $pdo->prepare('SELECT * FROM mil_proto2_itemTable WHERE sell_flag=1');

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
} else {
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<div class = "col">';
    $view .=  '<div class = "card h-100">';
    $view .=    '<div class = "card-header">';
    $view .=      h($result['price']);
    $view .=    '</div>';
    $view .=    '<img src="./img/'.h($result['fname']).'" class = "card-img-top">';
    $view .=    '<div class = "card-footer text-end">';
    $view .=    '<small class="text-muted">出品日時:'.h($result['indate']).'</small>';
    $view .=    '</div>';
    $view .=  '</div>';
    $view .= '</div>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- 自作CSSの読み込み -->
  <link rel="stylesheet" href="./css/layout.css">
  <!-- Font Awesome読み込み -->
  <script src="https://kit.fontawesome.com/f569121d87.js" crossorigin="anonymous"></script>
  <title>MCari</title>
</head>

<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="ec_front.php">MCari</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">持ち物管理アプリログイン</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="container container-m">
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?= $view; ?>
  </div>
</div>
<!-- Main[End] -->

<footer class="footer container-m bg-primary">MIL 4th php04_03takase</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

</body>
</html>
