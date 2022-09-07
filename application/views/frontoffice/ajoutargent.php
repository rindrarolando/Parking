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
    <title>Alimenter le porte-feuille</title>

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
								<?php if($this->session->userdata('session_user')==null){ ?>
									<li>
										<a href="<?=base_url()?>welcome/acceuil">Places de parking</a>
									</li>
									<li>
										<a href="<?=base_url()?>welcome">Login</a>
									</li>
									<li>
										<a href="<?=base_url()?>welcome/inscription">Inscription</a>
									</li>
									
								<?php }else{ ?>
									<li>
										<a href="<?=base_url()?>welcome/acceuil">Places de parking</a>
									</li>
									<li>
										<a href="<?=base_url()?>welcome/alimentation">Ajouter de l'argent</a>
									</li>
									
								<?php } ?>
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
								<?php if($this->session->userdata('session_user')==null){ ?>
									<li>
										<a href="<?=base_url()?>welcome/acceuil">Places de parking</a>
									</li>
									<li>
										<a href="<?=base_url()?>welcome">Login</a>
									</li>
									<li>
										<a href="<?=base_url()?>welcome/inscription">Inscription</a>
									</li>
									
								<?php }else{ ?>
									<li>
										<a href="<?=base_url()?>welcome/acceuil">Places de parking</a>
									</li>
									<li>
										<a href="<?=base_url()?>welcome/alimentation">Ajouter de l'argent</a>
									</li>
									
								<?php } ?>
                                
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
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity">1</span>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>Historiques:</p>
                                            </div>
                                            <div class="mess__item">
												<?php if($fortickets != null){ ?>
													<?php foreach($fortickets as $park){?>
														<div class="image img-cir img-40">
															<a href="<?php echo base_url()?>tarifcontroller/ticket/<?=$park->id?>"><img src="<?=base_url()?>/assets/images/icon/logopark.png" alt="parking" /></a>
														</div>
														<div class="content">
															<a href="<?php echo base_url()?>tarifcontroller/ticket/<?=$park->id?>"><h6><?=$park->numero_voiture?></h6></a>
															<a href="<?php echo base_url()?>tarifcontroller/ticket/<?=$park->id?>"><p>Place n° <?=$park->id_place?></p></a>
															<a href="<?php echo base_url()?>tarifcontroller/ticket/<?=$park->id?>"><p><?=$park->debut?></p></a>
															<?php if($park->amende==true){ ?>
																<a href="<?php echo base_url()?>tarifcontroller/ticket/<?=$park->id?>"><p>Amende :<span class="time">150.000ar</span></p></a>
															<?php }else{ ?>
																<a href="<?php echo base_url()?>tarifcontroller/ticket/<?=$park->id?>"><p>Amende :<span class="time">0ar</span></p></a>
															<?php } ?>
															
														</div>
													<?php } ?>
												<?php } ?>
                                            </div>
                                            
                                            <div class="mess__footer">
                                                <a href="#">Voir toute l'historique</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="<?=base_url()?>/assets/images/icon/avatar-01.png" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">john doe</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="<?=base_url()?>/assets/images/icon/avatar-01.png" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
													<?php if($this->session->userdata('session_user') != null) {?>
														<?php $utilisateur = $this->Utilisateur->getUtilisateur($this->session->userdata('session_user')); ?>
														<h5 class="name">
															<a href="#"><?=$utilisateur['nom']?> <?=$utilisateur['prenom']?></a>
														</h5>
														<span class="email"><?=$utilisateur['login']?></span>
													<?php }else{ ?>
															<h5 class="name">
																<a href="#">Non connecté</a>
															</h5>
															<a href="<?=base_url()?>welcome"><span class="email">se connecter</span></a>
														<?php } ?>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
												<?php if($this->session->userdata('session_user') != null) {?>
													<?php $utilisateur = $this->Utilisateur->getUtilisateur($this->session->userdata('session_user')); ?>
													<div class="account-dropdown__item">
														<a href="#">
															<i class="zmdi zmdi-account"></i><?=$utilisateur['money']?> ariary</a>
													</div>
													<?php } ?>
                                            </div>
                                            <?php if($this->session->userdata('session_user') != null) {?>
												<div class="account-dropdown__footer">
													<a href="<?php echo base_url()?>user/logout">
														<i class="zmdi zmdi-power"></i>Logout</a>
												</div>
											<?php } ?>
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
                                        <strong>Alimentation de porte-feuille</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="<?php echo base_url('welcome/alimenter') ?>" method="post" class="form-horizontal">
										
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Montant</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" value="<?php echo set_value('money')?>" id="text-input" name="money" placeholder="montant..." class="form-control">
                                                    <small class="form-text text-muted">en ariary</small>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Virer
                                            </button>
                                        </form>
										<?php if($flash != null) {?>
											<p style="color:red"><?=$flash?></p>
										<?php } ?>
										<?php echo validation_errors()?>
										
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
