<?php
    session_start();

$identity = $_SESSION['identity'];
//echo $identity;
$merchant_id = $_SESSION['merchant_id'];
//echo $merchant_id;
$contract_id_mer = $_GET['contract_id'];
//echo $contract_id_mer;
require_once __DIR__ . '/helpers/helper.php';
$categories = query("SELECT * FROM dictionary WHERE dictionary_kind = '".文章."'");
$merchants = query("SELECT * FROM merchant");
$contractCheck = query("select * from profit_contract where contract_id = $contract_id_mer")[0];
//print_r($contractCheck);


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
                                <a href="post_view.php?category_id=<?php echo $category['dictionary_id']?>" class="dropdown-item"><?php echo $category['dictionary_name']; ?></a>
                                <?php  } ?>
                            </div>
                        </div>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">特約商店<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <?php // foreach ($merchants as $merchant) { ?>
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
<!--                            <h2 align="center" style="margin-top: 10px;">合約資訊</h2>-->
                        </div>

                    </div>
                </nav>


                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </nav>
                <form method="post" action="contract_conn.php">

               <div class="card mb-3" style="padding: 30px 50px 30px 50px">
                                        <h1 align="center" style="margin-top: 10px;">確認智能合約</h1>
                                        <br>
                                        <?php
                    $conn=mysqli_connect("localhost","root","12345678","system");
                    $sql = "select * from profit_contract";
                    $result = mysqli_query($conn,$sql);
                    $rs=mysqli_query($conn,$sql);
                    $record=mysqli_fetch_row($rs);
                    date_default_timezone_set('Asia/Taipei');
                    $start_time = date('Y/m/d H:i:s');

                    ?>
                    <input type="hidden" name="method" value="merchant_check">

                                        <p>
                                                茲雙方基於共同利益，就特約事項雙方同意共同遵守下列約定：
                                                 </p>
                                        <div class="card-body">


                                        <!-- 簽訂內容 -->

                                        <div class="contract-article border" style="padding: 15px; border-radius: 10px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">

                                            <!-- https://www.w3schools.com/howto/howto_css_cards.asp -->
                                            <h4>#簽約商品</h4>
                                            <h4><b></b></h4>
                                            <p>商家方提供之優惠項目：</p>
                                            <ol>
                                                <?php echo $contractCheck['context'] ?>
                                                <!-- <input type="text" name="context" > -->

                                            </ol>
                                                 <p>平台方提供之項目：</p>
                                                 <p>1. 於平台方網站提供商家方之資訊。</p>
                                                 <p>2. 商家於平台內累積coin得轉為新台幣(1:1)。</p>

                                        </div>
                                        <br><br>
                                        <!-- 簽訂內容 -->
                                            <div class="row">
                                                <div class="col-sm-">
                                                    <h3><i class="fa fa-feather-alt" aria-hidden="true"> 平台</i></h3>

                                                </div>
                                                <div class="col-sm-">
                                                    <h7>輔來輔厲害</h7>
                                                </div>
                                            </div>
                                            <br>
                                            <!-- test -->
                                           <table style="width: 100%">
                                            <tr style="height: 60px">
                                                <td style="width: 30%; text-align:left"><h7 class="mb-0">平台抽成</h7></td>
                                                <td rowspan="2" style="vertical-align:middle;">
                                                <div class="row" style="vertical-align:middle;">
                                                    <div><input disabled style="padding-left: 5px; width:100px; height: 100px;font-size:30px; text-align:center;" class="form-control" aria-label="First name" value="<?php echo $contractCheck['profit_manager']?>"></div>
                                                    <div style="padding: 28px 0px 0px 15px;font-size:30px"><h7>%</h7></div>
                                                </div>

                                                </td>
                                            </tr>

                                        </table>

                                            <br>
                                            <br>
                                        <div class="row">
                                            <div class="col-sm-">
                                                <h3 ><i class="fa fa-feather-alt" aria-hidden="true" > 商家</i></h3>
                                            </div>
                                            <div class="col-sm-">
                                                <h7></h7>
                                            </div>
                                            <div class="text-muted font-size-sm">
                                            </div>
                                          </div>
                                            <br>
                                            <table style="width: 100%">
                                            <tr>
                                                <td>

                                                <div class="row" style="float:right ;margin:0px 0px 0px 0px;">
                                                id:
                                                <input disabled type="text" style="padding-right:40px;width:220px;text-align:center;" class="form-control" placeholder="<?php echo $merchant_id?>" aria-label="First name"></div>
                                                    </div>
                                                </td>
                                                </tr>
                                            <tr style="height: 60px">
                                                <td style="width: 30%; text-align:left"><h7 class="mb-0">商品收益</h7></td>
                                                <td rowspan="2" style="vertical-align:middle;">

                                                <div class="row" style="vertical-align:middle;">
                                                    <div><input disabled style="padding-left: 5px; width:100px; height: 100px;font-size:30px; text-align:center;" class="form-control" aria-label="First name" value="<?php echo $contractCheck['profit_merchant']?>"></div>
                                                    <div style="padding: 28px 0px 0px 15px;font-size:30px"><h7>%</h7></div>
                                                </div>

                                                </td>
                                            </tr>

                                        </table>

                                            <br><br><br>

                                         <div class="row" style="text-align: center;">
                                        <div class="col-sm-12">
                                              <!-- <input type="hidden" name="contract_status" value="已簽訂"> -->
                                              <input type="hidden" name="contract_id_mer" value="<?php echo $contract_id_mer?>">

                                              <button type="submit" class="btn btn-primary" name="contract_check" value="1"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop" target="__blank" style="margin-right: 150px;">
                                                接受!</button>
                                              <button type="submit"  class="btn btn-primary " name="contract_check" value="0"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop"target="__blank">
                                                駁回。</button>
                                </form>
<!--    Modal  -->
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" onclick="location.href=''">確認</button>
<!--        onclick="window.location.href='user_contract_list.php'">確認</button>-->
<!--          window 轉屬-->
      </div>
    </div>
  </div>
</div>




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