<?php
$method=$_POST["method"];
  $dictionary_id = $_POST["dictionary_id"];
  $dictionary_name = $_POST["dictionary_name"];
  $dictionary_kind = $_POST["dictionary_kind"];
echo $method;
  $link=mysqli_connect("localhost","root","12345678","system");
  //$link=mysqli_connect("localhost","root");
	    //mysqli_select_db($link, "system");

if($_SESSION['identity'] == "manager"){
if($method=="insert"){
$sql="insert into dictionary (dictionary_id,dictionary_kind,dictionary_name)values (NULL,'文章','$dictionary_name')";
      echo $sql;
      if(mysqli_query($link,$sql))
      {
          header("location:article_category.php");
      }else{
          echo "Insert failed: " . mysqli_error($link);
      }
  }
}
      ?>
