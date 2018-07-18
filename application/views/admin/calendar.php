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
				<div class="col-xs-12 text-right">
					<button class="btn btn-small btn-success" id="btn_addcalendar">Aggiungi</button>
				</div>
			</div>
			<?php 
				$attr=array("class"=>"form-horizontal","id"=>"calendar_form");
				echo form_open("#",$attr);
			?>
			<div class="row">
				<div class="col-xs-12">
					<table class="table table-bordered table-condensed tablesorter" id="calendar_table">
						<colgroup>
							<col width="180" />
							<col width="150" />
							<col width="150" />
							<col width="150" />
						</colgroup>
						<thead>
							<tr>
								<th class="text-center">DESCRIZIONE</th>
								<th class="text-center sorter-false filter-false">INIZIO</th>
								<th class="text-center sorter-false filter-false">FINE</th>						
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
			  
<template id="tpl_giornata">
<tr>
	<td><input type="text" class="form-control" name="giornata[][descr]" value="%descr%"></td>
	<td><input type="text" class="form-control dyn_datetimepicker" name="giornata[][inizio]" value="%inizio%"></td>
	<td><input type="text" class="form-control dyn_datetimepicker" name="giornata[][fine]" value="%fine%"></td>
	<td class="text-center"><button type="button" class="btn btn-small btn-info btn_add_matches"> Aggiungi partite</button>
		<button type="button" class="btn btn-small btn-danger btn_delete_calendar"> Cancella</button>
	</td>
</tr>
</template>
<template id="tpl_no_calendar">
	<tr id="nocal">
		<td colspan="4">Nessuna giornata disponibile</td>
	</tr>
</template>            
