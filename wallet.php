<?php
session_start();
$accound_id = $_SESSION['account_id'];
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">輔來輔厲害</span></h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
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
                <?php
                if ($_SESSION['identity'] === 'general') {
                    echo '<a href="user_post_new.php" class="btn border">
                            <i class="fas fa-pen-nib text-primary"></i>
                            <span class="badge">發文</span>
                            </a>';
                }
                ?>

                <a href="wallet.php" class="btn border">
                    <i class="fas fa-piggy-bank text-primary"></i>
                    <span class="badge">錢包</span>
                </a>
                <a id="nav_dropdown" href="#" class="btn border" data-toggle="dropdown"></a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">總覽</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                    id="navbar-vertical"></nav>
            </div>

            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">輔來輔厲害</span></h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                </nav>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <div class="carousel-inner">
                            <h1 class="text-primary text-uppercase">我的錢包</h1>
                            <div class="container">
                                <div class="col-12 mt-4">
                                    <div class="card p-3">
                                        <h3 class="d-flex align-items-center mb-3"><i
                                                class="material-icons text-info mr-2">我的Coin:</i><span
                                                id="current_coin"></span>
                                            <button class="d-none" id="depositButton">
                                                <i class="fas fa-plus text-primary mr-1"></i>
                                            </button>
                                        </h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><br>
                    <?php
                    if ($_SESSION['identity'] === 'general') {
                        echo '<a id="payButton" href="#" class="btn border">
                                    <i class="fas fa-qrcode text-primary"></i>
                                    <span class="badge">我要付款</span>
                                </a>';
                    }
                    ?>

                    <br><br>
                    <a href="transaction.php" class="btn border">
                        <i class="fas fa-paste text-primary"></i>
                        <span class="badge">交易紀錄</span>
                    </a>
                    <br><br>

                    <a href="credit_card.html" class="btn border">
                        <!--                            <a href="綁定卡片.html" class="btn border">-->
                        <i class="fas fa-credit-card text-primary"></i>
                        <span class="badge">綁定卡片</span>
                    </a>
                    <br>
                </div>
            </div>
        </div>
    </div>

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
    <script src="js/loadBasis.js"></script>
    <script>

        $(document).ready(async function () {

            var userInfo = await getUserInfo() || {};

            loadDeposit();
            setDepositButton();
            setPayButton();

            function loadDeposit() {
                $.ajax({
                    url: getAjaxUrl('deposit', '/getTotalDeposit'),
                    dataType: 'JSON',
                    success: function (res) {
                        $('#current_coin').html(parseInt(res.total_deposit))
                    }
                })
            }


            function setDepositButton() {
                if (userInfo.identity !== 'general') {
                    return;
                }
                var $depositButton = $("#depositButton");
                $depositButton.removeClass("d-none");
                $depositButton.click(function () {
                    var amount = prompt("請輸入欲儲值金額");
                    if (amount == null || amount == "") {
                        alert("不儲值一下嗎？");
                    } else {
                        $.ajax({
                            url: 'api/deposit.php/addDepositRecord',
                            method: 'POST',
                            data: JSON.stringify({ amount }),
                            dataType: 'JSON',
                            success: function (res) {
                                location.reload();
                            }
                        })
                    }
                })
            }

            function setPayButton() {
                $('#payButton').on('click', function () {
                    const $body = $(`
                    <form>
                        <div class="form-group">
                            <label for="uniformNumber">統一編號</label>
                            <input type="text" class="form-control" id="uniformNumber" aria-describedby="unHelp">
                            <small id="unHelp" class="form-text text-muted">請輸入購買之商家的統一編號。</small>
                        </div>
                        <div class="form-group">
                            <label for="amount">金額</label>
                            <input type="number" class="form-control" id="amount">
                        </div>
                    </form>
                    `);

                    const confirmCallback = () => {
                        const uniformNumber = $body.find('#uniformNumber').val();
                        const amount = $body.find('#amount').val();
                        if (!uniformNumber || !amount) {
                            pushToast({ title: '請填寫相關欄位', type: 'error', message: '有欄位有缺值' });
                            return;
                        }
                        $.ajax({
                            url: getAjaxUrl('transaction', 'addConsumption'),
                            method: 'POST',
                            data: JSON.stringify({ uniformNumber, amount }),
                            dataType: 'JSON',
                            success: function (res) {
                                const { state, message, extra = {} } = res;
                                if (message === "BALANCE_IS_NOT_ENOUGH") {
                                    pushToast({ title: '餘額不足', type: 'error', message: `您的餘額為 ${extra?.balance || 0} coin，無法進行付款。` });
                                } else if (message === "MERCHANT_NOT_EXISTS") {
                                    pushToast({ title: '商家不存在', type: 'error', message: `商家不存在，請確認商家統一編號，並重新輸入。` });
                                } else {
                                    const balance = extra?.balance || 0;
                                    pushToast({ title: '扣款成功', type: 'ok', message: `扣款成功，您的餘額為 ${balance} coin。` });
                                    $('#current_coin').html(balance);
                                    closeModal();
                                }
                            }
                        });
                    }
                    openModal({ $title: '確認付款', $body, confirmCallback });
                })
            }

        })


    </script>
</body>

</html>