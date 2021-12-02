<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<div class="row">
    <div class="col-lg-6">
        <?= $this->session->flashdata('message'); ?>
        <form action="<?= base_url('user/changepassword'); ?>" method="post">

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control" name="current_password" id="current_password">
                <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="new_password1">New Password</label>
                <input type="password" class="form-control" name="new_password1" id="new_password1">
                <?= form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="new_password2">New Password</label>
                <input type="password" class="form-control" name="new_password2" id="new_password2">
                <?= form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
        </form>
        </form>

    </div>
</div>