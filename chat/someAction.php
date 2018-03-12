<?php
include_once 'libs/SomeDB.php';

$textM = $_POST['text'];

DataB::insert('chat_message', array(
    'text_m' => $textM
));
