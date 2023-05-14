<?php
session_start();
$general_id = $_SESSION['general_id'];
  require_once __DIR__ . '/helpers/helper.php';

  $user = query("select * from general_user inner join account on general_user.account_id = account.account_id where general_id = '$general_id'")[0];
  $postCount = query("select count(*) as post_count from post where general_id = '$general_id'")[0]['post_count'] ?? 0;
  $donatCoin = query("select sum(donate_coin) as donate_coin from donate where user_B = '$general_id'")[0]['donate_coin'] ?? 0;
  $dictionaries = query("SELECT * FROM dictionary WHERE dictionary_kind = '文章'");
  $merchants = query("SELECT * FROM merchant");
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
                                <a href="post_view.php" class="dropdown-item">全部文章</a>
                                <?php foreach ($dictionaries as $dictionary) { ?>
                                  <a href="post_view.php?dictionary_id=<?php echo $dictionary['dictionary_id'] ?>" class="dropdown-item"><?php echo $dictionary['dictionary_name'] ?></a>
                                <?php } ?>
                            </div>
                        </div>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">特約商店<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <?php foreach ($merchants as $merchant) { ?>
                                  <a href="post_view.php?merchant_id=<?php echo $merchant['merchant_id'] ?>" class="dropdown-item"><?php echo $merchant['name'] ?></a>
                                <?php } ?>
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
                            <h2 align="center" style="margin-top: 10px;">我的個人資料</h2>
                        </div>


                    </div>
                </nav>          
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                </nav>        
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="container">
                            <div class="main-body">
                                  <div class="row gutters-sm">
                                    <div class="col-md-4 mb-3">
                                      <div class="card">
                                        <div class="card-body">
                                          <div class="d-flex flex-column align-items-center text-center">
                                            <img src="img/girl.jpg" alt="Admin" class="rounded-circle" width="150">
                                            <div class="mt-3">
                                              <h4><?php echo $user['name'] ?></h4>
                                              <p class="text-secondary mb-1"><?php echo $user['identity'] ?></p>
                                              <p class="text-muted font-size-sm"><?php echo $user['email'] ?></p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                        
                                      <div class="card mt-3">
                                          <div class="card h-100">
                                            <div class="card-body">
                                              <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">我的</i>活動紀錄</h6>
                                              <small>發布過幾篇文章:<?php echo $postCount ?>篇</small>
                                              <div class="progress mb-3" style="height: 5px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                              <small>文章獲得的coin:<?php echo $donatCoin ?></small>
                                              <div class="progress mb-3" style="height: 5px">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-8">
                                      <div class="card mb-3">
                                        <div class="card-body">
                                          <div class="row">
                                            <div class="col-sm-3">
                                              <h6 class="mb-0">使用者姓名</h6>
                                            </div>
                                            <div class="text-muted font-size-sm"><?php echo $user['name'] ?></div>
                                          </div>
                                          <hr>
                                          <div class="row">
                                            <div class="col-sm-3">
                                              <h6 class="mb-0">暱稱</h6>
                                            </div>
                                            <div class="text-muted font-size-sm"><?php echo $user['nickname'] ?></div>
                                          </div>
                                          <hr>
                                          <div class="row">
                                            <div class="col-sm-3">
                                              <h6 class="mb-0">學號</h6>
                                            </div>
                                            <div class="text-muted font-size-sm"><?php echo $user['number'] ?></div>
                                          </div>
                                          <hr>
                                          <div class="row">
                                            <div class="col-sm-3">
                                              <h6 class="mb-0">性別</h6>
                                            </div>
                                            <div class="text-muted font-size-sm"><?php echo $user['gender'] ?></div>
                                          </div>
                                          <hr>
                                          <div class="row">
                                            <div class="col-sm-3">
                                              <h6 class="mb-0">學系</h6>
                                            </div>
                                            <div class="text-muted font-size-sm"><?php echo $user['subject'] ?></div>
                                          </div>
                                          <hr>
                                          <div class="row">
                                            <div class="col-sm-3">
                                              <h6 class="mb-0">電話</h6>
                                            </div>
                                            <div class="text-muted font-size-sm"><?php echo $user['phone'] ?></div>
                                          </div>
                                          <hr>
                                          <div class="row">
                                            <div class="col-sm-3">
                                              <h6 class="mb-0">電子信箱</h6>
                                            </div>
                                            <div class="text-muted font-size-sm"><?php echo $user['email'] ?></div>
                                          </div>
                                          <hr>
                                          <div class="row">
                                            <div class="col-sm-3">
                                              <h6 class="mb-0">公鑰</h6>
                                            </div>
                                            <div class="col-sm-9 text-muted font-size-sm"><?php echo $user['public_key'] ?></div>
                                          </div>
                                          <hr>
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <a class="btn btn-primary " target="__blank" href="user_information_update.php">修改個人資料</a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                        
                                 
                                      </div>
                                    </div>
                                  </div>
                        
                                </div>
                            </div>
                    </div>
                </div>
                <section id="services-list" class="services-list">
                    <div class="container" data-aos="fade-up">
                        
                      <div class="section-header">
                        <h2>content</h2>

                      </div>
<!--
                      <div class="flex-column gy-5" style="align-items: center;">

                        <div class="" data-aos="fade-up" data-aos-delay="200" style="margin-left:20%;">
                          <div class=""><i class="fa fa-user" style="color: #aeccf2;"></i></div>
                          <div>
                            <h4 class="title"><a href="#" class="">我的錢包</a></h4>

                          </div>
                        </div> -->



                      </div>

                    </div>
                  </section>
                
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Featured Start -->

    <div class="container-fluid pt-5">
    </div>

    <!-- Featured End -->


    <!-- Categories Start -->

    <div class="container-fluid pt-5">
    </div>

    <!-- Categories End -->


    <!-- Offer Start -->

    <div class="container-fluid offer pt-5">
    </div>

    <!-- Offer End -->


    <!-- Products Start -->
    </div>

    <!-- Products End -->
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