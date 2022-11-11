<?php



    require_once "../core/base.php";

    require_once "../core/functions.php";

    $sql = "SELECT * FROM posts WHERE 1";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql .+" AND id=$id";
    }

    $row = fetchAll($sql);

    apiOutput($row);