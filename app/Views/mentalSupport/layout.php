<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/lineicons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/materialdesignicons.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/fullcalendar.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" />

    <!-- Tabler Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.28.1/tabler-icons.min.css" rel="stylesheet">

    <style>
    .profile-picture {
    width: 50px;            /* Bisa disesuaikan */
    height: 50px;           /* Sama dengan width untuk bentuk lingkaran */
    border-radius: 50%;      /* Membuat elemen berbentuk lingkaran */
    overflow: hidden;        /* Supaya gambar nggak keluar dari lingkaran */
    border: 1px solid #dbeafe; /* (Opsional) efek garis luar */
    display: flex;
    justify-content: center;
    align-items: center;
    margin: auto;            /* Tengahin div */
    }

    .profile-picture img {
    width: 100%;
    height: 100%;
    object-fit: cover;       /* Ngepasin gambar tanpa mengubah rasio */
    }

    </style>

</head>

<body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="index.html">
                <img style="width: 100%;" src="<?=base_url('assets/images/logo/sinchan.png')?>" alt="logo" />
            </a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item">
                    <a href="invoice.html">
                       <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2" /><path d="M19 13.488v-1.488h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h4.525" /><path d="M15 19l2 2l4 -4" /></svg>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item nav-item-has-children">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_1"
                        aria-controls="ddmenu_1"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chart-column"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h3" /><path d="M17 20h3" /><path d="M10.5 20h3" /><path d="M4 16h3" /><path d="M17 16h3" /><path d="M10.5 16h3" /><path d="M4 12h3" /><path d="M17 12h3" /><path d="M10.5 12h3" /><path d="M4 8h3" /><path d="M17 8h3" /><path d="M4 4h3" /></svg>
                        <span class="text">Rekap Presensi</span>
                    </a>
                    <ul id="ddmenu_1" class="collapse dropdown-nav">
                        <li>
                            <a href="index.html">Rekap Harian </a>
                        </li>
                        <li>
                            <a href="index.html">Rekap Bulanan </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="invoice.html">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-error-404"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 8v3a1 1 0 0 0 1 1h3" /><path d="M7 8v8" /><path d="M17 8v3a1 1 0 0 0 1 1h3" /><path d="M21 8v8" /><path d="M10 10v4a2 2 0 1 0 4 0v-4a2 2 0 1 0 -4 0" /></svg>
                        <span class="text">Ketidakhadiran</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="invoice.html">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" /><path d="M15 12h-12l3 -3" /><path d="M6 15l-3 -3" /></svg>
                        <span class="text">Logout</span>
                    </a>
                </li>

            </ul>
        </nav>

    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-15">
                                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    <i class="lni lni-chevron-left me-2"></i> Menu
                                </button>
                            </div>
                            <div class="header-search d-none d-md-flex">
                                <form action="#">
                                    <input type="text" placeholder="Search..." />
                                    <button><i class="lni lni-search-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">


                            <!-- profile start -->
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            <div class="profile-picture">
                                                <img  src="<?=base_url('assets/images/profile/profil.jpg')?>" alt="" />
                                            </div>
                                            <div>
                                                <h6 class="fw-500"><?= session()->get('username')?> </h6>
                                                <p><?= session()->get('role_id')?></p>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <div class="author-info flex items-center !p-1">
                                            <div class="image">
                                                <img  src="<?=base_url('assets/images/profile/profil.jpg')?>" alt="" />
                                            </div>
                                            <div class="content">
                                                <h4 class="text-sm">Pretty Girl</h4>
                                                <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                                                    href="#">Email@gmail.com</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#0">
                                            <i class="lni lni-user"></i> View Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0">
                                            <i class="lni lni-alarm"></i> Notifications
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0"> <i class="lni lni-inbox"></i> Messages </a>
                                    </li>
                                    <li>
                                        <a href="#0"> <i class="lni lni-cog"></i> Settings </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#0"> <i class="lni lni-exit"></i> Sign Out </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- profile end -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">
                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="title">
                                <h2><?= $title ?></h2>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->

                <?= $this->renderSection('content')?>
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

    </main>
    <!-- ======== main-wrapper end =========== -->


    <!-- ========= All Javascript files linkup ======== -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/Chart.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/dynamic-pie-chart.js') ?>"></script>
    <script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/fullcalendar.js') ?>"></script>
    <script src="<?= base_url('assets/js/jvectormap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/world-merc.js') ?>"></script>
    <script src="<?= base_url('assets/js/polyfill.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>

</html>