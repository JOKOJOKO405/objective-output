<?php 
require('class.php');

if(!empty($_POST)){
  $attack = (!empty($_POST['attack'])) ? true : false;
  $start = (!empty($_POST['start'])) ? true : false;

  if($start){
    // 初期化
    History::serif('ゲームスタート！');
    ini();
  }else{
    if($attack){
      // ネスの攻撃
      History::serif($_SESSION['ness']->get_name().' の こうげき');
      $_SESSION['ness']->attack($_SESSION['monster']);

      // モンスターの攻撃
      History::serif($_SESSION['monster']->get_name().' の こうげき');
      $_SESSION['monster']->attack($_SESSION['ness']);

      if($_SESSION['ness']->get_hp() <= 0){
        gameOver();
      }else{
        if($_SESSION['monster']->get_hp() <= 0){
          History::serif('YOU WIN!');
          History::serif($_SESSION['monster']->get_name().' を たおした');
          $_SESSION['count'] = $_SESSION['count'] + 1;
          createMonsters();
        }
      }
    }else{
      History::serif('ネス は にげだした');
      createMonsters();
    }
  }
  $_POST = array();
}



?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="common.js"></script>
  <title>mother2もどき</title>
</head>
<body>
  <main>
    <article>
      <section>
        <div class="wrapper">
          <?php if(empty($_SESSION)){ ?>
          <!-- スタート画面 -->
            <form action="" method="post">
              <img src="img/title.jpg" alt="" class="op_img">
              <input type="submit" value="▶はじめる" name="start" class="start_input op_window">
            </form>
          <?php }else{ ?>
          <!-- ストーリー -->
          <div class="battleCommentField" style="margin-top:50px;">
            <div class="gradinentWrapper commentWrapper">
              <div class="gradient_inner01">
                <div class="gradient_inner02">
                  <div class="nessHpBox commentBox is-hidden">
                    <p class="serifTop"><?php echo (!empty($_SESSION['history'])) ? $_SESSION['history'] : ''; ?></p>
                    <p class="is-scroll"></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="gradinentWrapper commandWrapper">
              <div class="gradient_inner01">
                <div class="gradient_inner02">
                  <div class="nessHpBox commentBox">
                    <form action="" method="post">
                      <input type="submit" value="▶たたかう" name="attack" class="start_input command_input">
                      <input type="submit" value="▶にげる" name="escape" class="start_input command_input">
                      <input type="submit" value="▶さいしょから" name="start" class="start_input command_input">
                    </form>
                    <p style="margin-top:10px;"><?php echo 'たおした モンスター' .$_SESSION['count']. ' たい'; ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <img src="<?php echo $_SESSION['monster']->get_img(); ?>" alt="" class="monsters">
        <div class="wrapper">
          <!-- ネスHP -->
          <div class="gradinentWrapper nessHpWrapper">
            <div class="gradient_inner01">
              <div class="gradient_inner02">
                <div class="nessHpBox bgpattern">
                  <p class="name">ネス</p>
                  <ul class="drumCounter">
                    <li>
                      <p class="hp">ＨＰ</p>
                      <p class="hpCounter hpNum"><?php echo $_SESSION['ness']->get_hp(); ?></p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </section>
    </article>
  </main>
</body>
</html>