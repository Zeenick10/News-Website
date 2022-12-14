<?php session_start(); ?>
<?php require_once 'front_panel/head.php'; ?>
<?php require_once 'front_panel/side_header.php'; ?>
<?php

    if(isset($_GET['id'])){
       $id = $_GET['id'];
       $current = post($id);
    }else{
        linkTo('index.php');
    }

    if(!$current){
        linkTo('index.php');
    }

    $currentCat = $current['category_id'];

    if(isset($_SESSION['user']['id'])){
        $user_id = $_SESSION['user']['id'];
    }else{
        $user_id = 0;
    }

    viewerRecord($user_id,$id,($_SERVER['HTTP_USER_AGENT']));

?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white mb-4">
                    <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Post Detail</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <h4>
                            <?php echo $current['title'] ?>
                        </h4>
                        <div class="my-3 ">
                            <i class="feather-user text-primary"></i>
                            <?php echo user($current['user_id'])['name'] ?>
                            <i class="feather-layers text-success px-2"></i>
                            <?php echo category($current['category_id'])['title'] ?>
                            <i class="feather-calendar text-danger px-2"></i>
                            <?php echo date('j-M-Y',strtotime($current['created_at'])) ?>
                        </div>
                        <div class="">
                            <?php echo html_entity_decode($current['description']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach(fPostByCat($currentCat,2,$id) as $p){ ?>
                    <div class="col-12 col-md-6">
                        <?php include "single.php"; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php include 'right_sidebar.php' ?>
    </div>
</div>

<?php require_once 'front_panel/footer.php'; ?>

