<?php include "core/auth.php"; ?>
<?php include "core/base.php"; ?>

<?php include "template/header.php"; ?>

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/post_add.php">Post</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Post</li>
            </ol>
        </nav>
    </div>
</div>

<?php
if(isset($_POST['addPost'])){
    postAdd();
}
?>

<form class="row" method="post">
    <div class="col-12 col-xl-9">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="feather-plus-circle text-primary"></i> Add Post
                    </h4>
                    <a href="<?php echo $url; ?>/post_list.php" class="btn btn-outline-primary">
                        <i class="feather-list"></i>
                    </a>
                </div>
                <hr>


                    <div class="form-group">
                        <label for="">Post Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>



                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control flex-nowrap"></textarea>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <?php foreach (categories() as $c) { ?>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio<?php echo $c['id'] ?>" value="<?php echo $c['id'] ?>" name="category_id" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio<?php echo $c['id'] ?>"><?php echo $c['title'] ?></label>
                        </div>
                    <?php } ?>
<!--                    <label for="">Select Post</label>-->
<!--                    <select name="category_id" id="" class="custom-select">-->
<!--                        --><?php //foreach(categories() as $c){ ?>
<!--                            <option value="--><?php //echo $c['id'] ?><!--">--><?php //echo $c['title'] ?><!--</option>-->
<!--                        --><?php //} ?>
<!--                    </select>-->
                </div>
                <button class="btn btn-primary" name="addPost">Add Post</button>
            </div>
        </div>
    </div>
</form>

<?php include "template/footer.php"; ?>
<script>
    $("#description").summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 1,
        height: 100
    });
</script>
