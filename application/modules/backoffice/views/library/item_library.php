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
								<!-- <button class="btn btn-sm btn-default"><i class="fas fa-store-alt"></i> <?= $nama_outlet; ?></button> -->
								<a href="" class="btn btn-sm btn-primary"><i class="fas fa-file-download"></i> Export</a>
								<a href="#modalForm" class="modal-with-form btn btn-sm btn-primary"><i class="fas fa-plus"></i> Create Item</a>
							</div>
						</div>
					</div>
				</header>
				<div class="card-body">
					<div class="alert alert-default m-0">
						<form action="<?= base_url() ?>backoffice/library/lists" method="post">
							<h5 class="mt-0"><i class="fas fa-filter"></i> Filter</h5>
							<div class="row">
								<div class="col-sm-4">
									<select name="id_kategori" id="id_kategori" class="form-control" style="width:100%">
										<option value="all" selected>All Categories</option>
										<?php foreach ($category as $c) : ?>
											<option value="<?= $c->id_kategori; ?>" <?php echo ($id_kategori == $c->id_kategori) ? "selected" : ""; ?>><?= $c->nama; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-sm-2">
									<button type="submit" name="filter" class="btn btn-primary" style="width:100%">Submit</button>
								</div>
							</div>
						</form>
					</div>

					<div class="row">
						<?php if (validation_errors()) : ?>
							<div class="col-sm-12">
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<?= validation_errors(); ?>
								</div>
							</div>
						<?php endif; ?>

						<div class="col-sm-12" style="margin-top:20px;">
							<?= $this->session->flashdata('message') ?>
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
									<?php foreach ($items as $row) { ?>
										<tr>
											<td><?= $row->nama; ?></td>
											<td><?= $row->kategori; ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td class="text-center"><a href="<?= base_url() ?>backoffice/library/editItem/<?= $row->id_item; ?>"> <i class="fas fa-pencil-alt text-dark"></i></a></td>
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
	<section class="card">
		<header class="card-header">
			<h2 class="card-title">Create Item</h2>
		</header>
		<div class="card-body">
			<form method="post" action="<?= base_url() ?>backoffice/library/additem">
				<div class="form-group">
					<label>Item Name</label>
					<input type="text" class="form-control" placeholder="Item Name" name="nama">
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
								<?= $this->Helper->setting("CURRENCY") ?>
							</span>
						</span>
						<input type="text" name="harga" class="form-control" placeholder="10000">
					</div>
				</div>
		</div>
		<footer class="card-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-default modal-dismiss">Cancel</button>
					<button type="submit" name="save" class="btn btn-primary">Add Item</button>
				</div>
			</div>
		</footer>
		</form>
	</section>
</div>

<!-- <script>
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
</script> -->