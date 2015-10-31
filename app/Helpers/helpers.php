<?php

function remove_empty($array) {

    $trimmedArray = array_map('trim',$array);

    return array_filter($trimmedArray);

}
