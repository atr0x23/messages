<?php echo form_open(''); ?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1 class="text-center"><?php echo $title; ?></h1>


			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Enter Password" required autofocus>
			</div>

			<button type="submit" class="btn btn-primary btn-block">Submit</button>
		</div>


		<h4 class="text-center"><a href="users/password-reset">Forgot your password?</a></h4>
	</div>
<?php echo form_close(); ?>