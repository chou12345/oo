<?php
session_start();
require_once __DIR__ . '/helpers/helper.php';
$identity = $_SESSION['identity'];
$merchant_id = $_SESSION['merchant_id'];
//echo $merchant_id;
$merchant_conAll = query("SELECT * FROM profit_contract where merchant_id = $merchant_id");
$categories = query("SELECT * FROM dictionary WHERE dictionary_kind = '".文章."'");
$merchants = query("SELECT * FROM merchant");
$manIDtrans = query("select * from manager right join account on manager.account_id = account.account_id")[0];
//print_r($manIDtrans['account']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>輔來輔厲害</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!--aos animation-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<!--keykeykey-->
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">

        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold px-3 mr-1">輔來輔厲害</span></h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left" style="opacity:0;">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="搜尋文章">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                 <a href="wallet.php" class="btn border">
                    <i class="fas fa-piggy-bank text-primary"></i>
                    <span class="badge">錢包</span>
                </a>

                <a href="#" class="btn border"data-toggle="dropdown">
                    <i class="fas fa-user text-primary"></i>
                    <span class="badge">商家</span>
                    <span class="badge" margin="3px"></span>
                    <i class="fas fa-caret-down text-primary"></i>

                    <div class="dropdown-menu position-absolute bg-secondary">
                        <a href="merchant_index.php" class="dropdown-item">商家首頁</a>
                        <a href="merchant_contract_list.php" class="dropdown-item">我的合約</a>
                        <a href="log_out.php" class="dropdown-item">登出</a>
                        </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">總覽</h6>

                </a>

                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">文章類別 <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                 <?php foreach ($categories as $category) { ?>
                                <a href="" class="dropdown-item"><?php echo $category['dictionary_name']; ?></a>
                                <?php  } ?>
                            </div>
                        </div>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">特約商店<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                 <?php foreach ($merchants as $merchant) { ?>
                                <a href="" class="dropdown-item"><?php echo $merchant['name']; ?></a>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>
                </nav>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1"></span></h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <h2 align="center" style="margin-top: 10px;">我的合約</h2>
                        </div>
                    </div>
                </nav>

                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">

                 </div>
                    </div>
                </nav>
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <div class="navbar-nav mr-auto py-0">
                         <a href="merchant_contract_list.php" class="nav-item nav-link active">合約一覽</a>
                        <a href="merchant_contract_list_ing.php" class="nav-item nav-link">待確認合約</a>
                        </div>
                </nav>

                <div>
                    <form method="post" action="merchant_contract_view.php">
                        <table class="table">
                            <thead>
                            <tr>
                                    <th>合約編號</th>
                                    <th>簽訂商家(Me!)</th>
                                    <th>簽訂日期</th>
                                    <!-- <th>簽訂狀況</th> -->
                                    <th>合約內容</th>
                                    <th>簽訂狀況</th>
                                </tr>
                            </thead>
                            <tbody>

                    <?php
                        //$conn=mysqli_connect("localhost","root","12345678","system");
                        //$sql="select * from profit_contract";
                        //$rs=mysqli_query($conn,$sql);

                        $count_id = 1;
                        for($i=0; $i<count($merchant_conAll); $i++){
                            $contract_id = $merchant_conAll[$i]['contract_id'];
                            //print_r($merchant_conAll[$i]['contract_id']);

                            //echo"<tr><td>".$merchant_conAll[$i]['contract_id']."</td>";
                            echo"<tr><td>".$count_id."</td>";
                            echo"<td>".$merchant_id."</td>";
                            echo"<td>".$merchant_conAll[$i]['start_time']."</td>";
                            //echo"<td>".$manIDtrans['account']." ".$merchant_conAll[$i]['contract_status']."</td>";
                            echo"<td>".$merchant_conAll[$i]['context']."</td>";
                            //echo"<td><button type=submit class=btn style=font-size: 90% onclick=location.href='merchant_contract_view.php'><b>".$merchant_conAll[$i]['contract_status']."</td></tr>";
                            if($merchant_conAll[$i]['contract_status']=="簽訂中"){
                                echo "<td><a href='merchant_contract_check.php?contract_id={$merchant_conAll[$i]['contract_id']}'><button type='button' class='btn' style='font-size: 90%'><b>".$merchant_conAll[$i]['contract_status']."</b></button></a></td>";
                            }elseif($merchant_conAll[$i]['contract_status']=="已簽訂"){
                                echo "<td><a href='merchant_contract_view.php?contract_id={$merchant_conAll[$i]['contract_id']}'><button type='button' class='btn' style='font-size: 90%'><b>".$merchant_conAll[$i]['contract_status']."</b></button></a></td>";

                            }

                            $count_id++;
                        }
                        // while($record=mysqli_fetch_row($rs))
	                    // {
                        //     echo"<tr><td>$record[0]</td>
                        //              <td>$record[2]</td>
                        //              <td>$record[7]</td>
                        //              <td>$record[2] $record[8]</td>
                        //              <td>$record[4]</td>";
                        //     echo"<td><a href=merchant_contract_view.php class=btn border<button type=button class=btn style=font-size: 90% onclick=location.href='manager_contract_view.php'><b>
                        //     $record[8]
                        //     </b></button></a>";
                        // }

                    ?>
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
                    </div>
                </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>