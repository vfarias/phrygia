<h1>Login</h1>
<p>Login using your acronym or email.</p>
<?=$login_form->GetHTML('form')?>
  <fieldset>
    <?=$login_form['acronym']->GetHTML()?>
    <?=$login_form['password']->GetHTML()?> 
    <?=$login_form['login']->GetHTML()?>
    <?php if($allow_create_user) : ?>
      <p class='form-action-link'><a href='<?=$create_user_url?>' title='Create a new user account'>Create user</a></p>
    <?php endif; ?>
  </fieldset>
</form>
<!--
<ul>
  <li><a href='<?=create_url('user/login/doe/doe')?>'>Login as doe:doe (should work)</a>
  <li><a href='<?=create_url('user/login/root/root')?>'>Login as root:root (should work)</a>
  <li><a href='<?=create_url('user/login/root@dbwebb.se/root')?>'>Login as root@dbwebb.se:root (should work)</a>
  <li><a href='<?=create_url('user/login/admin/root')?>'>Login as admin:root (should fail, wrong akronym)</a>
  <li><a href='<?=create_url('user/login/root/admin')?>'>Login as admin:root (should fail, wrong password)</a>
  <li><a href='<?=create_url('user/login/admin@dbwebb.se/root')?>'>Login as admin@dbwebb.se:root (should fail, wrong email)</a>
</ul>
-->
