<div class="page-header">
  <h1><?php echo('Change password'); ?></h1>
</div>

<div>
	<form role="form" action="/req/reset/" method="post">
	  <div class="form-group">
	    <label for="email">Email address</label>
	    <input name="email" type="email" class="form-control" id="email" placeholder="Enter email">
	  </div>
	  <div class="form-group">
	    <label for="password">Password</label>
	    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
	  </div>
	  <div class="form-group">
	    <label for="confirm-password">Confirm Password</label>
	    <input name="confirm_password" type="password" class="form-control" id="confirm-password" placeholder="Confirm Password">
	  </div>
	  <button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>