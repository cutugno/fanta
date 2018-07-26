<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="page-header"><i class="fa fa-user" aria-hidden="true"></i> Profilo</h3>
			<!--
			<ol class="breadcrumb">
			  <li><i class="fa fa-lightbulb-o" aria-hidden="true"></i><a href="<?= site_url('admin/users') ?>"> Admin</a></li>
			  <li><i class="fa fa-table" aria-hidden="true"></i> Gestione risultati</li>
			</ol>
			-->
		</div>
	</div>	
	<div class="panel panel-default">	
		<div class="panel-body">
			<?php 
				$attr=array("class"=>"form-horizontal","id"=>"user_form");
				echo form_open("#",$attr);
				echo form_hidden("old_username",$user->username);
			?>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label">Username *</label>
						<div class="col-sm-9">
							<?php 
								$attr = array(
									'name'          => 'username',		
									'id'			=> 'username',				
									'class'			=> 'form-control',
									'placeholder'	=> 'Inserisci username',
									'value'			=> $user->username
								);
								echo form_input($attr);					
							?>	            
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Nome *</label>
						<div class="col-sm-9">
							<?php 
								$attr = array(
									'name'          => 'nome',						
									'id'     	    => 'nome',						
									'class'			=> 'form-control',
									'placeholder'	=> 'Inserisci nome',
									'value'			=> $user->nome
								);
								echo form_input($attr);					
							?>	  
						</div>
					</div>							
					<div class="form-group">
						<label class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							<?php 
								$attr = array(
									'name'          => 'email',						
									'id'            => 'email',						
									'class'			=> 'form-control',
									'type'			=> 'email',
									'placeholder'	=> 'Inserisci email',
									'value'			=> $user->email
								);
								echo form_input($attr);					
							?>	  
						</div>
					</div>				
					<div class="form-group">
						<label class="col-sm-3 control-label">Password</label>
						<div class="col-sm-9">
							<?php 
								$attr = array(
									'name'          => 'password',		
									'id'			=> 'password',				
									'class'			=> 'form-control',
									'placeholder'	=> 'Inserisci password (min 6 caratteri)'
								);
								echo form_password($attr);					
							?>	            
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Conferma</label>
						<div class="col-sm-9">
							<?php 
								$attr = array(
									'name'          => 'c_password',						
									'id'            => 'c_password',						
									'class'			=> 'form-control',
									'placeholder'	=> 'Conferma password'
								);
								echo form_password($attr);					
							?>	             
						</div>
					</div>								
				</div>
				<div class="col-xs-12 col-sm-6">
					<label>Carica avatar</label>
					
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<?php
								$attr = array(
										'id'            => 'btn_update',
										'class'			=> 'btn btn-primary',
										'type'          => 'submit',
										'content'		=> '<i class="fa fa-floppy-o" aria-hidden="true"></i> Aggiorna profilo'
								);
								echo form_button($attr);
							?>
						</div>
					</div>
				</div>
			</div>
			<?= form_close() ?>
		</div>
	</div>	
</div>
