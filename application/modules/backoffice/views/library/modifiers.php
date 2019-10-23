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
							</div>
						</div>

						<div class="col-sm-12" style="margin-top:20px;">
							<table class="table table-bordered table-striped mb-0" id="datatable-default">
								<thead>
									<tr>
										<th>Modifier Set Name</th>
										<th>Options</th>
										<th class="text-center"><i class="fas fa-pencil-alt"></i></th>
									</tr>
								</thead>
								<tbody id="modifier">

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
				<div class="form-group">
					<label class="">Modifier Options</label>

					<section class="form-group-vertical">
						<button type="button" id="add_fields" class="btn btn-info btn-sm btn-block last">Add Option</button>
						<div class="input-group" id="field_option">
							<input type="text" name="array_nama[]" class="form-control input-group-prepend" placeholder="Name" style="width: 40%">
							<input type="text" name="array_harga[]" class="form-control input-group-prepend" placeholder="Rp 0" style="width: 20%">
							<!-- <a href="javascript:void(0);" class="btn btn-default form-control input-group-prepend"><i class="fas fa-trash"></i></a> -->
						</div>
					</section>
				</div>
				<div class="form-group">
					<label>Outlet</label><br>
					<select name="id_outlet" class="form-control">
						<?php foreach ($outlet as $o) : ?>
							<option value="<?= $o->id_outlet; ?>"><?= $o->nama; ?></option>
						<?php endforeach; ?>
					</select>
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
		</section>
	</form>
</div>

<script>
	$(document).ready(function() {

		// add options
		var wrapper = $("#field_option"); //Input fields wrapper
		var add_button = $("#add_fields"); //Add button class or ID
		var x = 1; //Initial input field is set to 1

		//When user click on add input button
		$(add_button).click(function(e) {
			e.preventDefault();
			//Check maximum allowed input fields

			$(wrapper).append('<div class="input-group" id="field_option"><input type="text" name="array_nama[]" class="form-control input-group-prepend" placeholder="Name" style="width: 40%"><input type="text" name="array_harga[]" class="form-control input-group-prepend" placeholder="Rp 0" style="width: 20%"><a href="javascript:void(0);" class="btn btn-default form-control input-group-prepend remove_field"><i class="fas fa-minus-circle"></i></a></div>');

		});

		//when user click on remove button
		$(wrapper).on("click", ".remove_field", function(e) {
			e.preventDefault();
			$(this).parent('div').remove(); //remove inout field
			x--; //input field decrement
		})


		// show data based on id_outlet

		$(document).ready(function() {
			var id_outlet = $('#id_outlet').val();

			if (id_outlet != '') {
				$.ajax({
					url: "<?= base_url(); ?>backoffice/library/fetch_modifiers",
					method: "POST",
					data: {
						id_outlet: id_outlet
					},
					success: function(data) {
						$('#modifier').html(data);
					}
				})
			}
		});

		$("#id_outlet").change(function() {
			var id_outlet = $('#id_outlet').val();

			if (id_outlet != '') {
				$.ajax({
					url: "<?= base_url(); ?>backoffice/library/fetch_modifiers",
					method: "POST",
					data: {
						id_outlet: id_outlet
					},
					success: function(data) {
						$('#modifier').html(data);
					}
				})
			}
		});

	});
</script>