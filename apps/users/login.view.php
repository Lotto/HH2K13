<?php
require_once(WEBSITE_PATH."tpl/default_fo/header.tpl.php");
?>
<form class="form-inline" role="form" method="post" action="">
  <div class="form-group">
    <label class="sr-only" for="login">Login</label>
    <input type="login" class="form-control" name="login" id="login" placeholder="Enter login">
  </div>
  <div class="form-group">
    <label class="sr-only" for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Remember me
    </label>
  </div>
  <button type="submit" class="btn btn-default">Sign in</button>
</form>
<?php
require_once(WEBSITE_PATH."tpl/default_fo/footer.tpl.php");
?>
