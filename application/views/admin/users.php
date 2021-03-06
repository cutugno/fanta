<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="page-header"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Admin</h3>
			<ol class="breadcrumb">
			  <li><i class="fa fa-lightbulb-o" aria-hidden="true"></i><a href="<?= site_url('admin/users') ?>"> Admin</a></li>
			  <li><i class="fa fa-users"></i> Gestione utenti</li>
			</ol>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-5">
			<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Nuovo utente</h3>
			</div>	
			<div class="panel-body">
				<?php 
					$attr=array("class"=>"form-horizontal","id"=>"user_form");
					echo form_open_multipart("#",$attr);
				?>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="col-sm-3 control-label">Username *</label>
							<div class="col-sm-9">
								<?php 
									$attr = array(
										'name'          => 'username',						
										'id'            => 'username',						
										'class'			=> 'form-control',
										'placeholder'	=> 'Inserisci username'
									);
									echo form_input($attr);					
								?>					
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Password *</label>
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
							<label class="col-sm-3 control-label">Conferma *</label>
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
						<div class="form-group">
							<label class="col-sm-3 control-label">Nome *</label>
							<div class="col-sm-9">
								<?php 
									$attr = array(
										'name'          => 'nome',						
										'id'     	    => 'nome',						
										'class'			=> 'form-control',
										'placeholder'	=> 'Inserisci nome'
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
										'placeholder'	=> 'Inserisci email'
									);
									echo form_input($attr);					
								?>	  
							</div>
						</div>		
						<div class="form-group">
							<label class="col-sm-3 control-label">Livello</label>
							<div class="col-sm-9">
								<?php 
									$attr = array(					
										'class'			=> 'form-control'
									);
									echo form_dropdown('level',array(1=>"Utente",2=>"Admin"),1,$attr);					
								?>	  
							</div>
						</div>		
									
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<div class="col-sm-9 col-sm-offset-3">
								<?php
									$attr = array(
											'id'            => 'btn_create',
											'class'			=> 'btn btn-primary',
											'type'          => 'submit',
											'content'		=> '<i class="fa fa-floppy-o" aria-hidden="true"></i> Salva utente'
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
		<div class="col-md-7">
			<!-- panel elenco -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Elenco utenti</h3>
				</div>	
				<div class="panel-body">
					<?php if ($users) : ?>		
					<table class="table table-bordered table-condensed tablesorter">
						<colgroup>
							<col width="120" />
							<col width="150" />
							<col width="130" />
							<col width="150" />
						</colgroup>
						<thead>
							<tr>
								<th class="text-center">USERNAME</th>
								<th class="text-center">NOME</th>
								<th class="text-center sorter-false">ULTIMO LOGIN</th>						
								<th class="filter-false sorter-false"></th>
							</tr>
						</thead>	
						<tbody>	
						<?php foreach ($users as $val) : ?>	
							<tr>
								<td class="text-center"><?= $val->username ?></td>
								<td class="text-center"><?= $val->nome ?></td>
								<td class="text-center"><?= isset($val->last_login) ? convertDateTime($val->last_login) : "-" ?></td>						
								<td class="text-center">
									<a href="<?php echo site_url('admin/users/'.$val->username) ?>">
									<?php
										$attr = array(
												'class'			=> 'btn btn-info btn-xs btn_manage_user',
												'type'          => 'button',
												'content'		=> '<i class="fa fa-pencil" aria-hidden="true"></i> Modifica'
										);
										echo form_button($attr);
									?>	
									</a>					
									<?php
										$attr = array(
												'class'			=> 'btn btn-warning btn-xs edit btn_delete_user',
												'type'          => 'button',
												'content'		=> '<i class="fa fa-eraser" aria-hidden="true"></i> Cancella',
												'data-username' => $val->username
										);
										echo form_button($attr);
									?>									
								</td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
					<?php else : ?>
					Nessuna data disponibile
					<?php endif ?>		
				</div>
			</div>  
		</div>
	</div>
</div>
			  
            
