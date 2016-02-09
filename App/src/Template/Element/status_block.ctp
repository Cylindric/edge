<?php
$editing = $this->request->params['action'] == 'edit';
?>
<div class="row">

    <?php echo $this->element('status_block_1', [
        "name" => "soak",
        "editing" => $editing,
        "title" => "Soak",
        "value" => $character->total_soak,
        "class" => 'cursor-help',
        "popover" => 'soak_breakdown',
    ]);
    ?>

    <?php echo $this->element('status_block_2', [
        "names" => ["strain_threshold", "strain"],
        "editing" => $editing,
        "title" => "Strain",
        "subtitles" => ['Threshold', 'Current'],
        "values" => [$character->total_strain_threshold, $character->strain],
        "class" => ['cursor-help', ''],
        "popover" => 'strain_threshold_breakdown',
    ]);
    ?>

    <?php echo $this->element('status_block_2', [
        "names" => ["wound_threshold", "wounds"],
        "editing" => $editing,
        "title" => "Wounds",
        "subtitles" => ['Threshold', 'Current'],
        "values" => [$character->total_wound_threshold, $character->wounds],
        "class" => ['cursor-help', ''],
        "popover" => 'wound_threshold_breakdown',
    ]);
    ?>

    <?php echo $this->element('status_block_2', [
        "names" => ["defence_melee", "defence_ranged"],
        "editing" => $editing,
        "title" => "Defence",
        "subtitles" => ['Melee', 'Ranged'],
        "values" => [$character->total_defence['melee'], $character->total_defence['ranged']],
    ]);
    ?>

</div>
