<section role="main" class="content-body card-margin">
    <header class="page-header">
        <h2>Outlets</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs" style="margin-right:20px">
                <li>
                    <!-- <a href="index.html"> -->
                    <i class="fas fa-home"></i>
                    <!-- </a> -->
                </li>
                <li><span>Setting</span></li>
                <li><span>Outlets</span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <form method="post" action="<?= base_url() ?>backoffice/outlets/update/<?= $id_outlet ?>">
                    <header class="card-header">
                        <h2 class="card-title">Edit Outlet Info</h2>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $this->session->flashdata('message') ?>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Outlet Name</label>
                                    <input type="text" class="form-control" placeholder="Outlet Name" name='nama_outlet' value="<?= $outlet['nama'] ?>">
                                    <?= form_error('nama_outlet', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone-alt"></i> +62
                                            </span>
                                        </span>
                                        <input type="text" name="phone" class="form-control" placeholder="812...." value="<?= $outlet['phone'] ?>">
                                        <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Address" name="address" value="<?= $outlet['address'] ?>">
                                    <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Province</label>
                                    <select name="provinsi" id="provinsi" class="form-control">
                                        <option value="">--- SELECT PROVINCE ---</option>
                                        <?php foreach ($provinsi as $p) :
                                            ?>
                                            <option value="<?= $p->id; ?>" <?php $this->Outlet->slctdOpt($p->id, $outlet['provinsi']) ?>><?= $p->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('provinsi', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>City / Kabupaten</label>
                                    <select name="kota" id="kota" class="form-control">
                                        <option value="">SELECT PROVINCE FIRST</option>
                                    </select>
                                    <?= form_error('kota', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select name="kecamatan" id="kecamatan" class="form-control">
                                        <option value="">SELECT CITY/KABUPATEN FIRST</option>
                                    </select>
                                    <?= form_error('kecamatan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="text" class="form-control" placeholder="Postal Code" name='postal' value="<?= $outlet['postal'] ?>">
                                    <?= form_error('postal', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <div class="row pull-right">
                            <div class="col-sm-12">
                                <a href="<?= base_url() ?>backoffice/outlets" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i> Back </a>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save </button>
                            </div>
                        </div>
                    </footer>
                </form>
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
                    <p class="mb-0">Are you sure that you want to delete this?</p>
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="" class="btn btn-default"><i class=""></i> Button </a>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
</div>