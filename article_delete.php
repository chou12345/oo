<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
//$method=$_POST["method"];
if($_SESSION['identity']== "manager"){
  $general_id=$_GET['general_id'];
$link=mysqli_connect("localhost","root","12345678","system");  
  //$link=mysqli_connect("localhost","root");
	   //mysqli_select_db($link, "system");
  $sql="delete from post where general_id = '$general_id'";
  if(mysqli_query($link,$sql))
  {
      header('location:article_view.php?method=query');
  }
}
  ?>