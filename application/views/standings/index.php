<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="page-header"><i class="fa fa-bars" aria-hidden="true"></i> Classifica</h3>
			<!--
			<ol class="breadcrumb">
			  <li><i class="fa fa-lightbulb-o" aria-hidden="true"></i><a href="<?= site_url('admin/users') ?>"> Admin</a></li>
			  <li><i class="fa fa-table" aria-hidden="true"></i> Gestione risultati</li>
			</ol>
			-->
		</div>
	</div>	
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php if (!empty($standings)) : ?>
					<table class="table table-condensed table-bordered table-striped" id="standings_table">
						<colgroup>
							<col width="300" style="text-align:center" />
							<col width="100" style="text-align:center" />							
						</colgroup>
						<thead>
							<tr>
								<th>FANTAUTENTE</th>
								<th>PUNTI</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($standings as $key=>$val) : ?>
							<tr>
								<td><?= $key ?></td>
								<td><?= $val ?></td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
					<?php else : ?>
					Classifica non disponibile
					<?php endif ?>
				</div>
			</div>
		</div>	
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-body">
					<div id="chart_div"></div>
				</div>
			</div>
		</div>
	</div>
</div>
