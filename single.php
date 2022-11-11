<div class="card shadow-sm post mb-4">
    <div class="card-body">
        <a href="detail.php?id=<?php echo $p['id'] ?>">
            <h4><?php echo short($p['title'],50); ?></h4>
        </a>
        <div class="my-3 ">
            <i class="feather-user text-primary"></i>
            <?php echo user($p['user_id'])['name'] ?>
            <i class="feather-layers text-success px-2"></i>
            <?php echo category($p['category_id'])['title'] ?>
            <i class="feather-calendar text-danger px-2"></i>
            <?php echo date('j-M-Y',strtotime($p['created_at'])) ?>
        </div>
        <p><?php echo short(strip_tags(html_entity_decode($p['description'])),200); ?></p>
    </div>
</div>