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
			<?php if ($this->session->user->level > 1) : ?>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-key" aria-hidden="true"></i> Gestione <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="<?= site_url('admin/users') ?>">Utenti</a></li>            
				<li><a href="<?= site_url('admin/matches') ?>">Partite</a></li>            
			  </ul>
			</li> 
			<?php endif ?>
			<li><a href="<?= site_url('predictions') ?>">Pronostici</a></li>
			<li><a href="<?= site_url('results') ?>">Risultati</a></li>
			<li><a href="<?= site_url('rankings') ?>">CLassifica</a></li>
	  </ul>
     
      <ul class="nav navbar-nav navbar-right">  
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-o" aria-hidden="true"></i> <?php echo $this->session->user->username ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" id="changepwd">Cambio Password</a></li>            
          </ul>
        </li>   
		<li><a href="<?php echo site_url('logout') ?>">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- modale cambio password -->
<div class="modal fade" tabindex="-1" role="dialog" id="password_modal">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
		<?php 
			$attr = array('id' => 'form_password');
			echo form_open('#', $attr);			
		?>
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Modifica password</h4>
	  </div>
	  <div class="modal-body">		
		  <div class="form-group">
			<label for="old_password">Vecchia password *</label>
			<?php 
				$attr = array(
					'name'			=> 'old_password',
					'class'			=> 'form-control'
				);
				echo form_password($attr);		
			?>			
		  </div>
		  <div class="form-group">
			<label for="new_password">Nuova password *</label>
			<?php 
				$attr = array(
					'name'			=> 'new_password',
					'class'			=> 'form-control'
				);
				echo form_password($attr);		
			?>			
		  </div>
		  <div class="form-group">
			<label for="conf_password">Conferma password *</label>
			<?php 
				$attr = array(
					'name'			=> 'conf_password',
					'class'			=> 'form-control'
				);
				echo form_password($attr);		
			?>			
		  </div>		 
	  </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
        <button type="button" class="btn btn-primary" id="btn_save_password" data-url="<?= site_url('login/setpassword') ?>">Salva</button>
      </div>
		<?php echo form_close() ?>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
