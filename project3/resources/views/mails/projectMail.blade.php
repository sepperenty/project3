<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mail</title>
</head>
<body>
		
		<h1>{{$data->subject}}</h1>

		<p>{{$data->message}}</p>
		<hr>

		<h4>Verzonden door</h4>

		
		<p>{{$data->user->name}}</p>
		<p>{{$data->user->email}}</p>


</body>

 </html>