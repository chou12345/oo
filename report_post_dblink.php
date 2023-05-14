<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Taipei');
session_start();
$method = isset($_POST["method"]) ? $_POST["method"] : "";
$report_id = $_GET['report_id'];
$post_id = $_GET['post_id'];
//駁回
if ($_SESSION['identity'] == "manager") {
  $link = mysqli_connect("localhost", "root", "12345678", "system");
  //$link = mysqli_connect("localhost", "root");
  //      mysqli_select_db($link, "system");


  //刪除
  if (isset($post_id)) {
    $sql1 = "delete from post where post_id = '$post_id'";
    $sql2 = "delete from report where report_id='$report_id'";
    if (mysqli_query($link, $sql1) && mysqli_query($link, $sql2)) {
      header('location:report_post_view.php?method=query');
    } else {
      echo $sql1;
      echo $sql2;
    }
  } else {
    
    // 駁回
    $sql = "delete from report where report_id = '$report_id'";

    if (mysqli_query($link, $sql)) {
      header('location:report_post_view.php?method=query');
    }else{
      echo $sql;
    }
  }



}
//刪除
// if ($_SESSION['identity'] == "manager") {

  // $link = mysqli_connect("localhost", "root", "12345678", "system");
  // //$link = mysqli_connect("localhost", "root");
  // //mysqli_select_db($link, "system");
  // $sql1 = "delete from post where post_id = '$post_id'";
  // $sql2 = "delete from report where report_id='$report_id'";
  // if (mysqli_query($link, $sql1) && mysqli_query($link, $sql2)) {
  //   header('location:report_post_view.php?method=query');
  // } else {
  //   echo $sql;
  // }
// }
?>