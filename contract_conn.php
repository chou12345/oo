<?php
  require_once __DIR__ . '/helpers/helper.php';
  date_default_timezone_set('Asia/Taipei');
  // error_reporting(E_ALL);
  // ini_set('display_errors', 1);
  session_start();
  $general_id=$_SESSION['general_id'];
  $method=$_POST["method"];
  $user_a=$general_id;
  $user_b=$_POST["user_b"];
  $user_c=$_POST["user_c"];
  $title=$_POST["title"];
  //echo $title;
  $context=$_POST["context"];
  //echo $context;
  $profit_a=$_POST["profit_a"];
  $profit_b=$_POST["profit_b"];
  $profit_c=$_POST["profit_c"];
  $start_time  = date('Y/m/d H:i:s');
  //$start_time=$_POST["start_time"];
  $status=$_POST["contract_status"];
  $private_key = $_POST['private_key'];
  $contract_id = $_POST["contract_id"];
  $manager_id = $_POST["manager_id"];
  $merchant_id = $_POST["merchant_id"];
  $profit_manager= $_POST["profit_manager"];
  $profit_merchant = $_POST["profit_merchant"];
  $contract_id_mer = $_POST["contract_id_mer"];
  $contract_id_user = $_POST["contract_id_user"];


  //echo $_POST['method'];
  //echo $method;

  $conn = new mysqli('localhost', 'root', '12345678', 'system');
  //$conn = mysqli_connect("localhost", "root");
          //mysqli_select_db($conn, "system");

  $sqlIDtrans ="SELECT * FROM `general_user`
                JOIN account ON general_user.account_id = account.account_id
                WHERE account.account = $user_b";
  $rsID = mysqli_query($conn, $sqlIDtrans);
  $recordID = mysqli_fetch_row($rsID);
  //print_r($recordID);


  if (!empty($conn->connect_error)) {
    die('資料庫連線錯誤:' . $conn->connect_error);
  }


  //insert
  if($method == "insert"){
    //echo $user_b;
    //echo $recordID[25];
    if (isset($_POST['private_key'])) {
        $private_key = $_POST['private_key'];
        $conn = new mysqli('localhost', 'root', '12345678', 'system');
        if (!$conn) {
            die("連線失敗：" . mysqli_connect_error());
        }
        $sql = "SELECT * FROM general_user WHERE private_key = '$private_key'";
        $rs = mysqli_query($conn, $sql);
        if ($rs && mysqli_num_rows($rs) > 0) {
            $user_a=$_POST["user_a"];
            $user_b=$_POST["user_b"];
            $user_c=$_POST["user_c"];
            $title=$_POST["title"];
            $context=$_POST["context"];
            $profit_a=$_POST["profit_a"];
            $profit_b=$_POST["profit_b"];
            $profit_c=$_POST["profit_c"];
            $start_time  = date('Y/m/d H:i:s');
            $status=$_POST["status"];
            $sql = "INSERT INTO `article_contract` (`user_A`, `user_B`, `user_C`, `title`, `context`, `profit_A`, `profit_B`, `profit_C`, `start_time`, `status`)
                                    VALUES ('1', '$recordID[2]', '3', '$title', '$context', '$profit_a', '$profit_b', '$profit_c', '$start_time', '$status')";
        if (mysqli_query($conn, $sql)) {
                mysqli_close($conn);
                header('location: user_contract_list.php');
                exit();
            } else {
                echo "新增合約內容至資料庫失敗：" . mysqli_error($conn);
            }
        } else {
            echo "私鑰不存在於資料庫中";
        }
    } else {
        echo "未提供私鑰";
    }
}
  //check(update)
  else if($method == "check"){
    $sql = "update article_contract set start_time = '$start_time', contract_status='$contract_status' where contract_id = '$contract_id_user'";
    //echo $sql;
    if (mysqli_query($conn, $sql))
    //echo "okok";
      header('location:user_contract_list.php');
  }

  //merchant_check(update)
  else if($method == "merchant_check"){
    $sql = "update profit_contract set start_time = '$start_time', contract_status='$contract_status' where contract_id = '$contract_id_mer'";
    //echo $sql;
    if (mysqli_query($conn, $sql))
      header('location:merchant_contract_list.php');
  }

 else if ($method == "manager_insert") {
    //echo $method;
    if (isset($_POST['private_key'])) {
        $private_key = $_POST['private_key'];
        //$conn=mysqli_connect("localhost","root");
              //mysqli_select_db($conn, "system");
        $conn = new mysqli('localhost', 'root', '12345678', 'system');
        if (!$conn) {
            die("連線失敗：" . mysqli_connect_error());
        }

        $sql = "SELECT * FROM manager WHERE private_key = '$private_key'";
        $rs = mysqli_query($conn, $sql);

        if ($rs && mysqli_num_rows($rs) > 0) {
            $manager_id = $_POST['manager_id'];
            $merchant_id = $_POST['merchant_id'];
            $title = $_POST['title'];
            $context = $_POST['context'];
            $profit_manager = $_POST['profit_manager'];
            $profit_merchant = $_POST['profit_merchant'];
            $start_time  = date('Y/m/d H:i:s');
            $status = $_POST['status'];

            $insertSql = "INSERT INTO profit_contract (contract_id, manager_id, merchant_id, title, context, profit_manager, profit_merchant, start_time, status)
                          VALUES (NULL, '$manager_id', '$merchant_id', '$title', '$context', '$profit_manager', '$profit_merchant', '$start_time', '$status')";

            if (mysqli_query($conn, $insertSql)) {
                mysqli_close($conn);
                header('location: manager_contract_list.php');
                exit();
            } else {
                echo "新增合約內容至資料庫失敗：" . mysqli_error($conn);
            }
        } else {
            echo "私鑰不存在於資料庫中";
        }
    } else {
        echo "未提供私鑰";
    }
}


        $sql = "SELECT * FROM manager WHERE private_key = '$private_key'";
        $rs = mysqli_query($conn, $sql);

        if ($rs && mysqli_num_rows($rs) > 0) {
            $manager_id = $_POST['manager_id'];
            $merchant_id = $_POST['merchant_id'];
            $title = $_POST['title'];
            $context = $_POST['context'];
            $profit_manager = $_POST['profit_manager'];
            $profit_merchant = $_POST['profit_merchant'];
            $start_time  = date('Y/m/d H:i:s');
            $status = $_POST['status'];

            $insertSql = "INSERT INTO profit_contract (contract_id, manager_id, merchant_id, title, context, profit_manager, profit_merchant, start_time, status)
                          VALUES (NULL, '$manager_id', '$merchant_id', '$title', '$context', '$profit_manager', '$profit_merchant', '$start_time', '$status')";

            if (mysqli_query($conn, $insertSql)) {
                mysqli_close($conn);
                header('location: manager_contract_list.php');
                exit();
            } else {
                echo "新增合約內容至資料庫失敗：" . mysqli_error($conn);
            }
        } else {
            echo "私鑰不存在於資料庫中";
        }
    } else {
        echo "未提供私鑰";
    }
}


?>