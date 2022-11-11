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
    <div class="row">
        <div class="col-12 col-xl-8">
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

                    <?php
                    $id = $_GET['id'];
                    $current = post($id);

                    if(isset($_POST['postUpdate'])){
                        if(postUpdate()){
                            linkTo('post_list.php');
                        };
                    }
                    ?>

                    <form action="#" method="post">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <label for="">Post Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $current['title'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="">Select Post</label>
                            <select name="category_id" id="" class="custom-select">
                                <?php foreach(categories() as $c){ ?>
                                    <option value="<?php echo $c['id'] ?>" <?php echo $c['id']==$current['category_id']?"selected":"" ?>><?php echo $c['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo $current['description'] ?></textarea>
                        </div>

                        <hr>
                        <button class="btn btn-primary" name="postUpdate">Post Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include "template/footer.php"; ?>