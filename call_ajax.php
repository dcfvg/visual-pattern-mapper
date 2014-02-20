<?php 

  $rep = array("hello");

  if(isset($_POST["from"]) && isset($_POST["to"])){
    $from = $_POST["from"];
    $to   = $_POST["to"];

    $filename = basename($from);

    rename($from, "$to/$filename");

    $res["mov"] = "$from -> $to";
  }else if(isset($_POST["dir"]) && isset($_POST["pic_id"])){
    $pic_id = $_POST["pic_id"];
    $dir   = $_POST["dir"];
    file_put_contents($dir."/pic_id.md",$pic_id);
    
    $res["sav"] = "$dir = $pic_id";
    
  }

  header('Content-Type: application/json');
  echo json_encode($res);
?>