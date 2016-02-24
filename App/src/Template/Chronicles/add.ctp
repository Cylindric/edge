<?php
$this->Html->addCrumb('Chronicles', ['action' => 'index']);
?>

<div class="row">
    <div class="col-md-12">

        <form method="post" action="/chronicles/add/<?= $chronicle->group_id; ?>">
            <input type="hidden" name="group_id" value="<?= $chronicle->group_id; ?>" />
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" name="title" placeholder="Title" value="<?= $chronicle->title;?>">
            </div>
 
            <div class="form-group">
                <label for="story">Story</label>
                <textarea class="form-control" rows="10" name="story"><<?= $chronicle->story; ?>/textarea>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>

    </div>
</div>
