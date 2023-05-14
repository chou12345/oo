<?php
session_start();
$identity = $_SESSION['identity'];
$general_id = $_SESSION['general_id'];
    require_once __DIR__ . '/helpers/helper.php';
    $categories = query("SELECT * FROM dictionary WHERE dictionary_kind = '".文章."'");
    $merchants = query("SELECT * FROM merchant");
    $contract_id_user = $_GET['contract_id'];
    //echo $contract_id_user;
    $contractView = query("select * from article_contract where contract_id = $contract_id_user")[0];
    // print_r($contractView);
    $sqlIDtrans =query("SELECT * FROM general_user
                    JOIN account ON general_user.account_id = account.account_id
                    WHERE general_user.general_id = $general_id")[0];
    $user_aid = $contractView['user_A'];
    $user_bid = $contractView['user_B'];
    // print_r($user_bid);
    $sqlIDtransa =query("SELECT * FROM general_user
                    WHERE general_id = $user_aid")[0];
    $sqlIDtransb =query("SELECT * FROM general_user WHERE general_id = $user_bid")[0];
    //print_r($sqlIDtransb['number']);
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
</head>
<style>
    table{
        border:none;

    }
    table th, table td {
    border: solid 3px;
}
    .a { border-bottom-color:white;border-top-color:white; }
    .b { border-left-color:white;border-top-color:white;border-bottom-color:white;border-right-color:white;text-align: center; }
    .c { border-bottom-color:white;border-top-color:white;border-left-color:white; }
</style>
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
                    <span class="badge" margin="3px">個人</span>
                    <i class="fas fa-caret-down text-primary"></i>
                    <div class="dropdown-menu position-absolute bg-secondary">
                        <a href="user_information.php" class="dropdown-item">個人資料</a>
                        <a href="user_heart.php" class="dropdown-item">我的收藏</a>
                        <a href="user_follow.php" class="dropdown-item">我的追蹤</a>
                        <a href="user_contract_list.php" class="dropdown-item">我的合約</a>
                        <a href="user_post.php" class="dropdown-item">我的文章</a>
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
                            <a href="index.php" class="dropdown-item">全部文章</a>
                                <?php foreach ($categories as $category) { ?>
                                <a href="post_view.php?category_id=<?php echo $category['dictionary_id']?>" class="dropdown-item"><?php echo $category['dictionary_name']; ?></a>
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
                            <h2 align="center" style="margin-top: 10px;"></h2>
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
                <!-- 合約-end -->
                <div class="card mb-3" style="padding: 10px">
                                        <h1 align="center" style="margin-top: 10px;">智能合約</h1>
                                        <div class="card-body">
                                        <div class="contract-article border" style="padding: 15px; border-radius: 10px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
                                            <a class="" href="post_open1.php">
                                            <!-- https://www.w3schools.com/howto/howto_css_cards.asp -->
                                            <h4>#選課</h4>
                                            <h4><b><?php echo $contractView['title']?></b></h4>
                                            <p><?php echo $contractView['context']?></p>
                                            </a>
                                        </div>

                                        <br><br>
                                            <div class="row">
                                                <div class="col-sm-">
                                                    <h3><i class="fa fa-feather-alt" aria-hidden="true"> 參與的發布者</i></h3>

                                                </div>
                                                <div class="col-sm-">
                                                <h7></h7>
                                                </div>
                                            </div>


<!--                                          <hr>-->
                                            <br>

                                        <table id="t1" style="width: 100%";>
                                            <tr >
                                            <th class="b" style="width: 15%"></th>
                                            <th align="middle" class="b" style="width: 25%">帳號(會員id)</th>
                                            <th align="center" class="b" style="width: 20%">智能合約簽訂狀態</th>
                                            <th align="center" class="b" style="width: 60%">智能合約簽訂時間</th>
                                            </tr>
                                            <tr style="height: 50px">
                                            <td align="left" colspan="1" class="c">主要發佈人</td>
                                            <td align="center" colspan="1" class="a" ><?php echo $sqlIDtransa['number']?></td>
                                            <td align="center" rowspan="2" class="a"><i class="fa fa-check-circle" style=color:green><?php echo $contractView['contract_status']?></i></td>
                                            <td align="center" rowspan="2" class="a" id="date"><?php echo $contractView['start_time']?></td>
                                            </tr>
                                            <tr style="height: 50px">
                                            <td align="left" colspan="1" class="c">共同發佈人A</td>
                                            <td align="center" colspan="1" class="a"><?php echo $sqlIDtransb['number']?></td>
                                            <!-- <td align="center" colspan="1" class="a"><i class="fa fa-minus-circle"style=color:darkgray>待確認</i></td> -->
                                            <!-- <td align="center" colspan="1" class="a" id="date">-</td> -->
                                            </tr>
                                        </table>
                                            <br>
                                            <hr>

                                        <div class="row">
                                            <div class="col-sm-">
                                                <h3 ><i class="fa fa-feather-alt">分潤配給</i></h3>
                                            </div>
                                            <div class="col-sm-">
                                                <h7></h7>
                                            </div>
                                            <div class="text-muted font-size-sm">
                                            </div>
                                          </div>
                                            <br>
                                            <table id="t1" style="width: 100%">
                                            <tr >
                                            <th class="b" style="width: 15%"></th>
                                            <th align="middle" style="width: 25%;" class="b">帳號(會員id)</th>
                                            <th align="middle" class="b"style="width: 20%;">分潤趴數</th>
                                            <th align="middle" class="b"style="width: 60%;"></th>

                                            </tr>
                                            <tr style="height: 50px">
                                            <td align="left" colspan="1" class="c">主要發佈人</td>
                                            <td align="center" colspan="1" class="a" ><?php echo $sqlIDtransa['number']?></td>
                                            <td align="center" colspan="1" class="a" ><?php echo $contractView['profit_A']?>%</td>
                                            </tr>
                                            <tr style="height: 50px">
                                            <td align="left" colspan="1" class="c">共同發佈人A</td>
                                            <td align="center" colspan="1" class="a"><?php echo $sqlIDtransb['number']?></td>
                                            <td align="center" colspan="1" class="a" ><?php echo $contractView['profit_B']?>%</td>
                                            </tr>

                                        </table>
                                            <br><br>

                                          <div class="row" style="text-align: center;">
                                            <div class="col-sm-12">
                                              <a  class="btn btn-primary " target="__blank" href="user_contract_list.php">了解！</a>
                                            </div>
                                          </div>
                                        </div>

                                      </div>
                <!-- 合約-end -->

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