<?php require_once 'front_panel/head.php'; ?>
<?php require_once 'front_panel/side_header.php'; ?>
<title>Home</title>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white mb-4">
                    <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Search by "<?php echo $_POST['start'] ?> and "<?php echo $_POST['start'] ?>"
                    </li>
                </ol>
            </nav>
            <h4 class="mb-3">Posts</h4>

            <?php
//            $result = fSearch($_POST['search_key']);
            $result = fSearchByDate($_POST['start'],$_POST['end']);
            if(count($result)==0){
                echo alert('There is no result','warning');
            }
            ?>
            <?php foreach($result as $p){ ?>
                <?php include 'single.php'?>
            <?php } ?>
        </div>

        <?php include 'right_sidebar.php'?>

    </div>
</div>

<?php require_once 'front_panel/footer.php'; ?>

