<h3>Talents</h3>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Talent</th>
        <th>Rank</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($talents as $talent): ?>
        <tr id="talent_<?= $talent->id ?>">
            <td><span class="decrease glyphicon glyphicon-trash" aria-label="Delete" id="remove_talent_<?= $talent->id ?>"></span><?= $talent->talent->name ?></td>
            <td><?php if ($talent->talent->ranked): ?>
                    <span class="decrease glyphicon glyphicon-minus" aria-label="Decrease" id="decrease_talent_<?= $talent->id ?>"></span>
                    <?= $talent->rank ?>
                    <span class="increase glyphicon glyphicon-plus" aria-label="Increase" id="increase_talent_<?= $talent->id ?>"></span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="col-md-12 hidden-print">
    <form class="form-inline">
        <input type="hidden" id="new_talent_id"/>

        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">New Talent:</div>
                <input type="text" id="new_talent_autocomplete" placeholder="enter talent" class="form-control"/>
            </div>

        </div>
    </form>
</div>
