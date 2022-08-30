<!DOCTYPE html>
	<head>
		<title>tryTodo</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <script src="http://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
     <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


	</head>
	<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">tryTodo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">

      <?php if($this->session->userdata('logged_in')) : ?>
          <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url(); ?>users/my-profile-edit">Profile<span class="visually-hidden">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>messages/create">New message</a>
          </li>
          <?php if($this->session->userdata('user_id') == 14) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>users">Users</a>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>messages/mymessages">Message-History</a>
          </li>
        <?php endif; ?>
      </ul>

      <!-- navbar right side -->
        <ul class="navbar-nav ml-auto">

          <?php if(!$this->session->userdata('logged_in')) : ?>
              <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>">Login</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a></li>
            <?php endif; ?>
            <?php if($this->session->userdata('logged_in')) : ?>
              <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>
  </div>
</nav>

    <div class="container">
      <!-- Flash messages -->
      
      <!-- notifications for user -->
      <?php if($this->session->flashdata('user_registered')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('user_loggedin')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
      <?php endif; ?>

       <?php if($this->session->flashdata('user_loggedout')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('user_updated')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_updated').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('user_updated_byadmin')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_updated_byadmin').'</p>'; ?>
      <?php endif; ?>

      <!-- Login notifications & Forgot Password-->
      <?php if($this->session->flashdata('login_failed')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('forgot_password_invalid_email')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('forgot_password_invalid_email').'</p>'; ?>
      <?php endif; ?>

      <!-- email for password reset -->
      <?php if($this->session->flashdata('succes_sending_email')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('succes_sending_email').'</p>'; ?>
      <?php endif; ?>

      <?php if($this->session->flashdata('sending_error_email')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('sending_error_email').'</p>'; ?>
      <?php endif; ?>

      <!-- notifications for messages -->
      <?php if($this->session->flashdata('message_submited')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('message_submited').'</p>'; ?>
      <?php endif; ?>