<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


<div class="row">

    <div class="col-lg-6">
        <?= $this->session->flashdata('message'); ?>
        <table class="table table-hover">
            <h5>Role : <?= $role['role']; ?></h5>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Access</th>

                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($menu as $m) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $m['menu']; ?></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">

                            </div>
                        </td>

                    </tr>
                <?php $i++;
                endforeach; ?>
            </tbody>
        </table>


    </div>

</div>