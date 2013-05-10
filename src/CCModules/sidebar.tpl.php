<div class='box'>
<h4>All modules</h4>
<p>All Phrygia modules.</p>
<ul>
<?php foreach($modules as $module): ?>
  <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li> 
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Phrygia core</h4>
<p>Phrygia core modules.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isPhrygiaCore']): ?>
  <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li> 
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Phrygia CMF</h4>
<p>Phrygia Content Management Framework (CMF) modules.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isPhrygiaCMF']): ?>
  <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li> 
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Models</h4>
<p>A class is considered a model if its name starts with CM.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isModel']): ?>
  <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li> 
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Controllers</h4>
<p>Implements interface <code>IController</code>.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isController']): ?>
  <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li> 
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>

<div class='box'>
<h4>Manageable module</h4>
<p>Implements interface <code>IModule</code>.</p>
<ul>
<?php foreach($modules as $module): ?>
<?php if($module['isManageable']): ?>
<li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li> 
<?php endif; ?>
<?php endforeach; ?>
</ul>
</div>

<div class='box'>
<h4>Contains SQL</h4>
<p>Implements interface <code>IHasSQL</code>.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['hasSQL']): ?>
  <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li> 
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>More modules</h4>
<p>Modules that does not implement any specific Phrygia interface.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if(!($module['isController'] || $module['isPhrygiaCore'] || $module['isPhrygiaCMF'])): ?>
  <li><a href='<?=create_url("module/view/{$module['name']}")?>'><?=$module['name']?></a></li> 
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>
