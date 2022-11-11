<?php

    header("Content-Type: application/json; charset=UTF-8");

    require_once "core/base.php";
    require_once "core/functions.php";

    $sql = "SELECT * FROM posts WHERE 1";


    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql .=" AND id=$id";
    }

    if(isset($_GET['limit'])){
        $limit = $_GET['limit'];
        $sql .=" LIMIT $limit";
    }

    if(isset($_GET['offset'])){
        $offset = $_GET['offset'];
        $sql .=" OFFSET $offset";
    }



    $row = fetchAll($sql);

    apiOutput($row);
