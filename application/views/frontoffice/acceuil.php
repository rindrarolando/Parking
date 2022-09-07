
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
    <title>Nos places</title>

    <!-- Fontfaces CSS-->
    <?php include('back/css.php')?>
	<style>
		/* Popup container - can be anything you want */
		.popup {
		position: relative;
		display: inline-block;
		cursor: pointer;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		}

		/* The actual popup */
		.popup .popuptext {
		visibility: hidden;
		width: 300px;
		background-color: #555;
		color: #fff;
		text-align: center;
		border-radius: 6px;
		padding: 8px 0;
		position: absolute;
		z-index: 1;
		bottom: 125%;
		left: 50%;
		margin-left: -80px;
		}

		/* Popup arrow */
		.popup .popuptext::after {
		content: "";
		position: absolute;
		top: 100%;
		left: 50%;
		margin-left: -5px;
		border-width: 5px;
		border-style: solid;
		border-color: #555 transparent transparent transparent;
		}

		/* Toggle this class - hide and show the popup */
		.popup .show {
		visibility: visible;
		-webkit-animation: fadeIn 1s;
		animation: fadeIn 1s;
		}

		/* Add animation (fade in the popup) */
		@-webkit-keyframes fadeIn {
		from {opacity: 0;} 
		to {opacity: 1;}
		}

		@keyframes fadeIn {
		from {opacity: 0;}
		to {opacity:1 ;}
		}
	</style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="<?=base_url()?>/admin/places">
                            <img src="<?=base_url()?>/assets/images/icon/princ.jpg" alt="CoolAdmin" />
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
                <a href="<?=base_url()?>/welcome/acceuil">
                    <img src="<?=base_url()?>/assets/images/icon/princ.jpg" alt="Cool Admin" />
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
															<?php if($park->amende==false){ ?>
																<a href="<?php echo base_url()?>tarifcontroller/ticket/<?=$park->id?>"><p>Amende :<span class="time">0ar</span></p></a>
																
															<?php }else{ ?>
																<a href="<?php echo base_url()?>tarifcontroller/ticket/<?=$park->id?>"><p>Amende :<span class="time"><?php $this->Tarif->getAmende($this->Place->getTempsInfraction($park->id))?>ar</span></p></a>
																<a href="<?php echo base_url()?>tarifcontroller/payeramende/<?=$park->id?>/<?=$this->session->userdata('session_user')?>"><button class="btn-primary">Payer</button></a>
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
											<?php if($this->session->userdata('session_user') != null) {?>
														<?php $utilisateur = $this->Utilisateur->getUtilisateur($this->session->userdata('session_user')); ?>
														<a class="js-acc-btn" href="#"><?=$utilisateur['nom']?> <?=$utilisateur['prenom']?></a>
													<?php }else{ ?>
														<a class="js-acc-btn" href="#">Non connecté</a>
														<?php } ?>
                                            
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
							<?php $i=0;?>
						<?php foreach($places as $place){?>
							<?php $i++; ?>
							<?php if($this->Place->getEtatPlace($place->id)=="disponible"){?>
								<?php $nblibre++ ;?>
							<?php }?>
							<?php if($this->Place->getEtatPlace($place->id)=="occupé"){?>
								<?php $nboccupe++ ;?>
							<?php }?>
							<?php if($this->Place->getEtatPlace($place->id)=="infraction"){?>
								<?php $nbinfraction++ ;?>
							<?php }?>

							<div class="col-md-3">
                                <aside class="profile-nav alt">
                                    <section class="card">
                                        <div class="card-header user-header alt <?php if($this->Place->getEtatPlace($place->id)=="disponible"){echo 'bg-success';}
										elseif($this->Place->getEtatPlace($place->id)=="occupé"){echo 'bg-danger';}
										elseif($this->Place->getEtatPlace($place->id)=="infraction"){echo 'bg-warning';}?>">
                                            <div class="media">
                                                <a href="#">
                                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?php echo base_url()?>assets/images/icon/logopark.png">
                                                </a>
                                                <div class="media-body">
                                                    <h2 class="text-light display-6">Place n°<?=$place->id?></h2>
                                                    <p><?=$this->Place->getEtatPlace($place->id)?></p>
													<?php if($this->Place->getVoiture($place->id)!= null){ ?>
														<p>par : <?= $this->Place->getVoiture($place->id)?></p>
													<?php } ?>
                                                </div>
                                            </div>
                                        </div>

										<div class="popup" onclick="myFunction<?=$i?>()">Afficher plus...
											<span class="popuptext" id="myPopup<?=$i?>">
												
														<?php if($this->Place->getEtatPlace($place->id)=="occupé" || $this->Place->getEtatPlace($place->id)=="infraction"){?>
															<p>Arrivée: <?=$this->Place->getArrivee($place->id)?></p>
														<?php }else{ ?>
																<p>Arrivée: Pas d'arrivée.</p>
															<?php } ?>
														
														<?php if($this->Place->getEtatPlace($place->id)=="occupé" || $this->Place->getEtatPlace($place->id)=="infraction"){?>
															<?php if($this->Place->getEtatPlace($place->id)=="occupé"){?>
																<p>Delai: <?= $this->Place->getTempsRestant($place->id)?></p>
															<?php } ?>
															<?php if($this->Place->getEtatPlace($place->id)=="infraction"){?>
																<p>Delai: <span style="color:red">dépassé</spans></p>
															<?php } ?>
														<?php }else{ ?>
																<p>Départ: Pas de delai.</p>
															<?php } ?>
														
														<?php if($this->session->userdata('session_user')!=null && $this->Utilisateur->checkMyPlace($this->session->userdata('session_user'),$place->id)==true && $this->Place->getVoiture($place->id)!= null && $this->Parking->getParkingOccupe($this->session->userdata('session_user'),$place->id,$this->Place->getVoiture($place->id))!=null ){?>
															<?php $parking = $this->Parking->getParkingOccupe($this->session->userdata('session_user'),$place->id,$this->Place->getVoiture($place->id)); ?>
															<a href="<?php echo base_url()?>welcome/exit/<?=$parking['id']?>"><buton class="btn-danger">Quitter cette place</buton></a>
														<?php }else{ ?>
																<p></p>
															<?php } ?>

														<?php if($this->Place->getEtatPlace($place->id)=="infraction"){?>
															<p style="color:crimson">Amende à payer: 150.000ar</p>
														<?php }else{ ?>
																<p style="color:crimson">Amende: Pas d'amende.</p>
															<?php } ?>
														
														<!--<?php if($this->Place->getEtatPlace($place->id)=="disponible"){?>
															<a href="<?php echo base_url()?>user/parknow/<?=$place->id?>"><buton class="btn-warning">Prendre cette place</buton></a>
															<?php }else{ ?>
																<p></p>
																<?php } ?>-->
														
														<?php if($this->Place->getEtatPlace($place->id)=="disponible"){?>
															<a href="<?php echo base_url()?>user/parklater/<?=$place->id?>"><buton class="btn-dark">Prendre cette place</buton></a>
														<?php }else{ ?>
																<p></p>
															<?php } ?>
														
											</span>
										</div>

                                    </section>
                                </aside>
                            </div>
							
							<script>
								// When the user clicks on div, open the popup
								function myFunction<?=$i?>() {
								var popup = document.getElementById("myPopup<?=$i?>");
								popup.classList.toggle("show");
								}
							</script>
						<?php } ?>

                            
                        </div>
                    </div>
                </div>
            </div>
			<p>Nombre de places libres= <?=$nblibre?></p>
			<p>Nombre de places occupées= <?=$nboccupe?></p>
			<p>Nombre de places en infaction= <?=$nbinfraction?></p>
        </div>
		
        <!-- END PAGE CONTAINER-->

    </div>

    <!-- Jquery JS-->
    <?php include('back/js.php')?>

</body>

</html>
<!-- end document-->
