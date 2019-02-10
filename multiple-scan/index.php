<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ipscanner | multiple-scan</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="lib/js/jquery-2.2.2.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="lib/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="lib/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="lib/js/bootstrap.min.js"></script>
	<script src="lib/js/functions.js"></script>
	<style type="text/css">
		body {
			background-color: #257E3E;
		}
		div#area{
			color: #fff;
			max-width: 600px;
			height: auto;
			margin: 5% auto;
			padding: 0px 20px;
			background-color: #257E3E;
		}
		@media screen and (max-width:768px) { 
			div#area{
				margin: 10% auto;
				max-width: 90%;
			}
		}
		strong#status {
			font-size: 18px;
			
		}
		div#response, div#request {
			word-wrap: normal;
			word-wrap: break-word;
		}
		a {
			color: #bbb;
		}
		a:hover{
			color: #f9f9f9;
		}
	</style>
</head>
<body>
	<div class="container" id="area">
		<div class="col-md-12">
			
			<h3>ipscanner | multiple-scan </h3>
			<hr>
			<form id="ipscanner">
				<div class="col-md-6">
					<div class="form-group">
						<label>Response Waiting Time</label>
						<input type="text" class="form-control" name="wait" placeholder="1 Process Wait Time" value="1">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Connection Limit</label>
						<input type="text" class="form-control" name="limit" placeholder="1 Second Connection Limit" value="3">
					</div>
				</div>
				<div class="col-md-12"><hr></div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Start ip address</label>
						<input type="text" class="form-control" name="oneip" placeholder="Start Ip Address" value="0.0.0.0">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Finish ip address</label>
						<input type="text" class="form-control" name="twoip" placeholder="Finish Ip Address" value="255.255.255.255">
					</div>
				</div>
				<div class="col-md-12"><hr></div>
				<div class="col-md-12">
					<div class="form-group">
						<strong id="status"></strong>
					</div>
					<div class="form-group" id="response">
					</div>
				</div>
				<div class="col-md-12"><hr></div>
				<div class="col-md-12">
					<div class="form-group">
						<button type="button" class="btn btn-success" id="ipscanner">Scan</button>
					</div>
				</div>
				<div class="col-md-12"><hr></div>
				<div class="col-md-12"><p><small>You can report bugs to the <a href="https://www.github.com/aliyilmaz" target="_blank">Github profile</a>.</small></p></div>

			</form>
		</div>
	</div>
</body>
</html>
