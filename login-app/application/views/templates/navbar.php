<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url();?>">Blog</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url();?>about">About<span class="sr-only">(current)</span></a></li>
        <li><a href="<?php echo base_url();?>posts">Posts</a></li>
        <li><a href="<?php echo base_url();?>categories">Categories</a></li>
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li> -->
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php if(!$this->session->userdata('logged_in')): ?>
          <li><a href="<?php echo base_url();?>users/login">Login</a></li>
          <li><a href="<?php echo base_url();?>users/register">Register</a></li>
         <?php endif; ?>
         <?php if($this->session->userdata('logged_in')): ?>
          <li><a href="<?php echo base_url();?>posts/create">Create Posts</a></li>
          <li><a href="<?php echo base_url();?>categories/create">Create Category</a></li>
          <li><a href="<?php echo base_url();?>users/logout">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container"> 
  <!-- flash messages -->
  <?php if($this->session->flashdata('user_registered')): ?>
      <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered') . '</p>' ?>
   <?php endif; ?>

   <?php if($this->session->flashdata('post_created')): ?>
      <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created') . '</p>' ?>
   <?php endif; ?>
   
   <?php if($this->session->flashdata('post_update')): ?>
      <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_update') . '</p>' ?>
   <?php endif; ?>
   
   <?php if($this->session->flashdata('category_created')): ?>
      <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_created') . '</p>' ?>
   <?php endif; ?>
   
   <?php if($this->session->flashdata('post_deleted')): ?>
      <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_deleted') . '</p>' ?>
   <?php endif; ?>

   <?php if($this->session->flashdata('login_failed')): ?>
      <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed') . '</p>' ?>
   <?php endif; ?>

   <?php if($this->session->flashdata('user_loggedin')): ?>
      <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin') . '</p>' ?>
   <?php endif; ?>

   <?php if($this->session->flashdata('user_loggedout')): ?>
      <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('user_loggedout') . '</p>' ?>
   <?php endif; ?>

