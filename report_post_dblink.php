<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Taipei');
session_start();
$method = isset($_POST["method"]) ? $_POST["method"] : "";
$deal_time = date('Y/m/d H:i:s');
//駁回
if ($_SESSION['identity'] == "manager") {
  $link = mysqli_connect("localhost", "root", "12345678", "system");
  //$link = mysqli_connect("localhost", "root");
          //mysqli_select_db($link, "system");

  if (isset($_POST['cancel'])) {
    $report_id = $_POST['report_id'];
    echo $report_id;
    $link=mysqli_connect("localhost","root","12345678","system");
    //$link = mysqli_connect("localhost", "root");
    //mysqli_select_db($link, "system");
    $sql = "UPDATE report
            SET status = '已駁回',deal_time='$deal_time'
            WHERE report_id = '$report_id'";
    if (mysqli_query($link, $sql)) {
        // 更新 report 資料表成功後執行其他程式碼
        // 例如：
        echo "報告已駁回，執行其他程式碼...";
    } else {
        echo "更新 report 資料表時發生錯誤: " . mysqli_error($link);
    }
} elseif (isset($_POST['delete'])) {
    $report_post = $_POST['report_post'];
    $post_id = $_POST['post_id'];
    $link=mysqli_connect("localhost","root","12345678","system");
    //$link = mysqli_connect("localhost", "root");
    //mysqli_select_db($link, "system");
    $sql1 = "UPDATE post SET context = '此篇文章已被刪除' WHERE post_id = '$post_id'";
    $sql2 = "UPDATE report SET status = '已刪除',deal_time = '$deal_time' WHERE report_post = '$report_post'";
    if (mysqli_query($link, $sql1) && mysqli_query($link, $sql2)) {
        // 更新 post 和 report 資料表成功後執行其他程式碼
        // 例如：
        echo "文章內容已修改為無，報告已刪除，執行其他程式碼...";
    } else {
        echo "更新資料表時發生錯誤: " . mysqli_error($link);
    }
}
}
// 最後執行頁面重定向
header('location: report_post_view.php?method=query');


?>