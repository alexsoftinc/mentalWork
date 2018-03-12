<?php
include_once  'libs/SomeDB.php';

$db = DataB::run();

$id = $_POST['id'];

$query = $db->prepare("SELECT * FROM chat_message WHERE id > :id");

$query->execute(array(
    ':id' => $id
));

if($query->rowCount() > 0)
{
    $result = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($result as $item):
        echo '<li id="'. $item->id .'">' . $item->text_m . '</li>';
    endforeach;
}
else
{
    echo 1;
}
