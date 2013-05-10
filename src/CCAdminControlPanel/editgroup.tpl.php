<h1>Group Profile</h1>
<p>You can view and update information about this group.</p>

<?=$profile_form?>
<p>This group was created at <?=$group['created']?> and last updated at <?=$group['updated']?>.</p>
<p>There are <?=count($group['users'])?> member(s) in this group.</p>
<ul>
<?php foreach($group['users'] as $user): ?>
<li><?=$user['acronym']?>
<?php endforeach; ?>
</ul>
<?=$user_form?>
