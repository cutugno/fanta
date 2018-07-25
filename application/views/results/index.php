<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="page-header"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Risultati</h3>
			<!--
			<ol class="breadcrumb">
			  <li><i class="fa fa-lightbulb-o" aria-hidden="true"></i><a href="<?= site_url('admin/users') ?>"> Admin</a></li>
			  <li><i class="fa fa-table" aria-hidden="true"></i> Gestione risultati</li>
			</ol>
			-->
		</div>
	</div>	
	<div class="row">
		<div class="col-xs-12">
			<button type="button" class="btn btn-xs btn-info espandi"><i class="fa fa-expand" aria-hidden="true"></i> Espandi tutto</button>
			<button type="button" class="btn btn-xs btn-info contrai"><i class="fa fa-compress" aria-hidden="true"></i> Contrai tutto</button>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12" style="margin-top:10px">
			<?php if (!empty($giornate)) : ?>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="row">
					<?php foreach ($giornate as $key=>$giornata) : ?>
					<div class="col-xs-12" style="margin-bottom:15px">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading<?= $key ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key ?>" aria-expanded="true" aria-controls="collapse<?= $key ?>">
							  <div class="pull-right"><small><?= $giornata->msg ?></small></div>
							  <h4 class="panel-title">
								  Risultati <?= $giornata->descr ?>
							  </h4>					  
							</div>
							<div id="collapse<?= $key ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?= $key ?>">
							  <div class="panel-body">
								  <?php 
									$attr = array('id' => 'results_form['.$key.']','class' => 'results_form');
									echo form_open('#', $attr);			
								  ?>
								  <table class="table table-bordered table-condensed" id="matches_table">
									<colgroup>
										<col width="550" />
										<col width="100" />
										<col width="100" />
										<col width="100" />
									</colgroup>
									<thead>
										<tr>
											<th class="text-center">PARTITA</th>
											<th class="text-center">RISULTATO</th>
											<th class="text-center">PRONOSTICO</th>
											<th class="text-center">PUNTEGGIO</th>
										</tr>
									</thead>	
									<tbody>	
										  <?php $totale=0 ?>
										  <?php foreach ($giornata->risultati as $risultato) : ?>	
										  <?php $totale += $risultato->punteggio ?>
										  <tr>
											<td class="text-center"><?= $risultato->partita ?></td>
											<td class="text-center"><?= $risultato->risultato ?></td>
											<td class="text-center <?= $risultato->class ?>"><?= $risultato->pronostico ?></td>
											<td class="text-center"><?= $risultato->punteggio ?></td>
										  </tr>
										  <?php endforeach ?>
										  <tr>
											<td colspan="3" class="text-right" style="border-top:2px solid #000"><strong>TOTALE</strong></td>
											<td class="text-center" style="border-top:2px solid #000"><?= $totale ?></td>
										  </tr>
									</tbody>
								</table>
							  </div>
							</div>
						</div>
					</div>
					<?php endforeach ?>
				</div>
			</div>
			<?php else : ?>
			Nessun risultato disponibile
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
