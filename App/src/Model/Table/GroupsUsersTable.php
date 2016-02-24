<?php

namespace App\Model\Table;

class GroupsUsersTable extends AppTable {

    /**
     * @internal
     * @param array $config
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups');
        $this->belongsTo('Users');
    }

}
