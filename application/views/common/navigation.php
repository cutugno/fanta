<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="index.html" class="logo">Nice <span class="lite">Admin</span></a>
      <!--logo end-->

	 <!--	search form
      <div class="nav search-row" id="top_menu">
        <ul class="nav top-menu">
          <li>
            <form class="navbar-form">
              <input class="form-control" placeholder="Search" type="text">
            </form>
          </li>
        </ul>
      </div>
      -->

      <div class="top-nav notification-row">
        <!-- notification dropdown start-->
        <ul class="nav pull-right top-menu">
			
		 <!-- admin button -->
		 <?php if ($this->session->user->level > 1) : ?>
		 <li id="admin_button" class="dropdown">
			 <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="icon_lightbulb"></i> ADMIN                            
                        </a>
            <ul class="dropdown-menu extended notification">
              <div class="notify-arrow notify-arrow-yellow"></div>
              <li>
                <p class="yellow">ADMIN</p>
              </li>
              <li>
                <a href="<?= site_url('admin/users') ?>"><i class="icon_profile"></i> Gestione utenti</a>
                <a href="<?= site_url('admin/matches') ?>"><i class="icon_documents_alt"></i> Gestione partite</a>
                <a href="<?= site_url('admin/results') ?>"><i class="icon_table"></i> Gestione risultati</a>
              </li>
           </ul> 
		 
		 </li>
		 <?php endif ?>
		 
         
          <!-- alert notification start-->
          <li id="alert_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="icon_error-circle_alt"></i>                           
                        </a>
            <ul class="dropdown-menu extended notification">
              <div class="notify-arrow notify-arrow-blue"></div>
              <li>
                <p class="blue">You have 4 new notifications</p>
              </li>
              <li>
                <a href="#">
                                    <span class="label label-primary"><i class="icon_profile"></i></span>
                                    Friend Request
                                    <span class="small italic pull-right">5 mins</span>
                                </a>
              </li>
              <li>
                <a href="#">
                                    <span class="label label-warning"><i class="icon_pin"></i></span>
                                    John location.
                                    <span class="small italic pull-right">50 mins</span>
                                </a>
              </li>
              <li>
                <a href="#">
                                    <span class="label label-danger"><i class="icon_book_alt"></i></span>
                                    Project 3 Completed.
                                    <span class="small italic pull-right">1 hr</span>
                                </a>
              </li>
              <li>
                <a href="#">
                                    <span class="label label-success"><i class="icon_like"></i></span>
                                    Mick appreciated your work.
                                    <span class="small italic pull-right"> Today</span>
                                </a>
              </li>
              <li>
                <a href="#">See all notifications</a>
              </li>
            </ul>
          </li>
          <!-- alert notification end-->
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="<?= site_url('img/avatar1_small.jpg') ?>">
                            </span>
                            <span class="username"><?= $this->session->user->nome ?></span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="<?= site_url('profile') ?>"><i class="icon_profile"></i> Profilo</a>
              </li>
         
              <li>
                <a href="<?= site_url('logout') ?>"><i class="icon_key_alt"></i> Log Out</a>
              </li>
   
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notification dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="<?= base_url() ?>">
				  <i class="fa fa-laptop"></i>
				  <span>Dashboard</span>
			  </a>
          </li>
          <li>
            <a class="" href="<?= site_url('predictions') ?>">
				  <i class="icon_pencil-edit"></i>
				  <span>Pronostici</span>
			  </a>
          </li>
          <li>
            <a class="" href="<?= site_url('results') ?>">
				  <i class="icon_table"></i>
				  <span>Risultati</span>
			  </a>
          </li>
          <li>
            <a class="" href="<?= site_url('rankings') ?>">
				  <i class="icon_ol"></i>
				  <span>Classifica</span>
			  </a>
          </li>
         
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
