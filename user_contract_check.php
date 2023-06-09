<?php
    session_start();
    $identity = $_SESSION['identity'];
    $general_id = $_SESSION['general_id'];

    require_once __DIR__ . '/helpers/helper.php';
    $categories = query("SELECT * FROM dictionary WHERE dictionary_kind = '文章'");
    $merchants = query("SELECT * FROM merchant");
    $contract_id_user = $_GET['contract_id'];
    //echo $contract_id_user;
    $contractView = query("select * from article_contract where contract_id = $contract_id_user")[0];
    $sqlIDtrans =query("SELECT * FROM general_user
    JOIN account ON general_user.account_id = account.account_id
    WHERE general_user.general_id = $general_id")[0];
    $user_bid = $contractView['user_B'];
    $sqlIDtransb =query("SELECT * FROM general_user WHERE general_id = $user_bid")[0];


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
    <!--bootstrap-->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
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
        <a href="user_post_new.php" class="btn border">
          <i class="fas fa-pen-nib text-primary"></i>
          <span class="badge">發文</span>
        </a>
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

                            <!-- <a href="post_po.php" class="btn border">
                    <i class="fas fa-pen-nib text-primary"></i>
                    <span class="badge">發文</span>
                </a>
                              <a href="user_wallet.php" class="btn border">
                    <i class="fas fa-piggy-bank text-primary"></i>
                    <span class="badge">錢包</span>
                </a> -->
                        <!-- <div class="navbar-nav ml-auto py-0">
                            <a href="" class="nav-item nav-link">登入</a>
                            <a href="" class="nav-item nav-link">註冊</a>
                        </div> -->

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
                <div class="card mb-3" style="padding: 30px 50px 30px 50px">
                <form method="post" action="contract_conn.php">
                    <h1 align="center" style="margin-top: 10px;">確認智能合約</h1>
                    <?php
                    $conn=mysqli_connect("localhost","root","12345678","system");
                    $result = mysqli_query($conn,$sql);
                    date_default_timezone_set('Asia/Taipei');
                    $start_time  = date('Y/m/d H:i:s');
                    ?>
                    <input type="hidden" name="method" value="check">
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
                                <h3><i class="fa fa-feather-alt" aria-hidden="true"> 主要發佈人</i></h3>

                            </div>
                            <div class="col-sm-">
                            <h7><?php echo $sqlIDtrans['number']?></h7>
                            </div>
                        </div>

                        <br>

                        <table style="width: 100%">
                        <tr style="height: 60px">
                            <td style="width: 30%; text-align:left"><h7 class="mb-0">解鎖coin</h7></td>
                            <td rowspan="2" style="vertical-align:middle;">

                            <div class="row" style="vertical-align:middle;">
                                <div><input disabled style="padding-left: 5px; width:100px; height: 100px;font-size:30px; text-align:center;" class="form-control" aria-label="First name" value="<?php echo $contractView['profit_A']?>"></div>
                                <div style="padding: 28px 0px 0px 15px;font-size:30px"><h7>%</h7></div>
                            </div>
                            </td>
                        </tr>
                        <tr style="width: 60%;">
                            <td><h7 class="mb-0">Donate coin</h7></td>

                        </tr>
                    </table>

                        <br>
                        <br>
                    <div class="row">
                        <div class="col-sm-">
                            <h3 ><i class="fa fa-feather-alt" aria-hidden="true" > 發文合夥人 A</i></h3>
                        </div>
                        <div class="col-sm-">
                            <h7></h7>
                        </div>
                        <div class="text-muted font-size-sm">
                        </div>
                        </div>
                        <br>
                        <table style="width: 100%;">
                        <tr>
                            <td>
                            id:
                            <div class="row" style="float:right ;margin:0px">
                            <div><input disabled type="text" style="padding-right:40px;width:220px;text-align:center;" class="form-control" placeholder="<?php echo $sqlIDtransb['number']?>" aria-label="First name" value=""></div>
                                </div>
                            </td>
                            </tr>
                        <tr style="height: 60px">
                            <td style="width: 30%; text-align:left"><h7 class="mb-0">解鎖coin</h7></td>
                            <td rowspan="2" style="vertical-align:middle;">

                            <div class="row" style="vertical-align:middle;">
                                <div><input disabled style="padding-left: 5px; width:100px; height: 100px;font-size:30px; text-align:center;" class="form-control" aria-label="First name" value="<?php echo $contractView['profit_B']?>"></div>
                                <div style="padding: 28px 0px 0px 15px;font-size:30px"><h7>%</h7></div>
                            </div>

                        </div>
                            </td>
                        </tr>
                        <tr style="width: 60%;">
                            <td><h7 class="mb-0">Donate coin</h7></td>

                        </tr>
                    </table>

                        <br><br><br>

                        <div class="row" style="text-align: center;">
                        <div class="col-sm-12">
                        <input type="hidden" name="contract_id_user" value="<?php echo $contract_id_user?>">

                        <input type="contract_hidden" name="status" value="已簽訂">
                            <button type="submit" class="btn btn-primary "
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        target="__blank"style="margin-right: 150px;">接受！</button>
                            <button type="submit"  class="btn btn-primary "
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    target="__blank">駁回。</button>
                        </form>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">請輸入私鑰</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type=text style="text-align:center;" class="form-control" placeholder="輸入私鑰" aria-label="key">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary" onclick="location.href='user_contract_list.php'">確認</button>
        <!--        onclick="window.location.href='user_contract_list.php'">確認</button>-->
<!--          如果不能用的話，window可以改成上面那個試試看-->
                                            </div>
                                        </div>

                                      </div>
                <!-- 合約-end -->
<!--
                <div class="contract_row tomato">
                                                <div class="tomato">
                                                    <p class="tomato" style="color:tomato;">1</p>
                                                </div>
                                                <div>
                                                    <p>2</p>
                                                </div>

                                                <div>
                                                    <p>3</p>
                                                    <p>4</p>
                                                </div>
                                            </div>
-->
                                            </div>


            </div>

                    </div>
                </nav>

                </div>



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