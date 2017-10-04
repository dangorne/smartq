<div class="container">

  <div class="row">

    <div class="col-md-6 col-md-offset-3">

      <div class="panel panel-default">

        <div class="panel-body">

          <?php echo form_open('signup') ?>

            <?php
                if(isset($_SESSION['USER_EXIST']) == 'TRUE'){
                  echo '<div class="alert alert-danger" role="alert"><strong>Username already exist.</strong></div>';
                }
                if(isset($_SESSION['PASS_NOT_MATCH']) == 'TRUE'){
                  echo '<div class="alert alert-danger" role="alert"><strong>Password does not match.</strong></div>';
                }
                if(isset($_SESSION['TERM_NOT_CHECK']) == 'TRUE'){
                  echo '<div class="alert alert-danger" role="alert"><strong>You must agree to the Terms and Policy.</strong></div>';
                }
                if(isset($_SESSION['ID_EXIST']) == 'TRUE'){
                  echo '<div class="alert alert-danger" role="alert"><strong>ID Number already exist.</strong></div>';
                }
            ?>

            <?php

             if(form_error('user') != ''){

               echo '<div class="form-group has-error">';
               echo '<label class="control-label" for="user">Username</label>';
               echo '<input type="text" name="user" id="user" class="form-control" value = "'.set_value('user').'" aria-describedby="help">';
               echo '<span id="help" class="help-block">'.form_error('user').'</span>';
               echo '</div>';
             }else{

               echo '<div class="form-group">';
               echo '<label class="control-label" for="user">Username</label>';
               echo '<input type="text" name="user" id="user" class="form-control" value = "'.set_value('user').'" aria-describedby="help">';
               echo '</div>';
             }
            ?>

            <?php

             if(form_error('pass') != ''){

               echo '<div class="form-group has-error">';
               echo '<label class="control-label" for="pass">Password</label>';
               echo '<input type="password" name="pass" id="pass" class="form-control" value = "'.set_value('pass').'" aria-describedby="help">';
               echo '<span id="help" class="help-block">'.form_error('pass').'</span>';
               echo '</div>';
             }else{

               echo '<div class="form-group">';
               echo '<label class="control-label" for="pass">Password</label>';
               echo '<input type="password" name="pass" id="pass" class="form-control" value = "'.set_value('pass').'" aria-describedby="help">';
               echo '</div>';
             }
            ?>

            <?php

             if(form_error('confirmpass') != ''){

               echo '<div class="form-group has-error">';
               echo '<label class="control-label" for="confirmpass">Confirm Password</label>';
               echo '<input type="password" name="confirmpass" id="confirmpass" class="form-control" value = "'.set_value('confirmpass').'" aria-describedby="help">';
               echo '<span id="help" class="help-block">'.form_error('confirmpass').'</span>';
               echo '</div>';
             }else{

               echo '<div class="form-group">';
               echo '<label class="control-label" for="confirmpass">Confirm Password</label>';
               echo '<input type="password" name="confirmpass" id="confirmpass" class="form-control" value = "'.set_value('confirmpass').'" aria-describedby="help">';
               echo '</div>';
             }
            ?>

            <?php

             if(form_error('idnum') != ''){

               echo '<div class="form-group has-error">';
               echo '<label class="control-label" for="idnum">ID Number</label>';
               echo '<input type="text" name="idnum" id="idnum" class="form-control" value = "'.set_value('idnum').'" aria-describedby="help">';
               echo '<span id="help" class="help-block">'.form_error('idnum').'</span>';
               echo '</div>';
             }else{

               echo '<div class="form-group">';
               echo '<label class="control-label" for="idnum">ID Number</label>';
               echo '<input type="text" name="idnum" id="idnum" class="form-control" value = "'.set_value('idnum').'" aria-describedby="help">';
               echo '</div>';
             }
            ?>

            <?php

             if(form_error('phonenum') != ''){

               echo '<div class="form-group has-error">';
               echo '<label class="control-label" for="phonenum">Phone Number</label>';
               echo '<div class="input-group">';
               echo '<span class="input-group-addon">+63</span><input type="text" name="phonenum" id="phonenum" class="form-control" value = "'.set_value('phonenum').'" aria-describedby="help">';
               echo '</div>';
               echo '<span id="help" class="help-block">'.form_error('phonenum').'</span>';
               echo '</div>';
             }else{

               echo '<div class="form-group">';
               echo '<label class="control-label" for="phonenum">Phone Number</label>';
               echo '<div class="input-group">';
               echo '<span class="input-group-addon">+63</span><input type="text" name="phonenum" id="phonenum" class="form-control" value = "'.set_value('phonenum').'" aria-describedby="help">';
               echo '</div>';
               echo '</div>';
             }
            ?>

            <label class="control-label" for="college">College</label>
            <select class="form-control" name="college">
              <option value="CAS"  selected = "selected" <?php echo  set_select('college', 'CAS') ?> >CAS</option>
              <option value="CASNR" <?php echo  set_select('college', 'CASNR') ?> >CASNR</option>
              <option value="CED" <?php echo  set_select('college', 'CED') ?> >CED</option>
              <option value="CEIT" <?php echo  set_select('college', 'CEIT') ?> >CEIT</option>
            </select>

          </br>

            <div class="checkbox form-group">
              <label><input type="checkbox" name="term" value="accept" <?php echo set_checkbox('term', 'accept'); ?>>I agree to the Terms of Use and Privacy Policy</label>
            </div>

          </br>

           <button type="submit" class="btn btn-info">Sign Up</button>
           <?php echo form_close() ?>

        </div>

      </div>

    </div>

  </div>

</div>
