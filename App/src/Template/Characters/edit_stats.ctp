<div class="row">
	<div id="stat_brawn"    ><?php echo $this->element('stat_block', ["name" => "br",  "value" => $character->stat_br,   "label" => "BRAWN"]); ?></div>
	<div id="stat_agility"  ><?php echo $this->element('stat_block', ["name" => "ag" , "value" => $character->stat_ag,   "label" => "AGILITY"]); ?></div>
	<div id="stat_intellect"><?php echo $this->element('stat_block', ["name" => "int", "value" => $character->stat_int,  "label" => "INTELLECT"]); ?></div>
	<div id="stat_cunning"  ><?php echo $this->element('stat_block', ["name" => "cun", "value" => $character->stat_cun,  "label" => "CUNNING"]); ?></div>
	<div id="stat_willpower"><?php echo $this->element('stat_block', ["name" => "will","value" => $character->stat_will, "label" => "WILLPOWER"]); ?></div>
	<div id="stat_presence" ><?php echo $this->element('stat_block', ["name" => "pr",  "value" => $character->stat_pr,   "label" => "PRESENCE"]); ?></div>
</div>
