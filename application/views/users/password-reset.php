        <h2><?php echo $title; ?></h2>
            <p>An email will be send to you with instructions on how to reset your passwrod.</p>

            <?php echo form_open('users/password_reset'); ?>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">

                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Enter you email" required autofocus>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Send the reset link</button>

                    </div>

                    
                </div>
            <?php echo form_close(); ?>