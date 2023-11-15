<?php
    include "./config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scraping BMKG</title>

    <!-- CSS - plugin -->
    <link rel="shortcut icon" href="./assets/images/logo-bmkg.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./assets/plugins/adminlte/adminlte.min.css">
    <link rel="stylesheet" href="./assets/plugins/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./assets/plugins/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./assets/plugins/datatable/buttons.bootstrap4.min.css">
    <!-- CSS - custom -->
    <link rel="stylesheet" href="./assets/css/sidebar.css">

    <!-- JS - plugin -->
    <script src="./assets/plugins/jquery/jquery.min.js"></script>
    <script src="./assets/plugins/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="./assets/plugins/adminlte/adminlte.min.js"></script>
    <script src="./assets/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="./assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="./assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="./assets/plugins/datatable/dataTables.buttons.min.js"></script>
    <!-- JS - custom -->
    <script>BASE_URL = "<?= $BASE_URL ?>"</script>
    <script src="./assets/js/index.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar (Start) -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Navbar (End) -->

        <!-- Sidebar (Start) -->
        <aside class="main-sidebar sidebar-dark-secondary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link text-center d-flex align-items-center" style="flex-direction: column">
                <img src="./assets/images/logo-bmkg.png" alt="logo scraping data bmkg" class="" style="opacity: .8; width: 70%">
                <span class="brand-text font-weight-bold mt-4">
                    SCRAPING DATA <br>
                    BMKG
                </span>
            </a>

            <div class="sidebar">
                <nav class="user-panel pb-2 pt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                        <li class="nav-item mb-2">
                            <a href="" class="nav-link active">
                                <p>Gempa Terkini</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Sidebar (End) -->

        <!-- Gempa Terkini (Start) -->
        <div class="content-wrapper">
            <!-- Header - content -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 px-2">
                        <div class="col-sm-6">
                            <h1 class="text-secondary">GEMPA TERKINI</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#" class="text-primary">Dashboard</a></li>
                                <li class="breadcrumb-item active">gempa terkini</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Body - content -->
        	<div class="content mt-4">
        		<div class="container-fluid">
                    <!-- alert -->
                    <div class="row mb-2 px-3">
                        <div id="alert_rsync_gempaterkini" class="alert alert-dismissible w-100">
                            <button type="button" class="close">&times;</button>
                            <span></span>
                        </div>
                    </div>

                    <!-- btn rsync -->
                    <div class="row mb-4 px-2">
                        <div class="col-12 d-flex justify-content-end">
                            <a href="" id="btn_rsync_gempaterkini" class="btn btn-block btn-secondary btn-md" style="width: max-content;">
                                <i class="fas fa-sync-alt"></i> &nbsp; rsync
                            </a>
                        </div>
                    </div>

                    <div class="row px-2">
                        <div class="col-md-12">
                            <div class="card card-secondary card-outline">
                                <div class="card-header">
                                    <table id="tabel_gempaterkini" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="align-middle">
                                                    No
                                                </th>
                                                <th class="align-middle">
                                                    Tanggal
                                                </th>
                                                <th class="align-middle">
                                                    Jam
                                                </th>
                                                <th class="align-middle">
                                                    Koordinat
                                                </th>
                                                <th class="align-middle">
                                                    Lintang
                                                </th>
                                                <th class="align-middle">
                                                    Bujur
                                                </th>
                                                <th class="align-middle">
                                                    Kekuatan
                                                </th>
                                                <th class="align-middle">
                                                    Kedalaman
                                                </th>
                                                <th class="align-middle">
                                                    Wilayah
                                                </th>
                                                <th class="align-middle">
                                                    Keterangan
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gempa Terkini (End) -->

    </div>
</body>
</html>