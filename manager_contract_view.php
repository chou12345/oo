<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
//if($_SESSION['identity']==""){
if (isset($_GET['contract_id'])) {
    $contract_id = $_GET['contract_id'];
}else{
    echo "n";
}
$link=mysqli_connect("localhost", "root", "12345678", "system");
//$link=mysqli_connect("localhost","root");
        //mysqli_select_db($link, "system");
  $sql1="select * from profit_contract where contract_id='$contract_id'";
  $rs=mysqli_query($link,$sql1);
  if($record=mysqli_fetch_assoc($rs))
{
 $manager_id=$record["manager_id"];
 $merchant_id=$record['merchant_id'];
 $title=$record['title'];
 $context=$record['context'];
 $profit_manager=$record['profit_manager'];
 $profit_merchant=$record['profit_merchant'];
 $start_time=$record['start_time'];
 $status=$record['contract_status'];
}

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--aos animation-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!--bootstrap-->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
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
<!--
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
-->
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="manager_index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold px-3 mr-1">輔來輔厲害</span></h1>
                </a>
            </div>
           <div class="col-lg-6 col-6 text-left" style="opacity:0;">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="搜尋合約">
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
                    <span class="badge" margin="3px">管理者</span>
                    <i class="fas fa-caret-down text-primary"></i>
                    <div class="dropdown-menu position-absolute bg-secondary">
                        <a href="manager_index.php" class="dropdown-item">管理員首頁</a>
                        <a href="manager_contract_list.php" class="dropdown-item">我的合約</a>
                        <a href="manager_contract_sign.php" class="dropdown-item">新增合約</a>
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
                    <h6 class="m-0">管理者管理</h6>

                </a>

               <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">審核<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="report_post_view.php" class="dropdown-item">審核貼文</a>
                                <a href="report_reply_view.php" class="dropdown-item">審核留言</a>
                            </div>
                        </div>
                         <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
<!--
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">使用者帳號管理<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="suspend_view.php" class="dropdown-item">停權帳號</a>
                             </div>
                        </div>
-->
                            <div class="nav-item dropdown">
                             <a href="#" class="nav-link" data-toggle="dropdown">平台內容管理<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="article_category.php" class="dropdown-item">文章類別</a>
                                <a href="article_view.php" class="dropdown-item">文章內容</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                             <a href="#" class="nav-link" data-toggle="dropdown">合約內容管理<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="manager_contract_list.php" class="dropdown-item">合約管理</a>
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
                 <div class="card mb-3" style="padding: 10px">
                                        <h1 align="center" style="margin-top: 10px;">智能合約</h1>
                                        <div class="card-body">
                                        <div class="contract-article border" style="padding: 15px; border-radius: 10px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">

                                            <!-- https://www.w3schools.com/howto/howto_css_cards.asp -->
                                            <h4>#簽約商品</h4>
                                            <h4><b></b></h4>
                                            <ol>
                                            <?php echo $record['context'];?>
                                            </ol>
                                        </div>


                                        <br><br>
                                            <div class="row">
                                                <div class="col-sm-">
                                                    <h3><i class="fa fa-feather-alt" aria-hidden="true"> 參與的簽訂者</i></h3>

                                                </div>
                                                <div class="col-sm-">
                                                <h7></h7>
                                                </div>
                                            </div>

                                        <table id="t1" style="width: 100%";>
                                            <tr style="height: 50px">
                                            <th class="b"></th>
                                            <th align="middle" class="b">id</th>
                                            <th align="center" class="b">智能合約簽訂狀態</th>
                                            <th align="center" class="b">智能合約簽訂時間</th>
                                            </tr>
                                            <tr style="height: 50px">
                                            <td align="left" colspan="1" class="c">主簽訂人</td>
                                            <td align="center" colspan="1" class="a" ><?php echo $record['manager_id']?></td>
