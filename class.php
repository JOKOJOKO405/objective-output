<?php
ini_set('log_errors', 'On');
ini_set('error_log', 'errors.log');
session_start();

$debug_flag = true;
if($debug_flag){
  function debug($str){
    error_log('デバッグ：：：');
  }
}

// 進行役
interface HistoryInterface{
  public static function serif($str);
  public static function clear();
}
class History implements HistoryInterface{
  public static function serif($str){
    if(empty($_SESSION['history'])) $_SESSION['history'] = '';
    $_SESSION['history'] .= $str.'<br>';
  }
  public static function clear(){
    unset($_SESSION['history']);
  }
}
// 大元クラス
abstract class Character{
  protected $name;
  protected $hp;
  protected $attackMin;
  protected $attackMax;

  public function set_name($name){
    $this->name = $name;
  }
  public function get_name(){
    return $this->name;
  }
  public function set_hp($num){
    $this->hp = $num;
  }
  public function get_hp(){
    return $this->hp;
  }
  public function attack($toObj){
    $attackPoint = mt_rand($this->attackMin, $this->attackMax);

    if(!mt_rand(0, 9)){
      $attackPoint *= 1.5;
      $attackPoint = (int)$attackPoint;
      History::serif('<span style="font-size:250%">SMAAAAAAAAASH!</span>');
      History::serif($toObj->get_name().' に '.$attackPoint.' の ちめいてきな ダメージ！');
    }else{
      $toObj->set_hp($toObj->get_hp() - $attackPoint);
      History::serif($toObj->get_name().' に '.$attackPoint.' の ダメージ');
    }
  }
}

class Ness extends Character{
  protected $pk;

  public function __construct($name, $hp, $pk, $attackMin, $attackMax){
    $this->name = $name;
    $this->hp = $hp;
    $this->pk = $pk;
    $this->attackMin = $attackMin;
    $this->attackMax = $attackMax;
  }

  public function get_pk(){
    return $this->pk;
  }
  public function set_pk($num){
    $this->pk = $pk;
  }
  public function attack($toObj){
    
    if(!mt_rand(0, 9)){
      $randums = mt_rand(0, 3);

      if($randums === 0){
        History::serif($this->get_name().' は いえが こいしくなった');
      }
      if($randums === 1){
        History::serif($this->get_name().' は たたかうのが むなしくなった');
      }
      if($randums === 2){
        History::serif($this->get_name().' は ママを おもいだした');
      }
      if($randums === 3){
        History::serif($this->get_name().' は ハンバーグ が たべたくなった');
      }

    }else{
      if(!mt_rand(0, 4)){
        History::serif($this->name.' は PKサンダーを こころみた');
        $toObj->set_hp($toObj->get_hp() - $this->pk);
        History::serif($toObj->get_name().' に '.$this->pk.' の ダメージ');
      }else{
        parent::attack($toObj);
      }
    }
  }
}

class Monsters extends Character{
  protected $img;
  public function __construct($name, $hp, $attackMin, $attackMax, $img){
    $this->name = $name;
    $this->hp = $hp;
    $this->attackMin = $attackMin;
    $this->attackMax = $attackMax;
    $this->img = $img;
  }
  public function get_img(){
    return $this->img;
  }
}

class PkMonsters extends Monsters{
  private $pkMonst;
  public function __construct($name, $hp, $attackMin, $attackMax, $img, $pkMonst){
    parent::__construct($name, $hp, $attackMin, $attackMax, $img);
    $this->pkMonst = $pkMonst;
  }
  public function get_pkmonst(){
    return $this->pkMonst;
  }
  public function attack($toObj){
    if(!mt_rand(0, 4)){
      History::serif($this->name.' は PKスターストームα を こころみた');
      $toObj->set_hp($toObj->get_hp() - $this->get_pkmonst());
      History::serif($toObj->get_name().' に '.$this->get_pkmonst().' の ダメージ');
    }else{
      parent::attack($toObj);
    }
  }
}
// インスタンス
$monsters = array();

$ness = new Ness('ネス', 980, 670, 32, 700);
$monsters[] = new Monsters('オレナンカドーセ', 50, 38, 80, 'img/ore.png');
$monsters[] = new Monsters('きままなにいさん', 80, 55, 106, 'img/kimama.png');
$monsters[] = new Monsters('あなのぬし', 386, 59, 129, 'img/ana.png');
$monsters[] = new Monsters('マル・デ・タコ', 386, 59, 129, 'img/tako.png');
$monsters[] = new Monsters('デヘヘヘラー', 240, 98, 189, 'img/dehe.png');
$monsters[] = new PkMonsters('スーパースターマン', 568, 122, 420, 'img/starman.png', mt_rand(60, 180));
$monsters[] = new PkMonsters('じゅうそうびポーキー', 2000, 145, 255, 'img/porkey.png', mt_rand(166, 410));

function createMonsters(){
  global $monsters;
  $monster = $monsters[mt_rand(0,6)];
  History::serif($monster->get_name().' に ゆくてを ふさがれた！');
  $_SESSION['monster'] = $monster;
}
function createNess(){
  global $ness;
  $_SESSION['ness'] = $ness;
}
function ini(){
  History::clear();
  History::serif('オールクリアします');
  $_SESSION['count'] = 0;
  createNess();
  createMonsters();
}
function gameOver(){
  History::serif('GAME OVER');
  $_SESSION = array();
  header('location: gameover.php');
  exit;
}