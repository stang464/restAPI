<?php

require_once('../connect.php');
require_once('../response.php');
require_once('function.php');

$response = new Response;
$_SERVER['REQUEST_METHOD'];
$crud = new CRUD;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $crud->read($_REQUEST);
}

if($_SERVER['REQUEST_METHOD'] === "PUT"){
    
    $crud->create($_REQUEST);
}

if($_SERVER['REQUEST_METHOD'] === "PATCH"){
    $crud->update($_REQUEST);
}

if($_SERVER['REQUEST_METHOD'] === "DELETE"){
    $crud->delete($_REQUEST);
}