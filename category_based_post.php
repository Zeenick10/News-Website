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
                        <?php echo category($_GET['category_id'])['title'] ?>
                    </li>
                </ol>
            </nav>
            <h4 class="mb-3">Posts</h4>
            <?php foreach(fPostByCat($_GET['category_id']) as $p){ ?>
                    <?php include "single.php"; ?>
<!--                <div class="card shadow-sm post mb-4">-->
<!--                    <div class="card-body">-->
<!--                        <a href="detail.php?id=--><?php //echo $p['id'] ?><!--">-->
<!--                            <h4>--><?php //echo $p['title']; ?><!--</h4>-->
<!--                        </a>-->
<!--                        <p>--><?php //echo short(strip_tags(html_entity_decode($p['description'])),200); ?><!--</p>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
            <?php } ?>
        </div>

        <?php include 'right_sidebar.php'?>

    </div>
</div>

<?php require_once 'front_panel/footer.php'; ?>

