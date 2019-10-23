<section role="main" class="content-body card-margin">
    <header class="page-header">
        <h2>Staff</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs" style="margin-right:20px">
                <li>
                    <!-- <a href="index.html"> -->
                    <i class="fas fa-home"></i>
                    <!-- </a> -->
                </li>
                <li><span>Employee</span></li>
                <li><span>Employee Slots</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <h2 class="card-title">Employee Slots</h2>
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
                            <a class="modal-with-form btn btn-sm btn-primary" href="#modalForm"><i class=" fas fa-plus"></i> Invite Employee</a>

                            <div class="btn-group flex-wrap pull-right">
                                <button type="button" class="mb-1 mt-1 mr-1 btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown"><?= $opt; ?> <span class="caret"></span></button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item text-1" href="<?= base_url() ?>backoffice/employee/staff/active">Active Employees</a>
                                    <a class="dropdown-item text-1" href="<?= base_url() ?>backoffice/employee/staff/inactive">Inactive Employees</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12" style="margin-top:20px;">
                            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Role</th>
                                        <th>Assigned Outlet</th>
                                        <th>Employee Status</th>
                                        <th class="text-center"><i class="fas fa-pencil-alt"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($user as $u) :  ?>
                                        <tr>
                                            <td><?= $u->nama ?></td>
                                            <td><?= $u->name ?></td>
                                            <td><?php $this->EmpSlot->get_assignedOutlet($u->id_user); ?></td>
                                            <!-- <td>Free</td> -->
                                            <td><?= ($u->is_verified == '1') ? 'Verified' : 'Not verified'; ?></td>
                                            <td class="actions-hover actions-fade text-center"><a href="<?= base_url() ?>backoffice/employee/edit_slot/<?= $u->id_user ?>"><i class="fas fa-pencil-alt"></i></a></td>
                                        </tr>
                                        <?php $no++; ?>
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
            <h2 class="card-title">Invite Employee</h2>
        </header>
        <div class="card-body">
            <form method="post" action="<?= base_url() ?>backoffice/employee/add_user">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" placeholder="Full Name" name='nama'>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Email" name='email'>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-phone-alt"></i> +62
                            </span>
                        </span>
                        <input type="text" name="no_hp" class="form-control" placeholder="812....">
                    </div>
                </div>
                <div class="form-group">
                    <label>Employee Role</label>
                    <select name="id_role" class="form-control">
                        <?php foreach ($role as $r) : ?>
                            <option value="<?= $r->id_role; ?>"><?= $r->name; ?></option>
                        <?php endforeach; ?>
                    </select>
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
                    <label>Textarea</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Join date: 01 January 2019"></textarea>
                </div>
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                    <button type="submit" class="btn btn-primary">Invite</button>
                </div>
            </div>
        </footer>
        </form>
    </section>
</div>