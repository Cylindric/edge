<?php
$editing = $this->request->params['action'] == 'edit';
?>
<div class="row">

    <?php echo $this->element('status_block_1', [
        "name" => "soak",
        "editing" => $editing,
        "title" => "Soak",
        "value" => $character->totalSoak,
        "class" => 'cursor-help',
    ]);
    $this->Html->scriptBlock("
    $('#soak_0_value').popover
        (
        {
            html: true,
            trigger: 'hover',
            title: 'Soak',
            content: function()
            {
                return $.ajax({url: '/characters/get_soak/" . $character->id . "',
                     dataType: 'html',
                     async: false}).responseText;
            }
        }
    );
    $(document).on('click', 'i[id=soak_0_decrease]', function () {rpgApp.changeAttribute(" . $character->id . ", 'soak', -1, 'soak_0_value');});
    $(document).on('click', 'i[id=soak_0_increase]', function () {rpgApp.changeAttribute(" . $character->id . ", 'soak',  1, 'soak_0_value');});
    ", ['block' => true]);
    ?>

    <?php echo $this->element('status_block_2', [
        "name" => "strain",
        "editing" => $editing,
        "title" => "Strain",
        "subtitles" => ['Threshold', 'Current'],
        "values" => [$character->total_strain_threshold, $character->strain],
        "class" => ['cursor-help', ''],
    ]);
    $this->Html->scriptBlock("
         $('#strain_0_value').popover
            (
            {
                html: true,
                trigger: 'hover',
                title: 'Strain Threshold',
                content: function()
                {
                    return $.ajax({url: '/characters/get_strain_threshold/" . $character->id . "',
                         dataType: 'html',
                         async: false}).responseText;
                }
            }
        );
        $(document).on('click', 'i[id=strain_0_decrease]', function () {rpgApp.changeAttribute(" . $character->id . ", 'strain_threshold', -1, 'strain_0_value');});
        $(document).on('click', 'i[id=strain_0_increase]', function () {rpgApp.changeAttribute(" . $character->id . ", 'strain_threshold',  1, 'strain_0_value');});
        $(document).on('click', 'i[id=strain_1_decrease]', function () {rpgApp.changeAttribute(" . $character->id . ", 'strain', -1, 'strain_1_value');});
        $(document).on('click', 'i[id=strain_1_increase]', function () {rpgApp.changeAttribute(" . $character->id . ", 'strain',  1, 'strain_1_value');});
    ", ['block' => true]);
    ?>

    <?php echo $this->element('status_block_2', [
        "name" => "wounds",
        "editing" => $editing,
        "title" => "Wounds",
        "subtitles" => ['Threshold', 'Current'],
        "values" => [$character->wound_threshold, $character->wounds],
    ]);
    $this->Html->scriptBlock("
        $(document).on('click', 'i[id=wounds_0_decrease]', function () {rpgApp.changeAttribute(" . $character->id . ", 'wound_threshold', -1, 'wounds_0_value');});
        $(document).on('click', 'i[id=wounds_0_increase]', function () {rpgApp.changeAttribute(" . $character->id . ", 'wound_threshold',  1, 'wounds_0_value');});
        $(document).on('click', 'i[id=wounds_1_decrease]', function () {rpgApp.changeAttribute(" . $character->id . ", 'wounds', -1, 'wounds_1_value');});
        $(document).on('click', 'i[id=wounds_1_increase]', function () {rpgApp.changeAttribute(" . $character->id . ", 'wounds',  1, 'wounds_1_value');});
    ", ['block' => true]);
    ?>

    <?php echo $this->element('status_block_2', [
        "name" => "defence",
        "editing" => $editing,
        "title" => "Defence",
        "subtitles" => ['Melee', 'Ranged'],
        "values" => [$character->totalDefence['melee'], $character->totalDefence['ranged']],
    ]); ?>

</div>
