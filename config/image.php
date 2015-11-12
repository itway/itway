<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',
    'post' => 'images/posts/',
    'quiz' => 'images/quizzes/',
    'user' => 'images/users/',
    'team' => 'images/teams/',
    'event' => 'imags/events/',
    'opensourceidea' => 'images/opensourceidea/',
    'chat' => 'images/chat/',
    'taskboard' => 'images/taskboard/',
    'missingUserPhoto' => 'default-user.png'

);
