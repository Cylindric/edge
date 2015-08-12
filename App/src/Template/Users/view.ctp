<?php $this->Html->addCrumb('Users', '/users'); ?>
<?php $this->Html->addCrumb($user->username); ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <table class="table table-condensed">
            <tr>
                <th>Username</th>
                <td><?= $user->username ?></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><?= $user->role ?></td>
            </tr>
        </table>

    </div>
</div>
