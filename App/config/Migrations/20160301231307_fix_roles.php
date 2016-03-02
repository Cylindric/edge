<?php

use Phinx\Migration\AbstractMigration;
use Cake\Datasource\ConnectionManager;

class FixRoles extends AbstractMigration {

    public function change() {
        $conn = ConnectionManager::get('default');
        $conn->query("UPDATE users SET role = 'user' WHERE role = 'author'");
    }

}
