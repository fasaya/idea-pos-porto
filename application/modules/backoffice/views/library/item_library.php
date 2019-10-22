<section role="main" class="content-body card-margin">
	<header class="page-header">
		<h2>Library</h2>

		<div class="right-wrapper text-right">
			<ol class="breadcrumbs" style="margin-right:20px">
				<li>
					<!-- <a href="index.html"> -->
					<i class="fas fa-home"></i>
					<!-- </a> -->
				</li>
				<li><span>Library</span></li>
				<li><span>Item Library</span></li>
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
							<h2 class="card-title">Item Library</h2>
						</div>
						<div class="col-sm-6">
							<div class="pull-right">
								<a href="" class="btn btn-sm btn-primary"><i class="fas fa-file-download"></i> Export</a>
								<a href="#modalForm" class="modal-with-form btn btn-sm btn-primary"><i class="fas fa-plus"></i> Create Item</a>
							</div>
						</div>
					</div>
				</header>
				<div class="card-body">
					<div class="row">
						<?php if (validation_errors()) : ?>
							<div class="col-sm-12">
								<div class="alert alert-danger alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<?= validation_errors(); ?>
								</div>
							</div>
						<?php endif; ?>

						<div class="col-sm-12">
							<?= $this->session->flashdata('message') ?>
						</div>

						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
									<select data-plugin-selectTwo id="id_outlet" class="form-control populate">
										<!-- <optgroup label="Alaskan/Hawaiian Time Zone"> -->
										<?php foreach ($outlet as $o) : ?>
											<option value="<?= $o->id_outlet; ?>"><?= $o->nama; ?></option>
										<?php endforeach; ?>
										<!-- </optgroup> -->
									</select>
								</div>
								<div class="col-sm-4">
									<select id="id_kategori" class="form-control">
										<option value="all" selected>All Categories</option>
										<?php foreach ($category as $c) : ?>
											<option value="<?= $c->id_kategori; ?>"><?= $c->nama; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-sm-4">
									<select id="alert" class="form-control">
										<option value="all">All Inventory</option>
										<option value="low">Low Stock Alert</option>
										<option value="out">Out of Stock Alert</option>
									</select>
								</div>
							</div>
						</div>

						<div class="col-sm-12" style="margin-top:20px;">
							<table class="table table-bordered table-striped mb-0" id="datatable-default">
								<thead>
									<tr>
										<th>Name</th>
										<th>Category</th>
										<th>Pricing</th>
										<th>In Stock</th>
										<th>Stock Alert</th>
										<th class="text-center"><i class="fas fa-pencil-alt"></i></th>
									</tr>
								</thead>
								<tbody id="items">

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
	<section class="card">
		<header class="card-header">
			<h2 class="card-title">Create Item</h2>
		</header>
		<div class="card-body">
			<form method="post" action="<?= base_url() ?>backoffice/library/additem">
				<div class="form-group">
					<label>Item Name</label>
					<input type="text" class="form-control" placeholder="Item Name" name='nama'>
				</div>
				<div class="form-group">
					<label>Category</label>
					<select name="kategori" class="form-control">
						<?php foreach ($category as $c) : ?>
							<option value="<?= $c->id_kategori; ?>"><?= $c->nama; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Pricing (You can add variant later)</label>
					<div class="input-group">
						<span class="input-group-prepend">
							<span class="input-group-text">
								Rp
							</span>
						</span>
						<input type="text" name="harga" class="form-control" placeholder="10000">
					</div>
				</div>
				<div class="form-group">
					<label>Assign Outlet (you can select more Outlets when the employee is verified)</label><br>
					<select name="id_outlet" class="form-control">
						<?php foreach ($outlet as $o) : ?>
							<option value="<?= $o->id_outlet; ?>"><?= $o->nama; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Select Modifier</label>
					<select class="form-control" multiple="multiple" data-plugin-multiselect data-plugin-options='{ "maxHeight": 200 }' id="modifier">
						<option value="cheese">Cheese</option>
						<option value="tomatoes" selected>Tomatoes</option>
						<option value="mozarella" selected>Mozzarella</option>
						<option value="mushrooms">Mushrooms</option>
						<option value="pepperoni">Pepperoni</option>
						<option value="onions">Onions</option>
					</select>
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea name="deskripsi" class="form-control" rows="3" placeholder="Item description"></textarea>
				</div>
		</div>
		<footer class="card-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-default modal-dismiss">Cancel</button>
					<button type="submit" name="saveall" class="btn btn-primary">Save to All Outlets</button>
					<button type="submit" name="save" class="btn btn-primary">Save</button>
				</div>
			</div>
		</footer>
		</form>
	</section>
</div>

<script>
	$(document).ready(function() {

		$(document).ready(function() {
			var id_outlet = $('#id_outlet').val();
			var id_kategori = $('#id_kategori').val();
			var alert = $('#alert').val();

			if (id_outlet != '' || id_kategori != '' || alert != '') {
				$.ajax({
					url: "<?= base_url(); ?>backoffice/library/fetch_item",
					method: "POST",
					data: {
						id_outlet: id_outlet,
						id_kategori: id_kategori,
						alert: alert
					},
					success: function(data) {
						$('#items').html(data);
					}
				})
			}
		});

		$("#id_outlet, #id_kategori, #alert").change(function() {
			var id_outlet = $('#id_outlet').val();
			var id_kategori = $('#id_kategori').val();
			var alert = $('#alert').val();

			if (id_outlet != '' || id_kategori != '' || alert != '') {
				$.ajax({
					url: "<?= base_url(); ?>backoffice/library/fetch_item",
					method: "POST",
					data: {
						id_outlet: id_outlet,
						id_kategori: id_kategori,
						alert: alert
					},
					success: function(data) {
						$('#items').html(data);
					}
				})
			}
		});

	});
</script>