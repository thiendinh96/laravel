<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<base href="{{ asset("")."admins/"}}">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<link href="css/styles.css" rel="stylesheet">
</head>

<body>

	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				@if(session("error"))
				<div class="alert alert-danger" role="alert">
					<strong> {{session("error")}}	</strong>
				</div> 
				@endif

				<div class="panel-body">
					<form role="form" method = "POST">
					@csrf
						<fieldset>
							<div class="form-group">
							<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" value="{{old('email')}}" >
							{!! ShowError($errors,"email") !!}
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
								@if($errors->has('password'))
								<div class ="alert alert-danger" role ="alert">
								  <strong>{{ $errors-> first('password')}}</strong>
								  </div>
								@endif  
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<button type="submit" class="btn btn-primary">Login</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
</body>

</html>