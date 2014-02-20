<?php 

  $rep = array("hello");

  if(isset($_POST["from"]) && isset($_POST["to"])){
    $from = $_POST["from"];
    $to   = $_POST["to"];

    $filename = basename($from);

    rename($from, "$to/$filename");

    $res["mov"] = "$from -> $to";
  }

  header('Content-Type: application/json');
  echo json_encode($res);
?>