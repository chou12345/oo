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
                <a href="index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">輔來輔厲害</span></h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left" style="opacity:0.9;">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="搜尋交易紀錄">
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

                <a href="user_wallet.php" class="btn border">
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
                                class="text-primary font-weight-bold border px-3 mr-1"></span></h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <h2 style="margin-top:10px">交易紀錄</h2>
                        </div>
                    </div>
                </nav>
                <div>
                    <form>
                        <table id="transaction_table" class="table">

                        </table>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Featured Start -->

    <div class="container-fluid pt-5">

    </div>

    <div class="container-fluid pt-5">

    </div>

    <div class="container-fluid offer pt-5">

    </div>

    </div>

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
    <script src="js/loadBasis.js"></script>
    <script>
        $(document).ready(async function () {
            const tableHeaders = [
                { key: 'time', name: '時間' },
                { key: 'coin', name: '金額' },
                { key: 'detail', name: '交易明細' }
            ];
            const userInfo = getUserInfo();
            $.ajax({
                url: getAjaxUrl('transaction', 'getRecords'),
                dataType: "JSON",
                success: function (res) {
                    const data = res.map(r => ({ ...r, time: r?.time?.substr(0, 16), coin : parseInt(r.coin) }));

                    $('#transaction_table').html(`
                            <thead>
                                <tr>
                                    <th>編號</th>
                                    ${tableHeaders
                                        .filter(th => data[0][th.key])
                                        .map(th => `<th>${th.name}</th>`).join("")}
                                </tr>
                            </thead>
                            <tbody>
                                

                            ${data.map((datum, i) => `
                                <tr style="background: ${datum.source === 'in' ? '#e5ffe5' : '#fce4e1'}">
                                    <td>${i + 1}</td>
                                    ${tableHeaders
                                        .filter(th => data[0][th.key])
                                        .map(th => `<td>${datum[th.key]}</td>`).join("")}
                                </tr >
                            `).join("")}
                            </tbody >
                            `);

                }
            })

        })
    </script>
</body>

</html>