<!DOCTYPE html>
<html>
<head>
	<title>TEST</title>
</head>
<body>
<form method="post" action="{{ url('test/upload') }}" enctype="multipart/form-data">
	@csrf
	<input type="file" name="avatar">
	{!! set_image_dimension('avatar', null, null, true) !!}

	<button type="submit">SUBMIT</button>
</form>
</body>
</html>