<h1>User Profile</h1>
<p>You can view and update profile information.</p>

<?=$profile_form?>
<p>This user was created at <?=$user['created']?> and last updated at <?=$user['updated']?>.</p>
<p>This user is a member of <?=count($user['groups'])?> group(s).</p>
<ul>
<?php foreach($user['groups'] as $group): ?>
<li><?=$group['name']?>
<?php endforeach; ?>
</ul>
