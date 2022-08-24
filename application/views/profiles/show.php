<h2><?= $title ?></h2>

<div class="mb-20"></div>
    <?php foreach($users as $user) : ?>
    

        <?php echo $user['id'] . $user['name'] . $user['email'] . $user['username'] . $user['created_at'] . "<br>"; ?>

 

    <?php endforeach; ?>