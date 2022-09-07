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
    <title>Liste des places</title>

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
								<li>
                                    <a href="<?=base_url()?>admin/simulation">Simulation des états</a>
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
								<li>
                                    <a href="<?=base_url()?>admin/simulation">Simulation des états</a>
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
                            <?php foreach($places as $place){?>
                            <div class="col-md-3">
                                <div class="card <?php if($this->Place->getEtatPlace($place->id)=="disponible"){echo 'bg-primary';}
								elseif($this->Place->getEtatPlace($place->id)=="occupé"){echo 'bg-danger';}
								elseif($this->Place->getEtatPlace($place->id)=="infraction"){echo 'bg-warning';}?>">
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p class="text-light">Place numero <?=$place->id?></p>
                                            <footer class="blockquote-footer text-light">
                                                <a href="<?php echo base_url()?>/admin/deleteplace/<?=$place->id?>"><cite title="Source Title">Supprimer</cite></a>
                                            </footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
							<?php } ?>

                            <!--<div class="col-md-4">
                                <div class="card bg-warning">
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0 text-light">
                                            <p class="text-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat
                                                a ante.</p>
                                            <footer class="blockquote-footer text-light">Someone famous in
                                                <cite title="Source Title">Source Title</cite>
                                            </footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card bg-danger">
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0 text-light">
                                            <p class="text-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat
                                                a ante.</p>
                                            <footer class="blockquote-footer text-light">Someone famous in
                                                <cite title="Source Title">Source Title</cite>
                                            </footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>-->

                            
                        </div>
						<a href="<?php echo base_url()?>/admin/ajouterplace"><button class="btn-success">Ajouter</button></a>
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
