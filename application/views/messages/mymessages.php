<h2><?= $title ?></h2>

    <?php foreach($messages as $message) : ?>
    

    <div id="accordion">
        <div class="card">
            <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#<?php echo $message['slug'];?>"><?php echo $message['title']; ?></a>
            <span class="ml-10"><small>created at: <?php echo $message['created_at'];?></small></span> 
        </div>
        
        <div id="<?php echo $message['slug'];?>" class="collapse" data-parent="#accordion">
            <div class="card-body">
            <?php echo $message['content']; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>