<?php
use Cake\Core\Configure;

$config['HybridAuth'] = [
    'providers' => [
        // google
        "Google" => array( // 'id' is your google client id
            "enabled" => true,
               "keys" => array("id" => "675487890303-lelujba9q7maukuqcqloddhuc9cmnp1k.apps.googleusercontent.com", "secret" => "AcCQzSr_bDGQN8aslKm3PZaG"),
                "scope" => "profile email",
                //"access_type" => "offline",
                "approval_prompt" => "force",
            ),
     ],
    'debug_mode' => Configure::read('debug'),
    'debug_file' => LOGS . 'hybridauth.log',
];

