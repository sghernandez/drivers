    <div class="login-box-body">
      <p class="login-box-msg">Please enter your email address. You will receive a link to reset your password via email.</p>
      <?php $this->load->view('gt_general/flash') // autocomplete="off" ?>
      <?= form_open('', ['autocomplete'=>'off']). get_token() ?>
        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>" />
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" name="send" value="1" class="btn btn-primary btn-block btn-flat btn-color">Get New Password</button>
          </div>
          <div class="text-center">
            <a href="<?= site_url('/') ?>" class="glyph-icon-back glyphicon glyphicon-circle-arrow-left" style="cursor:pointer" title="Back"></a>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="social-auth-links text-center">
      </div>
      <!-- /.social-auth-links -->
    </div>