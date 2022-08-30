<p><h2>You can now type your new password.</h2></p>

<?php echo form_open('reset/password?hash=' . $hash); ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <div class="form-group">
            <label>Current Password</label>
            <input type="password" class="form-control" name="currentPassword" placeholder="Password" required autofocus>
            </div>

            <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required autofocus>
            </div>

            <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required autofocus>
            </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
        
    </div>
<?php echo form_close(); ?>