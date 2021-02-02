<?php
require_once '../vendor/autoload.php';

if ($_POST['action'] == 'edit') {
    Cars::editCar($_POST['car_id'], $_POST['car_name']);
}
if ($_POST['action'] == 'delete') {
    Cars::deleteCar($_POST['car_id']);
}
