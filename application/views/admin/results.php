<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="page-header"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Admin</h3>
			<ol class="breadcrumb">
			  <li><i class="fa fa-lightbulb-o" aria-hidden="true"></i><a href="<?= site_url('admin/users') ?>"> Admin</a></li>
			  <li><i class="fa fa-table" aria-hidden="true"></i> Gestione risultati</li>
			</ol>
		</div>
	</div>	
	<div class="row">
		<div class="col-sm-6">
			<button type="button" class="btn btn-xs btn-info espandi"><i class="fa fa-expand" aria-hidden="true"></i> Espandi tutto</button>
			<button type="button" class="btn btn-xs btn-info contrai"><i class="fa fa-compress" aria-hidden="true"></i> Contrai tutto</button>
		</div>
		<div class="col-sm-6 text-right">
			<small>
				<strong>Legenda: </strong>
				&nbsp;&nbsp;
				<i class="fa fa-circle text-success" aria-hidden="true"></i> Giornata futura
				&nbsp;&nbsp;	
				<i class="fa fa-circle text-warning" aria-hidden="true"></i> Giornata terminata
				&nbsp;&nbsp;
				<i class="fa fa-circle text-muted" aria-hidden="true"></i> Giornata senza partite
			</small>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12" style="margin-top:10px">
			<?php if (!empty($giornate)) : ?>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?php foreach ($giornate as $key=>$giornata) : ?>
				<div class="panel <?= $giornata->panel_class ?>">
					<div class="panel-heading" role="tab" id="heading<?= $key ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key ?>" aria-expanded="true" aria-controls="collapse<?= $key ?>">
					  <div class="pull-right"><small><?= $giornata->msg ?></small></div>
					  <h4 class="panel-title">
						  Risultati <?= $giornata->descr ?> <?php if (isset($giornata->warning)) : ?> <i class="fa fa-exclamation-triangle text-danger tooltipped" data-placement="right" title="Inserire i risultati !" aria-hidden="true"></i> <?php endif ?>
					  </h4>					  
					</div>
					<?php if ($giornata->collapsable) :?>
					<div id="collapse<?= $key ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?= $key ?>">
					  <div class="panel-body">
						  <?php 
							$attr = array('id' => 'results_form['.$key.']','class' => 'results_form');
							echo form_open('#', $attr);			
						  ?>
						  <table class="table table-bordered table-condensed tablesorter" id="matches_table">
							<colgroup>
								<col width="650" />
								<col width="30" />
							</colgroup>
							<thead>
								<tr>
									<th class="text-center sorter-false filter-false">PARTITA</th>
									<th class="text-center sorter-false filter-false">RISULTATO</th>
								</tr>
							</thead>	
							<tbody>	
								  <?php foreach ($giornata->partite as $partita) : ?>	
								  <tr>
									<td><?= $partita->partita ?></td>
									<td>
										<?php 
											$attr = array(
												'name'				=> 'risultato['.$partita->id.']',
												'class'				=> 'form-control input_result',
												'value'				=> $partita->risultato
											);
											echo form_input($attr,'','required regex="^\d+\-\d+$"'.$giornata->editable);		
										?>		
									</td>
								  </tr>
								  <?php endforeach ?>
							</tbody>
						</table>
						<?php
							$attr = array(
									'id'            => 'btn_create',
									'class'			=> 'btn btn-primary',
									'type'          => 'submit',
									'content'		=> '<i class="fa fa-floppy-o" aria-hidden="true"></i> Salva risultati'
							);
							if ($giornata->editable !=" disabled") echo form_button($attr);
							echo form_close();
						?>
					  </div>
					</div>
					<?php endif ?>
				</div>
				<?php endforeach ?>
			</div>
			<?php else : ?>
			Nessuna giornata inserita
			<?php endif ?>						
		</div> <!-- /col-xs-12 -->
	</div>
	<div class="row">
		<div class="col-sm-6">
			<button type="button" class="btn btn-xs btn-info espandi"><i class="fa fa-expand" aria-hidden="true"></i> Espandi tutto</button>
			<button type="button" class="btn btn-xs btn-info contrai"><i class="fa fa-compress" aria-hidden="true"></i> Contrai tutto</button>
		</div>
	</div>
</div>
