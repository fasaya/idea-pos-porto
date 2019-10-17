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
                <li><span>Edit Employee Access</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <form method="post" action="<?= base_url() ?>backoffice/employee/update_emp_access/<?= $id_role; ?>">
                    <header class="card-header">
                        <h2 class="card-title">Edit Employee Role</h2>
                    </header>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label text-sm-right pt-2">Role Name</label>
                            <div class="">
                                <input type="text" class="form-control" placeholder="Role Name" name="edit_role_name" value="<?= $ea['name']; ?>">
                                <?= form_error('edit_role_name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row">
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
                                            <input type="checkbox" name="b_dashboard" value="1" <?= $this->Help->numbertocheck($ea['b_dashboard']); ?>>
                                            Dashboard
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="b_reports" value="1" <?= $this->Help->numbertocheck($ea['b_reports']); ?>>
                                            Reports
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="b_library" value="1" <?= $this->Help->numbertocheck($ea['b_library']); ?>>
                                            Library
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="b_inventory" value="1" <?= $this->Help->numbertocheck($ea['b_inventory']); ?>>
                                            Inventory
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="b_customer" value="1" <?= $this->Help->numbertocheck($ea['b_customer']); ?>>
                                            Customer
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="b_employee" value="1" <?= $this->Help->numbertocheck($ea['b_employee']); ?>>
                                            Employee
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="b_acc_setting" value="1" <?= $this->Help->numbertocheck($ea['b_acc_setting']); ?>>
                                            Account Setting
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <div class="row pull-right">
                            <div class="col-sm-12">
                                <a href="<?= base_url() ?>backoffice/employee/access" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i> Back </a>
                                <a class="btn btn-danger btn-sm modal-basic" href="#modalDelete"><i class="fas fa-trash-alt"></i> Delete</a>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save </button>
                            </div>
                        </div>
                    </footer>
                </form>
            </section>
        </div>

        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <h2 class="card-title">Assigned Employee</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-striped mb-0" id="datatable-default">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Employee Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($emp as $e) :  ?>
                                <tr>
                                    <td class="center"><?php echo $no; ?></td>
                                    <td><?= $e->nama; ?></td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <!-- end: page -->
</section>

<!-- Modal Delete -->
<div id="modalDelete" class="modal-block mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Are you sure?</h2>
        </header>
        <div class="card-body">
            <div class="modal-wrapper">
                <div class="modal-text">
                    <p class="mb-0">Are you sure that you want to delete this role?</p>
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">

                    <a href="<?= base_url() ?>backoffice/employee/delete_emp_access/<?= $id_role; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete </a>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
</div>