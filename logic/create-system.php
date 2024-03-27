<?php
require_once('../database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $name = $_POST['name'];
echo''.$name.'';

}else{
    echo 'else';
}
?>