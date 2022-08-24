<h2 class="mt-2"><?= $title ?></h2>

<?php echo validation_errors(); ?>

<!-- form -->
<?php echo form_open('messages/create'); ?> 

  <div class="form-group mt-5">
    <input type="text" class="form-control" name="title" placeholder="title">
  </div>

  <div class="form-group">
    <textarea class="form-control" rows="5" name="content" placeholder="type your message..."></textarea>
  </div>

  <button type="submit" class="btn btn-primary mb-2">Send</button>

</form>