<div class='container text-center'>
	<form action='/public/register.php' method='post'>
		<div class='form-group col-lg-4 col-lg-offset-4'>
			<input type='text' class='form-control' name='username' placeholder='Username'>
		</div>
		<div class='form-group col-lg-4 col-lg-offset-4'>
			<input type='password' class='form-control' name='password' placeholder='Password'>
		</div>
		<div class='form-group col-lg-4 col-lg-offset-4'>
			<input type='password' class='form-control' name='confirmation' placeholder='Password Again'>
		</div>
		<div class='form-group col-lg-4 col-lg-offset-4'>
			<input type='email' class='form-control' name='email' placeholder='Email'>
		</div>
		<div class='form-group col-lg-4 col-lg-offset-4'>
			<button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-log-in'></span> Register</button>
		</div>
	</form>
</div>

<div class='text-center'>
    <p>or <a href="/public/login.php">Log In</a>.</p>
</div>