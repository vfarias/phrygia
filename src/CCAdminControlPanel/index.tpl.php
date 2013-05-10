<h1>Admin Control Panel Index</h1>
<p>One controller to manage the admin related stuff. This far it should list all users and all groups
and enable to add, modify, delete users and add, modify, delete groups.</p>

<h2>Users</h2>
<?php if($users != null):?>
  <?php foreach($users as $val):?>
   <p><strong> <?=esc($val['acronym'])?></strong>
   <br />
    Created on <?=$val['created']?>
    <br />
    Name:  <?=$val['name']?>
    </br>
    Email: <?=$val['email']?>
    </br>
    <a href='<?=create_url("acp/edituser/{$val['acronym']}")?>'>edit</a>
    <a href='<?=create_url("acp/dodelete/{$val['acronym']}")?>'>delete</a></p>
  <?php endforeach; ?>
<?php else:?>
  <p>No users exists.</p>
<?php endif;?>

<h2>Groups</h2>
<p class='smaller-text silent'><a href='<?=create_url("acp/creategroup/")?>'>Create group</a></p>
<?php if($groups != null):?>
  <?php foreach($groups as $val):?>
   <p> <strong><?=esc($val['acronym'])?></strong>
   <br />
    Created on <?=$val['created']?>
    <br />
    Name: <?=$val['name']?>
    </br>
    <a href='<?=create_url("acp/editgroup/{$val['acronym']}")?>'>edit</a>
    <a href='<?=create_url("acp/dodeletegroup/{$val['acronym']}")?>'>delete</a></p>
  <?php endforeach; ?>
<?php else:?>
  <p>No groups exists.</p>
<?php endif;?>
