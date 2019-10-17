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
    <thead class="row">
        <div class="col-lg-12">
            <section class="card">
                <form method="post" action="<?= base_url() ?>backoffice/employee/update_user/<?= $id_user; ?>/<?= $data_user['id_login']; ?>">
                    <header class="card-header">
                        <h2 class="card-title">Edit Employee Role</h2>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $this->session->flashdata('message') ?>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" placeholder="Full Name" name='nama' value="<?= $data_user['nama']; ?>">
                                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="Email" name='email' value="<?= $data_user['email']; ?>">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Left Icon</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone-alt"></i> +62
                                            </span>
                                        </span>
                                        <input type="text" name="no_hp" class="form-control" placeholder="812...." value="<?= $data_user['phone']; ?>">
                                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Employee Role</label>
                                    <select name="id_role" class="form-control">
                                        <?php foreach ($role as $r) : ?>
                                            <option value="<?= $r->id_role; ?>"><?= $r->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('id_role', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="check_pin" id="check_pin" value="1" <?= ($data_user['pin'] != '') ? "checked" : ""; ?> onclick="myFunction()">
                                                    Assign a PIN
                                                </label>
                                            </div>
                                            <p style="font-size:12px;">Go to PIN Access to allow employees access to certain parts of your Point of Sale using their 4-digit PIN</p>
                                        </div>
                                        <div class="col-sm-8" id="input-pin">
                                            <input type="password" id="pin" class="form-control" name='pin' value="<?= $data_user['pin']; ?>" placeholder="4-digit-PIN" style="width:200px;">
                                            <?= form_error('pin', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Textarea</label>
                                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Join date: 01 January 2019"><?= $data_user['deskripsi']; ?></textarea>
                                    <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <div class="row pull-right">
                            <div class="col-sm-12">
                                <a href="<?= base_url() ?>backoffice/employee/staff" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i> Back </a>
                                <a class="btn <?= $btn['type'] ?> btn-sm modal-basic" href="#modalDelete"><i class="<?= $btn['icon'] ?>"></i> <?= $btn['desc'] ?> </a>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save </button>
                            </div>
                        </div>
                    </footer>
                </form>
            </section>
        </div>

        <thead class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <h2 class="card-title">Assigned Outlets</h2>
                </header>
                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-12">
                            <?= $this->session->flashdata('message_outlet') ?>
                        </div>

                        <div class="col-sm-12">
                            <a class="modal-with-form btn btn-sm btn-primary" href="#modalAssign"><i class=" fas fa-plus"></i> Assign Employee</a>

                        </div>

                        <div class="col-sm-12" style="margin-top:20px;">
                            <table class="table table-bordered table-striped mb-0" id="datatable-default">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Outlets</th>
                                        <th class="text-center"><i class="fas fa-minus-circle"></i> Unassign</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($user as $u) :  ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td><?= $u->nama; ?></td>
                                            <td class="actions-hover actions-fade text-center"><a href="<?= base_url() ?>backoffice/employee/unassign/<?= $id_user; ?>/<?= $u->id_assignment; ?>"><i class="fas fa-minus-circle"></i></a></td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </thead>
    </thead>
    <!-- end: page -->
</section>

<!-- Modal Activate -->
<div id="modalDelete" class="modal-block mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Are you sure?</h2>
        </header>
        <div class="card-body">
            <div class="modal-wrapper">
                <div class="modal-text">
                    <p class="mb-0">Are you sure that you want to <?= $btn['desc'] ?>?</p>
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="<?= base_url() ?><?= $btn['link'] ?><?= $id_user; ?>" class="btn <?= $btn['type'] ?>"><i class="<?= $btn['icon'] ?>"></i> <?= $btn['desc'] ?> </a>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
</div>

<!-- Modal Assign Employee -->

<!-- Modal Form -->
<div id="modalAssign" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Assign Employee</h2>
        </header>
        <form method="post" action="<?= base_url() ?>backoffice/employee/assign_employee/<?= $id_user; ?>">
            <div class="card-body">
                <div class="form-group">
                    <label>Outlet</label>
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
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

<script>
    // document.getElementById("input-pin").style.display = "none";

    function myFunction() {
        var checkBox = document.getElementById("check_pin");
        var pin = document.getElementById("input-pin");
        if (checkBox.checked == true) {
            pin.style.display = "block";
        } else {
            pin.style.display = "none";
        }
    }
</script>