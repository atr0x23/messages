<h2><?= $title ?></h2>
<?php $current_user_id = $this->session->userdata('user_id');
echo $current_user_id; ?>
<div class="mb-20"></div>
    <?php foreach($messages as $message) : ?>
    

    <div id="accordion">
        <div class="card">
            <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#collapseOne"><?php echo $message['title']; ?></a>
            <span class="ml-10"><small>created at: <?php echo $message['created_at'];?></small></span> 
        </div>
        
        <div id="collapseOne" class="collapse" data-parent="#accordion">
            <div class="card-body">
            <?php echo $message['content']; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>