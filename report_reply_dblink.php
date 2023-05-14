<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Taipei');
session_start();
$method = isset($_POST["method"]) ? $_POST["method"] : "";

if ($_SESSION['identity'] == "manager") {
  $reply_id = $_GET['reply_id'];
  $link=mysqli_connect("localhost","root","12345678","system");
  //$link = mysqli_connect("localhost", "root");
    //      mysqli_select_db($link, "system");
  $sql="delete from reply where reply_id = '$reply_id'"; 
  if (mysqli_query($link, $sql)) {
    header('location:report_reply_view.php?method=query');
  }       
}
//if ($_SESSION['identity'] == "") {
//    $reply_id = $_GET['reply_id'];
//    $link = mysqli_connect("localhost", "root");
//            mysqli_select_db($link, "system");
//  $sql1="delete from post where reply_id = '$reply_id'";
//    if (mysqli_query($link, $sql1)) {
//    header('location:report_reply_view.php?method=query');
//    }else{
//        echo $sql;
//    }
//}
?>


