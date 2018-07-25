<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="page-header"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Admin</h3>
			<ol class="breadcrumb">
			  <li><i class="fa fa-lightbulb-o" aria-hidden="true"></i><a href="<?= site_url('admin/users') ?>"> Admin</a></li>
			  <li><i class="fa fa-calendar"></i> Gestione calendario</li>
			</ol>
		</div>
	</div>	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Gestione Calendario</h3>
		</div>	
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-6">
					<button class="btn btn-small btn-success" id="btn_addcalendar"><i class="fa fa-plus"></i> Aggiungi giornata</button>
				</div>
				<div class="col-sm-6 text-right">
					<small>
						<strong>Giornate: </strong>
						&nbsp;&nbsp;
						<span class="text-success">Giornata futura</span>
						&nbsp;&nbsp;	
						<span class="text-danger">Giornata terminata</span>
						&nbsp;&nbsp;
						<span class="text-warning">Giornata in corso</span>
						<br />
						<strong>Partite: </strong>
						&nbsp;&nbsp;
						<i class="fa fa-circle text-success" aria-hidden="true"></i> Partite inserite
						&nbsp;&nbsp;	
						<i class="fa fa-circle text-danger" aria-hidden="true"></i> Partite da inserire						
						&nbsp;&nbsp;	
						<i class="fa fa-circle" aria-hidden="true"></i> Giornata ancora da salvare						
					</small>
				</div>
			</div>
			<?php 
				$attr=array("class"=>"form-horizontal","id"=>"calendar_form");
				echo form_open("#",$attr);
			?>
			<div class="row">
				<div class="col-xs-12">
					<table class="table table-bordered table-condensed" style="margin-top:10px" id="calendar_table">
						<colgroup>
							<col width="180" />
							<col width="150" />
							<col width="150" />
							<col width="80" />
							<col width="150" />
						</colgroup>
						<thead>
							<tr>
								<th class="text-center filter-false">DESCRIZIONE</th>
								<th class="text-center sorter-false filter-false">INIZIO</th>
								<th class="text-center sorter-false filter-false">FINE</th>						
								<th class="text-center sorter-false filter-false">PARTITE</th>						
								<th class="filter-false sorter-false"></th>
							</tr>
						</thead>	
						<tbody>	
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<div class="col-xs-12">
							<?php
								$attr = array(
										'id'            => 'btn_create',
										'class'			=> 'btn btn-primary',
										'type'          => 'submit',
										'content'		=> '<i class="fa fa-floppy-o" aria-hidden="true"></i> Salva calendario'
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

<!-- modale partite giornata -->
<div class="modal fade" tabindex="-1" role="dialog" id="matches_modal">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<?php 
			$attr = array('id' => 'matches_form','data-update' => '');
			echo form_open('#', $attr);			
			echo form_hidden('id_giornata');
		?>
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Gestisci partite <span id="descr_giornata"></span></h4>
	  </div>
	  <div class="modal-body">	
		  <table class="table table-bordered table-condensed table-striped" id="matches_table">
				<colgroup>
					<col width="50" />
					<col width="650" />
				</colgroup>
				<thead>
					<tr>
						<th class="text-center sorter-false filter-false">PARTITA</th>
					</tr>
				</thead>	
				<tbody>	
					  <?php for ($x=0;$x<10;$x++) : ?>	
					  <?php $y=$x+1 ?>
					  <tr>
						<td>
							<div class="form-group">
								<?php 
									$attr = array(
										'name'				=> 'partita['.$x.'][partita]',
										'class'				=> 'form-control partita_input',
										'placeholder'		=> 'partita '.$y
									);
									echo form_input($attr,'','required regex="^([A-Za-z0-9_àéèìòù]+|\s)+\-(\s|[A-Za-z0-9_àéèìòù]+)+$"');		
									echo form_hidden('partita['.$x.'][id]','');		
								?>			
							  </div>
						</td>
					  </tr>
					  <?php endfor ?>
 				</tbody>
			</table>
	  </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
        <button type="submit" class="btn btn-primary" id="btn_save_matches">Salva</button>
      </div>
		<?php echo form_close() ?>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

		
<template id="tpl_btn_add_matches">
	<input type="hidden" name="giornata[%c%][id]" value="%id%">
	<button type="button" class="btn btn-small btn-info btn_add_matches" data-started="%started%" data-id_giornata="%id%" data-descr_giornata="%descr%"><i class="fa fa-list-alt" aria-hidden="true"></i> Gestisci partite</button>
</template>		
<template id="tpl_btn_delete_calendar">
	<button type="button" class="btn btn-small btn-danger btn_delete_calendar" data-id="%id%"><i class="fa fa-eraser" aria-hidden="true"></i> Cancella</button>	  
</template>
<template id="tpl_giornata">
<tr class="%giornata_class%">
	<td><input type="text" class="form-control tofocus" name="giornata[%c%][descr]" value="%descr%" required></td>
	<td><input type="text" class="form-control%picker%" %readonly% name="giornata[%c%][inizio]" value="%inizio%" required regex="^(3[01]|[12][0-9]|0?[1-9])\/(1[012]|0?[1-9])\/((?:19|20)\d{2})\s(2[0-3]|[01][0-9])\:([0-5][0-9])$"></td>
	<td><input type="text" class="form-control%picker%" %readonly% name="giornata[%c%][fine]" value="%fine%" required regex="^(3[01]|[12][0-9]|0?[1-9])\/(1[012]|0?[1-9])\/((?:19|20)\d{2})\s(2[0-3]|[01][0-9])\:([0-5][0-9])$"></td>
	<td class="text-center" style="vertical-align:middle"><i class="fa fa-circle %matches_class% fa-2x"></i></td>
	<td class="text-center">
		%buttons%		
	</td>
</tr>
</template>
<template id="tpl_no_calendar">
	<tr id="nocal">
		<td colspan="4">Nessuna giornata inserita</td>
	</tr>
</template>            
