<?php 
require('class.php');

if(!empty($_POST)){
  header('location: index.php');
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
  <title>gameover</title>
</head>
<body>
  <main>
    <article>
      <section>
        <div class="wrapper">
          <!-- ストーリー -->
          <div class="battleCommentField" style="margin-top:50px;">
            <div class="gradinentWrapper commentWrapper">
              <div class="gradient_inner01">
                <div class="gradient_inner02">
                  <div class="nessHpBox commentBox">
                    <p><?php echo 'ネス は きずつき たおれた'; ?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="gradinentWrapper commandWrapper">
              <div class="gradient_inner01">
                <div class="gradient_inner02">
                  <div class="nessHpBox commentBox">
                    <form action="" method="post">
                      <input type="submit" value="▶もどる" name="restart" class="start_input command_input">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div style="width:100%;height:100px;"></div>
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
                      <p class="hpCounter hpNum"><?php echo 000; ?></p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </article>
  </main>
</body>
</html>