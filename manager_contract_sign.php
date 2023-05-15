<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
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
    <!--bootstrap-->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!--    計算100-->
    <script>
  function calculateAndValidate() {
    var profit_manager = parseInt(document.getElementById('profit_manager').value);
    var profit_merchant = parseInt(document.getElementById('profit_merchant').value);

    var total = profit_manager + profit_merchant;
    if (total === 100) {
      $('#private_key_input').modal('show');
}
     else {
      alert('总和不等于100。');
      $('#private_key_input').modal('hide');
    }
  }

  function submitForm() {
    // 在这里执行表单提交或其他相关操作
    document.querySelector("form").submit();
  }
</script>
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
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">

                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">

                            </span>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
               <a href="manager_wallet.php" class="btn border">
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

                            <div class="nav-item dropdown">
                             <a href="#" class="nav-link" data-toggle="dropdown">平台內容管理<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="article_category.php" class="dropdown-item">文章類別</a>
                                <a href="article_view.php" class="dropdown-item">文章內容</a>
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
<!--            改-->
                <?php
                //fifi testing
//                $conn=mysqli_connect("localhost","root");
//                     mysqli_select_db($conn, "system");
                $conn=mysqli_connect("localhost","root","12345678","system");
                date_default_timezone_set('Asia/Taipei');
                $start_time = date('Y/m/d H:i:s');
                // $sqlfi = "INSERT INTO `profit_contract` (`contract_id`, `manager_id`, `merchant_id`, `title`, `context`, `profit_manager`, `profit_merchant`, `start_time`, `contract_status`) VALUES (NULL, '-1', '12345678', '智能合約', 't', '10', '90', '2023-05-02 00:00:00', '簽訂中');";
                // mysqli_query($conn, $sqlfi);

            <form method="post" action="contract_conn.php">
            <input type="hidden" name="method" value="manager_insert">
            <input type=hidden name="title" value="智能合約">
                <input type="hidden" name="manager_id" value="1">
                <input type="hidden" name="start_time" value="">
                <input type="hidden" name="contract_status" value="簽訂中">
                 <input type="hidden" name="status_manager" value="接受">
                 <input type="hidden" name="status_merchant" value="待確認">
            <div class="card mb-3" style="padding: 30px 50px 30px 50px">
                             <h1 align="center" style="margin-top: 10px;">簽訂智能合約</h1>
                    <br><p>
                                                茲雙方基於共同利益，就特約事項雙方同意共同遵守下列約定：
                                                 </p>
                                            <div class="card-body">
                                             <div class="contract-article border" style="padding: 15px; border-radius: 10px; box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
                                            <!-- https://www.w3schools.com/howto/howto_css_cards.asp -->
                                            <h4 >#簽約內容</h4>
                                            <p>商家方提供之優惠項目：</p>
                                            <ol>
                                                <input type="text" name="context">
                                            </ol>
                                                 <p>平台方提供之項目：</p>
                                                 <p>1. 於平台方網站提供商家方之資訊。</p>
                                                 <p>2. 商家於平台內累積之coin得轉為新台幣(1:1)。</p>
                                        </div>
                                            <br><br>
                                            <div class="row">
                                                <div class="col-sm-">
                                                    <h3><i class="fa fa-feather-alt" aria-hidden="true">平台</i></h3>

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
                                                    <div><input type="text" style="padding-left: 5px; width:100px; height: 100px;font-size:25px;text-align:center;" class="form-control" placeholder="分潤" aria-label="First name" name=profit_manager
                                                    id="profit_manager"></div>
                                                    <div style="padding: 28px 0px 0px 15px;font-size:30px"><h7>%</h7></div>
                                                </div>

                                                </td>
                                            </tr>
<!--
                                            <tr style="width: 60%;">
                                                <td><h7 class="mb-0">Donate coin</h7></td>

                                            </tr>
-->
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
                                                id:
                                                <div class="row" style="float:right ;margin-bottom:20px">
                                                <div><input type="text" style="padding-right:40px;width:220px;text-align:center;" class="form-control" placeholder="輸入id" aria-label="First name" name="merchant_id"
                                                ></div>
                                                    </div>
                                                </td>
                                                </tr>
                                            <tr style="height: 60px">
                                                <td style="width: 30%; text-align:left"><h7 class="mb-0">商品收益</h7></td>
                                                <td rowspan="2" style="vertical-align:middle;">

                                                <div class="row" style="vertical-align:middle;">
                                                    <div>
                                                        <input type="text" style="padding-left: 5px; width:100px; height: 100px;font-size:25px;text-align:center;" class="form-control" placeholder="分潤" aria-label="First name" name="profit_merchant"
                                                        id="profit_merchant"      ></div>
                                                    <div style="padding: 28px 0px 0px 15px;font-size:30px"><h7>%</h7></div>
                                                </div>

                                                </td>
                                            </tr>
                                    </table></div></div>
                              <br><br><br>

                                         <div class="row" style="text-align: center;">
                                            <div class="col-sm-12">
                                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" target="__blank" onclick="calculateAndValidate()" >送出</button>
<!--    Modal  -->
 <div class="modal fade" id="private_key_input" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">請輸入私鑰</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type=text name="private_key" id="private_key" style="text-align:center;" class="form-control" placeholder="輸入私鑰" aria-label="key">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">確認</button>
<!--        onclick="window.location.href='user_contract_list.php'">確認</button>-->
<!--          window 專屬-->
      </div>
    </div>
  </div>
</div>

                 </div>
                                          </div>
                </form>
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
<?php
//                                                          }
                                                          ?>