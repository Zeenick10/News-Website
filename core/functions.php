<?php

    require_once 'core/base.php';

    //  common start

    function alert($data,$color='danger'){
        return "<p class='alert alert-$color'>$data</p>";
    }

    function fetch($sql){
        $query = mysqli_query(con(),$sql);
        $row = mysqli_fetch_assoc($query);
        return $row;
    }

    function fetchAll($sql){
        $query = mysqli_query(con(),$sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($query)){
            array_push($rows,$row);
        }
        return $rows;
    }



//    function redirect($l){
//        return header("location:$l");
//    }

    function linkTo($l){
        echo "<script>location.href='$l';</script>";
    }

    function runQuery($sql){
        $con = con();
        if(mysqli_query($con,$sql)){
            return true;
        }else{
            die('Errors : '.mysqli_error($con));
        }
    }

    function showTime($timeStamp,$format='d-m-Y'){
        return date($format,strtotime($timeStamp));
    }

    function countTotal($total,$category_id=1){
        $sql = "SELECT COUNT(id) FROM $total WHERE $category_id";
        $total = fetch($sql);
        return $total['COUNT(id)'];
    }

    function short($str,$length="30"){
        return substr($str,0,$length)."...";
    }

    function textFilter($text){
        $text = trim($text);                                  // remove whitespace
        $text = htmlentities($text,ENT_QUOTES);         // remove < > ' ""
        $text = stripcslashes($text);                        // remove / | \

        return $text;
    }

    // common end

    // user start

    function user($id){
        $sql = "SELECT * FROM users WHERE id=$id";
        return fetch($sql);
    }

    function users(){
        $sql = "SELECT * FROM users";
        return fetchAll($sql);
    }

    // user end

    //auth start

    function register(){
//        global $conn;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if($password == $cpassword){
            $sPass = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(name,email,password) VALUES ('$name','$email','$sPass')";
            if(runQuery($sql)){
                return linkTo('login.php');
            }

        }else{
            return alert('Passwords do not match!!!!');
        }
    }

    function login(){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email='$email'";
        $query = mysqli_query(con(),$sql);
        $row = mysqli_fetch_assoc($query);

        if(!$row){
            return alert('Email and password do not match!!!');
        }else{
            if(!password_verify($password,$row['password'])){
                return alert('Email and Password Do not match!!!');
            }else{
                session_start();
                $_SESSION['user'] = $row;
                linkTo('dashboard.php');
            }
        }

    }

    // auth end

    //category start

        function categoryAdd(){
            $title = textFilter(strip_tags($_POST['title']));
            $user_id = $_SESSION['user']['id'];

            $sql = "INSERT INTO category (title,user_id) VALUES ('$title','$user_id')";
//            $query = mysqli_query(con(),$sql);

            if(runQuery($sql)){
                linkTo('category_add.php');
            }
        }

        function category($id){
            $sql = "SELECT * FROM category WHERE id=$id";
            return fetch($sql);
        }

        function categories(){
            $sql = "SELECT * FROM category ORDER BY ordering DESC";
            return fetchAll($sql);
        }

        function categoryDelete($id){
            $sql = "DELETE FROM category WHERE id=$id";
            return runQuery($sql);
        }

        function categoryUpdate(){
            $id = $_POST['id'];
            $title = $_POST['title'];

            $sql = "UPDATE category SET title='$title' WHERE id=$id";
            return runQuery($sql);
        }

        function categoryPinToTop($id){
            $sql = "UPDATE category SET ordering ='0'";
            mysqli_query(con(),$sql);

            $sql = "UPDATE category SET ordering='1' WHERE id='$id'";
            return runQuery($sql);
        }

        function categoryRemovePin(){
            $sql = "UPDATE category SET ordering ='0'";
            return runQuery($sql);
        }

        function isCategory($id){
            if(category($id)){
                return $id;
            }else{
                die('Category is invalid');
            }
        }

    //category end

    // post start

    function postAdd(){
        $title = textFilter($_POST['title']);
        $description = textFilter($_POST['description']);
        $category_id = isCategory($_POST['category_id']);
        $user_id = $_SESSION['user']['id'];

        $sql = "INSERT INTO posts (title,description,category_id,user_id) VALUES ('$title','$description','$category_id','$user_id')";

        if(runQuery($sql)){
//            linkTo('post_add.php');
        }
    }

    function post($id){
        $sql = "SELECT * FROM posts WHERE id=$id";
        return fetch($sql);
    }

    function posts($limit=9999999){
        if($_SESSION['user']['role'] ==2){
            $current_user_id = $_SESSION['user']['id'];
            $sql = "SELECT * FROM posts WHERE user_id='$current_user_id' LIMIT $limit";
        }else{
            $sql = "SELECT * FROM posts LIMIT $limit";
        }
        return fetchAll($sql);
    }

    function postDelete($id){
        $sql = "DELETE FROM posts WHERE id=$id";
        return runQuery($sql);
    }

    function postUpdate(){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];

        $sql = "UPDATE posts SET title='$title',description='$description',category_id='$category_id' WHERE id=$id";
        return runQuery($sql);
    }

    // post end


    // front_panel start

    function fPosts($orderCol="id",$orderType ="DESC"){
        $sql = "SELECT * FROM posts ORDER BY $orderCol $orderType";
        return fetchAll($sql);
    }

    function fCategories(){
        $sql = "SELECT * FROM category ORDER BY ordering DESC";
        return fetchAll($sql);
    }

    function fPostByCat($category_id,$limit=9999,$post_id=0){
        $sql = "SELECT * FROM posts WHERE category_id='$category_id' AND id!='$post_id' ORDER BY id DESC LIMIT $limit";
        return fetchAll($sql);
    }

    function fSearch($searchKey){
        $sql = "SELECT * FROM posts WHERE title LIKE '%$searchKey%' OR description LIKE '%$searchKey%' ORDER BY id DESC";
        return fetchAll($sql);
    }

    function fSearchByDate($start,$end){
        $sql = "SELECT * FROM posts WHERE created_at BETWEEN '$start' AND '$end' ORDER BY id DESC";
        return fetchAll($sql);
    }

    // front_panel start

    // Viewer Count start
    function viewerRecord($userId,$postId,$device){
        $sql = "INSERT INTO viewers(user_id,post_id,device) VALUES ('$userId','$postId','$device')";
        runQuery($sql);
    }

    function viewerCountByPost($postId){
        $sql = "SELECT * FROM viewers WHERE post_id='$postId'";
        return fetchAll($sql);
    }

    function viewerCountByUser($userId){
        $sql = "SELECT * FROM viewers WHERE user_id ='$userId'";
        return fetchAll($sql);
    }

    // Viewer Count start

    // ads start

    function adsRecord(){
        $today = date('Y-m-d');
        $sql = "SELECT * FROM ads WHERE start <='$today' AND end > '$today'";
//        die($sql);
        return fetchAll($sql);
    }

    // ads end

    // payment start

    function payNow(){
        $from = $_SESSION['user']['id'];
        $to = $_POST['to_user'];
        $amount = $_POST['amount'];
        $description = $_POST['description'];

        // from User
        $fromUserDetail = user($from);
        $leftMoney = $fromUserDetail['money'] - $amount;
        if($fromUserDetail['money'] >= $amount){
            $sql = "UPDATE users SET money='$leftMoney' WHERE id='$from'";
            mysqli_query(con(),$sql);

            // to User
            $toUserDetail = user($to);
            $newAmount = $toUserDetail['money'] + $amount;
            $sql = "UPDATE users SET money='$newAmount' WHERE id='$to'";
            mysqli_query(con(),$sql);

            // add to transition datatable
            $sql = "INSERT INTO transition(from_user,to_user,amount,description) VALUES ('$from','$to','$amount','$description')";
            runQuery($sql);
        }

    }

    function transition($id){
        $sql = "SELECT * FROM transition WHERE id='$id'";
        return fetch($sql);
    }

    function transitions(){
        $user_id = $_SESSION['user']['id'];
        if($_SESSION['user']['role'] == 0 ){
            $sql = "SELECT * FROM transition";
        }else{
            $sql = "SELECT * FROM transition WHERE from_user='$user_id' OR to_user='$user_id'";
        }
        return fetchAll($sql);
    }

    // payment end

    // dashboard start


    function dashboardPosts($limit=9999999){
        if($_SESSION['user']['role'] ==2){
            $current_user_id = $_SESSION['user']['id'];
            $sql = "SELECT * FROM posts WHERE user_id='$current_user_id' ORDER BY id DESC LIMIT $limit";
        }else{
            $sql = "SELECT * FROM posts LIMIT $limit";
        }
        return fetchAll($sql);
    }

    // dashboard end

    // api start

    function apiOutput($arr){
        echo json_encode($arr);
    }

    // api end