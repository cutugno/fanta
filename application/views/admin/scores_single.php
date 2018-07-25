<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="page-header"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Admin</h3>
			<ol class="breadcrumb">
			  <li><i class="fa fa-lightbulb-o" aria-hidden="true"></i><a href="<?= site_url('admin/users') ?>"> Admin</a></li>
			  <li><i class="fa fa-check-circle-o" aria-hidden="true"></i><a href="<?= site_url('admin/scores') ?>"> Gestione punteggi</a></li>
			  <li><i class="fa fa-search" aria-hidden="true"></i> Punteggi <?= $giornata->descr ?></li>
			</ol>
		</div>
	</div>	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Punteggi <?= $giornata->descr ?></h3>
		</div>	
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12 text-right">
					<small>
						<strong>Punteggi: </strong>
						&nbsp;&nbsp;
						<span class="text-success">Punteggio azzeccato (5 punti)</span>
						&nbsp;&nbsp;
						<span class="text-info">Risultato azzeccato (3 punti)</span>
						&nbsp;&nbsp;	
						<span class="text-danger">Risultato sbagliato (0 punti)</span>										
					</small>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php if (!empty($scores)) :?>
					<table class="table table-bordered table-condensed" style="margin-top:10px" id="calendar_table">
						<colgroup>
							<col width="180" />
							<col width="150" />
							<?php foreach (array_keys(reset($scores)) as $user) : ?>
							<col width="100" />
							<?php endforeach ?>
						</colgroup>
						<thead>
							<tr>
								<th class="text-center">PARTITA</th>
								<th class="text-center" style="border-right:2px solid #000">RISULTATO</th>
								<?php foreach (array_keys(reset($scores)) as $user) : ?>
								<th class="text-center"><?= strtoupper($user) ?></th>
								<?php endforeach ?>										
							</tr>
						</thead>	
						<tbody>	
							<?php foreach ($scores as $key=>$score) : ?>
							<tr>
								<td class="text-center"><?= reset($score)[0]->partita ?></td>
								<td class="text-center" style="border-right:2px solid #000"><?= reset($score)[0]->risultato ?></td>
								<?php foreach (array_keys($score) as $user) : ?>
								<td class="text-center <?= $score[$user][0]->class ?>">
									<?= $score[$user][0]->pronostico ?>
								</td>
								<?php endforeach ?>
							</tr>
							<?php endforeach ?>
							<tr>
								<td class="border-top:2px solid #000"></td>
								<td class="text-right" style="border-right:2px solid #000;border-top:2px solid #000"><strong>PUNTEGGIO</strong></td>
								<?php foreach (array_keys($score) as $user) : ?>
								<td class="text-center" style="border-top:2px solid #000">
								<?php 
									$punteggio=0;
									foreach ($scores as $score) {
										$punteggio+=$score[$user][0]->punteggio;
									}
									echo $punteggio;
								?>
								</td>
								<?php endforeach ?>
							</tr>
						</tbody>
					</table>
					<?php else : ?>
					Nessun punteggio disponibile
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
