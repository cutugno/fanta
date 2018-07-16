<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!--main content start-->
   <section id="main-content">
      <section class="wrapper">
		  <div class="row">
           <div class="col-lg-12">
            <h3 class="page-header"><i class="icon_profile"></i> Gestione utenti</h3>
            <ol class="breadcrumb">
              <li><i class="icon_lightbulb"></i><a href="<?= site_url('admin/users') ?>">Admin</a></li>
              <li><i class="icon_profile"></i>Gestione utenti</li>              
            </ol>
          </div>
        </div>
        
         <div class="row">
          <div class="col-lg-12">
			  
			 <section class="panel">
              <header class="panel-heading">
               Elenco utenti
              </header>
              <div class="panel-body">
				  <?php if ($users) : ?>
				 <div class="table-responsive">
					<table class="table">
					  <thead>
						<tr>
						  <th></th>
						  <th>Username</th>
						  <th>Nome</th>
						  <th>Ultimo login</th>
						  <th></th>
						</tr>
					  </thead>
					  <tbody>
						  <?php foreach ($users as $user) : ?>
						<tr>
						  <td>avatar</td>
						  <td><?= $user->username ?></td>
						  <td><?= $user->nome ?></td>
						  <td><?= convertDateTime($user->last_login) ?></td>
						  <td>
							  <div class="btn-group">
								<a class="btn btn-info" href="<?= site_url('admin/users/edit/'.$user->username) ?>"><i class="icon_pencil"></i></a>
								<a class="btn btn-danger" href="<?= site_url('admin/users/delete/'.$user->username) ?>"><i class="icon_close_alt"></i></a>
							  </div>
						  </td>
						</tr>
						<?php endforeach ?>
					  </tbody>
					</table>
				  </div>
				  <?php else : ?>
				  Nessun utente presente
				  <?php endif ?>
              </div>
            </section>  
			  
            <section class="panel">
              <header class="panel-heading">
               Nuovo utente
              </header>
              <div class="panel-body">
                <form class="form-horizontal" method="get">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control">                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Conferma Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control">                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Avatar</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="focusedInput" type="text" value="This is focused...">
                    </div>
                  </div>
                  <div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-success" href="" title="Bootstrap 3 themes generator"><span class="icon_mic_alt"></span> Success</a>
					</div>
                  </div>
                  
                </form>
              </div>
            </section>
          </div>
       </div>        
	</section>
  </section>
