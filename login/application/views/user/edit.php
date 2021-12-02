<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<div class="row">

    <div class="col-lg-8">
        <?= form_open_multipart('user/edit'); ?>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="email" name="email" value="<?= $user['email']; ?> " readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Full name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" value="<?= $user['name']; ?> " id="name" name="name">
                <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">Picture</div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="<?= base_url('assets/img/profiles/') . $user['image']; ?>" class="img-thumbnail">
                    </div>
                    <div class="col-sm-9">

                        <div class="form-group">
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="form-group row justify-content-end">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </div>
        </form>
    </div>
</div>