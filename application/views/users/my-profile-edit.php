<?php echo validation_errors(); ?>

<?php echo form_open('users/update'); ?>
	<div class="row">
    <?php foreach($user as $trela) : ?>
		<div class="col-md-4 col-md-offset-4">
			<h1 class="text-center"><?= $title; ?></h1>
            <input type="hidden" name="id" value="<?php echo $trela['id']; ?>">
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" value="<?php echo $trela['name']; ?>" placeholder="Name">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="email" value="<?php echo $trela['email']; ?>" placeholder="Email" required autofocus>
			</div>
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="username" value="<?php echo $trela['username']; ?>" placeholder="Username" required autofocus>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required autofocus>
			</div>
			<div class="form-group">
				<label>Confirm Password</label>
				<input type="password" class="form-control" name="password2" placeholder="Confirm Password" required autofocus>
			</div>
			<button type="submit" class="btn btn-primary btn-block">Submit</button>
		</div>
	</div>
    <?php endforeach; ?>
<?php echo form_close(); ?>