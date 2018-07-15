<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


	<div class="container">

    <?php
    $attr = array('class'=>'login-form','id'=>'form_login');
    echo form_open('#',$attr);
    ?>
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <?php
          $data = array(
					'name'          => 'username',
					'class'			=> 'form-control',
					'placeholder'	=> 'Username',
					'value'			=> set_value('username'),
					'autofocus'		=> true
		  );
		  echo form_input($data)
		  ?>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <?php
		  $data = array(
					'name'          => 'password',
					'class'			=> 'form-control',
					'placeholder'	=> 'Password'
		  );
		  echo form_password($data)
		  ?>          
        </div>
        <!--
        <label class="checkbox">
			<input type="checkbox" value="remember-me"> Remember me
			<span class="pull-right"> <a href="#"> Forgot Password?</a></span>
		</label>
		-->
		<?php
		$data = array(						
				'id'			=> 'btn_login',
				'type'			=> 'submit',
				'class'			=> 'btn btn-primary btn-lg btn-block',
				'content'		=> 'LOGIN'
		);
		
		echo form_button($data);
		?>
       <!-- <button class="btn btn-info btn-lg btn-block" type="submit">Signup</button> -->
      </div>
    <?= form_close() ?>
    
  </div>

