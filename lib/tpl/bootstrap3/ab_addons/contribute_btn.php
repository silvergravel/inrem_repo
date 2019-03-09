

<div style="<?php if(isset($INFO['userinfo'])){ echo "display:block";} else {echo "display:none";} ?>" >
<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">+ Contribute Stories</button>
<ul class="dropdown-menu dropdown-menu-right">
  <li><a href="<?php echo DOKU_BASE."doku.php?id=".$lang_namespace.":contr_forms:stories_form" ?>">about people</a></li>
  <li><a href="<?php echo DOKU_BASE."doku.php?id=".$lang_namespace.":contr_forms:stories_form" ?>">about a place</a></li>
  <li><a href="<?php echo DOKU_BASE."doku.php?id=".$lang_namespace.":contr_forms:stories_form" ?>">about an activity</a></li>
  <li><a href="<?php echo DOKU_BASE."doku.php?id=".$lang_namespace.":contr_forms:stories_form" ?>">about something else</a></li>
</ul>
</div>