<!--                                            <td align="center" colspan="1" class="a"><i class="fa fa-check-circle" style=color:green>-->
                                            <td align="center" colspan="1" class="a">
                                                <?php echo $record['contract_status']?></i></td>
                                            <td align="center" colspan="1" class="a" id="date"><?php echo $record['start_time']?></td>
                                            <tr style="height: 50px">
                                            <td align="left" colspan="1" class="c">簽訂商家</td>
                                            <td align="center" colspan="1" class="a"><?php echo $record['merchant_id']?></td>
                                            <td align="center" colspan="1" class="a"></td>
                                            <td align="center" colspan="1" class="a" id="date"><?php echo $record['start_time']?></td>
                                            </tr></div></div></div></div></div>
                                        </table>
                                            <br>
                                            <hr>
                                            <!-- test -->
<!--
                                            <div class="row" >
                                                <div class="col-sm-4">
                                                <h7 class="mb-0">解鎖coin</h7>
                                                </div>
                                            <div class="row">


                                            </div>

                                          </div>
-->
<!--
                                            <br>
                                          <div class="row" >
                                            <div class="col-sm-4">
                                              <h7 class="mb-0">Donate coin</h7>
                                            </div>

                                            <div class="row">
                                            <div class="col-">
                                             <input type="text" style="margin-left: 5px;" class="form-control" placeholder="分潤趴數(0~100的整數)" aria-label="First name">
                                                </div>
                                                <div class="col-" style="margin-left: 10px;">
                                                    <h7>%</h7>
                                                    </div>
                                            </div>
                                          </div>
-->

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
                                            <table id="t1" style="width: 90%";>
                                            <tr style="height: 50px">
                                            <th class="b" style="width: 20%"></th>
                                            <th align="middle" style="width: 35%" class="b">id</th>
                                            <th align="middle" colspan="1"class="b"style="width: 35%">分潤趴數</th>
                                            </tr>
                                            <tr style="height: 50px">
                                            <td align="left" colspan="1" class="c">主簽訂人</td>
                                            <td align="center" colspan="1" class="a" ><?php echo $record['manager_id']?></td>
                                            <td align="center" colspan="1" class="a" ><?php echo $record['profit_manager']?>%</td>
                                            </tr>
                                            <tr style="height: 50px">
                                            <td align="left" colspan="1" class="c">簽訂商家</td>
                                            <td align="center" colspan="1" class="a"><?php echo $record['merchant_id']?></td>
                                            <td align="center" colspan="1" class="a" ><?php echo $record['profit_merchant']?>%</td>
                                            </tr>
                                        </table>
                                    <!--                <r></r>-->
<!--
                                            <div class="row">
                                            <div class="col-sm-4">
                                              <h7 class="mb-0">解鎖coin</h7>

                                            </div>
                                            <div class="row">
                                            <div class="col-">
                                            <input type="text" class="form-control" placeholder="分潤趴數(0~100的整數)"aria-label="First name">
                                            </div>
                                            <div class="col-" style="margin-left: 10px;">
                                                <h7>%</h7>
                                                </div>
                                          </div>
                                            </div>
-->
<!--
                                            <br>
                                           <div class="row">
                                            <div class="col-sm-4">
                                              <h7 class="mb-0" >Donate coin</h7>

                                            </div>
                                            <div class="row">
                                            <div class="col-">
                                               <input type="text" class="form-control" placeholder="分潤趴數(0~100的整數)"aria-label="First name">
                                            </div>
                                            <div class="col-" style="margin-left: 10px;">
                                                <h7>%</h7>
                                                </div>
                                          </div>
                                            </div>
-->
                                            <br>

                                          <div class="row" style="text-align: center;">
                                            <div class="col-sm-12">
                                              <a  class="btn btn-primary " target="__blank" href="manager_contract_list.php">了解！</a>
                                            </div>
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








    <!-- Footer Start -->
<!--
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">輔來輔厲害</span></h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
-->
    <!-- Footer End -->


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