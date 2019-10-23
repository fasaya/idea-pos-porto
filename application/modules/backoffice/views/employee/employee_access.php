<section role="main" class="content-body card-margin">
	<header class="page-header">
		<h2>Employee Access</h2>

		<div class="right-wrapper text-right">
			<ol class="breadcrumbs" style="margin-right:20px">
				<li>
					<!-- <a href="index.html"> -->
					<i class="fas fa-home"></i>
					<!-- </a> -->
				</li>
				<li><span>Employee</span></li>
				<li><span>Employee Access</span></li>
			</ol>
		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<h2 class="card-title">Employee Role</h2>
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
							<!-- <button type="button" class="mb-1 mt-1 mr-1 btn btn-sm btn-primary modal-with-form" data-toggle="modal" data-target="#modalForm"><i class=" fas fa-plus"></i> Create Employee Role</button> -->
							<a class="modal-with-form btn btn-sm btn-primary" href="#modalForm"><i class=" fas fa-plus"></i> Create Employee Role</a>

						</div>
						<div class="col-sm-12" style="margin-top:20px;">
							<table class="table table-responsive-md table-hover mb-0">
								<thead>
									<tr>
										<th>Role Name</th>
										<th>Employees Assigned</th>
										<th>Access</th>
										<th class="text-center"><i class="fas fa-pencil-alt"></i></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($role as $role) : ?>
										<tr>
											<td><?= $role->name ?></td>
											<td><?= $this->EmpAccess->count_assigned_employee($role->id_role) ?></td>
											<td><?= $this->EmpAccess->count_role_access($role->id_role) ?> Privileges</td>
											<td class="actions-hover actions-fade text-center"><a href="<?= base_url() ?>backoffice/employee/edit_access/<?= $role->id_role ?>"><i class="fas fa-pencil-alt"></i></a></td>
										</tr>
									<?php endforeach; ?>
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
			<h2 class="card-title">Create New Employee Role</h2>
		</header>
		<div class="card-body">
			<form action="<?= base_url() ?>backoffice/employee/add_role" method="post">
				<div class="form-group">
					<label>Role Name</label>
					<input type="text" class="form-control" placeholder="Role Name" name='add_role_name'>
				</div>
				<div class="form-row row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>App</label>
							<div class="checkbox">
								<label>
									<input type="checkbox" value="">
									Option one is this and that—be sure to include why it's great
								</label>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Backoffice</label>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="b_dashboard" value="1">
									Dashboard
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="b_reports" value="1">
									Reports
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="b_library" value="1">
									Library
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="b_inventory" value="1">
									Inventory
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="b_customer" value="1">
									Customer
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="b_employee" value="1">
									Employee
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="b_acc_setting" value="1">
									Account Setting
								</label>
							</div>
						</div>
					</div>
				</div>
		</div>
		<footer class="card-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-default modal-dismiss">Cancel</button>
					<button type="submit" class="btn btn-primary">Add Role</button>
				</div>
			</div>
		</footer>
		</form>
	</section>
</div>