<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Specifier getNow</title>

    <!-- Fontfaces CSS-->
    <?php include('back/css.php')?>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="<?=base_url()?>/admin/places">
                            <img src="<?=base_url()?>/assets/images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        
                        
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
								<li>
                                    <a href="<?=base_url()?>admin/places">Places de parking</a>
                                </li>
                                <li>
                                    <a href="<?=base_url()?>admin/tarifs">Voir les tarifs</a>
                                </li>
                                <li>
                                    <a href="<?=base_url()?>tarifcontroller/ajout">Ajouter un tarif</a>
                                </li>
								<li>
                                    <a href="<?=base_url()?>admin/validation">Ajouts d'argent</a>
                                </li>
								<li>
                                    <a href="<?=base_url()?>admin/setnow">Modifier getNow</a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="<?=base_url()?>/admin/places">
                    <img src="<?=base_url()?>/assets/images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="<?=base_url()?>admin/places">Places de parking</a>
                                </li>
                                <li>
                                    <a href="<?=base_url()?>admin/tarifs">Voir les tarifs</a>
                                </li>
                                <li>
                                    <a href="<?=base_url()?>tarifcontroller/ajout">Ajouter un tarif</a>
                                </li>
								<li>
                                    <a href="<?=base_url()?>admin/validation">Ajouts d'argent</a>
                                </li>
								<li>
                                    <a href="<?=base_url()?>admin/setnow">Modifier getNow</a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="<?=base_url()?>/assets/images/icon/avatar-01.png" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="<?=base_url()?>/assets/images/icon/avatar-01.png" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">Administrateur</a>
                                                    </h5>
                                                    <span class="email">connecté</span>
                                                </div>
                                            </div>
                                            
                                            <div class="account-dropdown__footer">
                                                <a href="<?php echo base_url()?>admin/logout">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
								<div class="card">
                                    <div class="card-header">
                                        <strong>Specifier GetNow</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="<?php echo base_url('admin/specifier') ?>" method="post" class="form-horizontal">
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">GetNow</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" value="<?php echo $this->Time->getNow();?>" id="text-input" name="getnow" class="form-control">
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Specifier getNow
                                            </button>
											
                                        </form>
										
										<?php echo validation_errors()?>
										
                                    </div>
                                </div>
								<div class="card">
                                    <div class="card-header">
                                        <strong>Retirer getNow</strong>
                                    </div>
                                    <div class="card-body card-block">
										<a href="<?=base_url()?>admin/retirer"><button class="btn btn-danger btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> retirer getNow
                                        </button></a>
										
                                    </div>
                                </div>
								
                        </div>
						
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTAINER-->

    </div>

    <!-- Jquery JS-->
    <?php include('back/js.php')?>

</body>

</html>
<!-- end document-->
