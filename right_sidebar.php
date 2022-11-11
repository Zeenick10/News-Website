
<div class="col-12 col-md-4">
    <div class="front-panel-right-sidebar">
        <div class="card">
            <div class="card-body">
                <?php if(isset($_SESSION['user']['id'])){ ?>
                    <p>Hi <b><?php echo $_SESSION['user']['name'] ?></b></p>
                    <a href="dashboard.php" class="btn btn-outline-primary">Go Dashboard</a>
                <?php }else{ ?>
                    <p>Hi <b><?php echo "Guest" ?></b></p>
                    <a href="register.php" class="btn btn-outline-primary">Go Register</a>
                <?php } ?>
            </div>
        </div>
        <h4 class="mb-3">Category List</h4>
        <div class="list-group">
            <a href="<?php echo $url; ?>/index.php" class="list-group-item list-group-item-action <?php echo isset($_GET['category_id'])?'':'active'; ?>">All categories</a>
            <?php foreach (fCategories() as $c){ ?>
                <a href="category_based_post.php?category_id=<?php echo $c['id']; ?>"
                   class="list-group-item list-group-item-action <?php echo isset($_GET['category_id'])? ($_GET['category_id']==$c['id']?'active':''):''; ?>">
                    <?php echo $c['title']; ?>
                    <?php if($c['ordering']==1){ ?>
                        <i class="float-right feather-paperclip fa-fw text-primary"></i>
                    <?php } ?>
                </a>
            <?php } ?>
        </div>
<!--        <div class="mb-3">-->
<!--            <h4 class="mt-3">Advertisement</h4>-->
<!--            <img src="https://thumbs.dreamstime.com/b/advertising-word-cloud-business-concept-56936998.jpg" class="rounded w-100 my-3" alt="">-->
<!--        </div>-->
        <div class="">
            <h4>Search Date</h4>
            <div class="card mb-4 border">
                <div class="card-body">
                    <form action="<?php echo $url ?>/search_date.php" method="post">
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" name="start" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" name="end" class="form-control">
                        </div>
                        <button class="btn btn-outline-primary">
                            <i class="feather-calendar">Search</i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>