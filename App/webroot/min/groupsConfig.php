<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/**
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 *
 * See https://github.com/mrclay/minify/blob/master/docs/CustomServer.wiki.md for other ideas
 **/

return array(
    'rpgApp' => array(
        '//js/rpgApp.js', 
        '//js/services/talent_service.js', 
        '//js/controllers/character_controller.js'
    ),
//    'testJs' => array('//minify/min/quick-test.js'),
//    'testCss' => array('//minify/min/quick-test.css'),
//    'js' => array('//js/file1.js', '//js/file2.js'),
//    'css' => array('//css/file1.css', '//css/file2.css'),
);
