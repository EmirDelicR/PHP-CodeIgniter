
<div class="card-container">
  <div class="card" id="card" align="center">
    <figure class="front">
      <h1 class="title"><?= $headers[0] ?></h1>
      <hr />
      <img id="profile-img" class="img-circle img-responsive img-login" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
           
      <?php echo form_open('users/login'); ?>
        <div class="main-center">
          <div class="form-group">
	          <div class="input-group">
		  	      <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
			        <input type="text" class="input-login" name="log-username"  placeholder="Enter your Username" />
			      </div>
            <span class="text-danger"><?php echo form_error('log-username'); ?></span>
          </div>
             
          <div class="form-group">
		       <div class="input-group">
		         <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
			       <input type="password" class="input-login" name="log-password" placeholder="Enter your Password"/>
           </div>
           <span class="text-danger"><?php echo form_error('log-password'); ?></span>
		      </div>
          <button type="submit" class="btn btn-primary btn-block btn-login">Login</button>
        </div>
      <?php echo form_close(); ?>
    </figure>

    <figure class="back">
      <h1 class="title"><?= $headers[1] ?></h1>
      <hr />
      <?php echo form_open('users/register'); ?>
        <div class="main-center">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
              <input type="text" class="input-login" name="name" value="<?php echo set_value('name'); ?>" placeholder="Enter your Name"  autofocus/>
            </div>
            <span class="text-danger"><?php echo form_error('name'); ?></span>
          </div>
          <div class="form-group">
		        <div class="input-group">
			        <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
			        <input type="text" class="input-login" name="email" value="<?php echo set_value('email'); ?>" placeholder="Enter your Email" autofocus/>
            </div>
            <span class="text-danger"><?php echo form_error('email'); ?></span>
		      </div>
          <div class="form-group">
			      <div class="input-group">
			        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
			        <input type="text" class="input-login" name="username" value="<?php echo set_value('username'); ?>"  placeholder="Enter your Username"/>
            </div>
            <span class="text-danger"><?php echo form_error('username'); ?></span>
		      </div>
		      <div class="form-group">
			      <div class="input-group">
			       <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
			       <input type="password" class="input-login" name="password"  value="<?php echo set_value('password'); ?>"  placeholder="Enter your Password"/>
            </div>
            <span class="text-danger"><?php echo form_error('password'); ?></span>
		      </div>
		      <div class="form-group">
			      <div class="input-group">
			       <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
			       <input type="password" class="input-login" name="confirm"  value="<?php echo set_value('confirm'); ?>" placeholder="Confirm your Password"/>
            </div>
            <span class="text-danger"><?php echo form_error('confirm'); ?></span>
		      </div>
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
      <?php echo form_close(); ?>
    </figure>
  </div>
</div>
<div align="center">
    <button class="btn-flip"  id="flip">Create an account</button>
</div> 
<!--Session message -->
<?php if($this->session->flashdata('user_registered')): ?>
   <?php echo '<div align="center"><p class="text-success login-flashdata">'.$this->session->flashdata('user_registered') . '</p></div> ' ?>
<?php endif; ?>
<?php if($this->session->flashdata('login_failed')): ?>
      <?php echo '<div align="center"><p class="text-danger login-flashdata">'.$this->session->flashdata('login_failed') . '</p></div>' ?>
<?php endif; ?>

<script>
  <?php
    echo 'var flip_val = ' . json_encode($flip) . ';';
  ?> 
  var card = document.getElementById('card'); 
  if(flip_val){
    card.classList.toggle('flipped');
    document.getElementById('flip').innerHTML = "Login";
  } 
  var init = function() {
    document.getElementById('flip').addEventListener( 'click', function(){
      card.classList.toggle('flipped');
      card.classList.contains("flipped") ? this.innerHTML = "Login" : this.innerHTML = "Create an account";
    });
  };
  window.addEventListener('DOMContentLoaded', init);
</script>


</div>
</body>
</html>