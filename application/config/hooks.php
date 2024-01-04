<?php
defined('BASEPATH') or exit('No direct script access allowed');


$hook['post_controller'] = array(
    'class'    => 'Checkrole',
    'function' => 'check',
    'filename' => 'Checkrole.php',
    'filepath' => 'hooks',
);
