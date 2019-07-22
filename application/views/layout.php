<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>TechiePlanet Challenge</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 15px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
		font-weight: bold;
		padding: 5px 20px
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	h1 strong{
		padding-left: 20px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	table{
		width: 100%;
		text-align: center;
	}

	#body {
		margin: 0 15px 0 50px;
	}

	#body div{
		/*text-align: right;*/
	}


	p.footer {
		text-align: right;
		font-size: 13px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">

	<?php echo (isset($heading)) ? '<h1>'.$heading.'</h1>' : ''; ?>

	<div id="body">

	<?php

		echo (isset($post) ? $post : "");

	?>

	</div>
	<p class="footer"> <a href="/">Home</a> <a href="/test1">Test 1</a> <a href="/test2">Test 2</a></p>
	
</div>

<script type="text/javascript">
	
	function send() {

		var name = document.getElementById("name").value;
		var email = document.getElementById("email").value;
		var age = document.getElementById("age").value;
		var addr = document.getElementById("addr").value;

		if (name == '' || email == '' || age == '' || addr == '') {
			
			alert("All Fields are required");
		} 
		else {

			var params = 'name=' + name + '&email=' + email + '&age=' + age + '&addr=' + addr;

			var xmlhttp = new XMLHttpRequest();

	        xmlhttp.onreadystatechange = function() {

	            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

	            	document.getElementById("form").reset();
	                
	                document.getElementById("output").innerHTML = xmlhttp.responseText;
	            }
	        };

	        xmlhttp.open("POST", "/test2/ajax", true);
	        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	        xmlhttp.send(params);
	    }
	}
</script>
</body>
</html>
