<section role="main" class="content-body card-margin">
	<header class="page-header">
		<h2>Modifiers</h2>

		<div class="right-wrapper text-right">
			<ol class="breadcrumbs" style="margin-right:20px">
				<li>
					<!-- <a href="index.html"> -->
					<i class="fas fa-home"></i>
					<!-- </a> -->
				</li>
				<li><span>Library</span></li>
				<li><span>Modifiers</span></li>
			</ol>
		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="row">
						<div class="col-sm-6">
							<h2 class="card-title">Modifier</h2>
						</div>
						<div class="col-sm-6">
							<div class="pull-right">
								<a href="#modalForm" class="modal-with-form btn btn-sm btn-primary"><i class="fas fa-plus"></i> Create Modifier</a>
							</div>
						</div>
					</div>
				</header>
				<div class="card-body">
					<div class="row">
						<?php if (validation_errors()) : ?>
							<div class="col-sm-12">
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<?= validation_errors(); ?>
								</div>
							</div>
						<?php endif; ?>

						<div class="col-sm-12">
							<?= $this->session->flashdata('message') ?>
							<table class="table table-bordered table-striped mb-0" id="datatable-default">
								<thead>
									<tr>
										<th>Modifier Set Name</th>
										<th>Options</th>
										<th>Assigned Outlet</th>
										<th class="text-center"><i class="fas fa-pencil-alt"></i></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($modifiers as $r) { ?>
										<tr>
											<td><?= $r->nama ?></td>
											<td><?= $this->Library->mod_options_byID($r->id_mod); ?></td>
											<td><?= $this->Library->mod_outlet_byID($r->id_mod); ?></td>
											<td class="text-center"><a href="<?= base_url() ?>backoffice/library/editmodifier/<?= $r->id_mod ?>"><i class="fas fa-pencil-alt text-dark"></i></a></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<!-- end: page -->
</section>

<!-- Modal Form -->
<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
	<form method="post" action="<?= base_url() ?>backoffice/library/addmodifier">
		<section class="card">
			<header class="card-header">
				<h2 class="card-title">Create Modifier</h2>
			</header>
			<div class="card-body">
				<div class="form-group">
					<label>Modifier Name</label>
					<input type="text" class="form-control" placeholder="Modifier Name" name='nama'>
				</div>
			</div>
			<footer class="card-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button type="submit" name="save" class="btn btn-primary">Add</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>
			</footer>
		</section>
	</form>
</div>