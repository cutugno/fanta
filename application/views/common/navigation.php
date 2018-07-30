<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= base_url() ?>">FANTA</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?= site_url('predictions') ?>">Pronostici</a></li>
        <li><a href="<?= site_url('results') ?>">Risultati</a></li>
        <li><a href="<?= site_url('standings') ?>">Classifica</a></li>
        <?php if ($this->session->user->level > 1) : ?> 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?= site_url('admin/users') ?>">Utenti</a></li>
            <li><a href="<?= site_url('admin/calendar') ?>">Calendario</a></li>
            <li><a href="<?= site_url('admin/results') ?>">Risultati</a></li>
            <li><a href="<?= site_url('admin/scores') ?>">Punteggi</a></li>
          </ul>
        </li>
        <?php endif ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">       		
        <li><a href="<?= site_url('profile') ?>">Hola, <?= $this->session->user->username ?> !</a></li>
        <li><a href="<?= site_url('logout') ?>">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
