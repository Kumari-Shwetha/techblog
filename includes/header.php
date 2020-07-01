<?php
require_once("function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web trends</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css">
    <link rel="stylesheet" href="/web-trends/css/style.css">
    <script type="text/javascript">
    	function prettySubmit(form, evt) {
			evt.preventDefault();
			window.location = form.action + '/' + form.q.value.replace(/ /g, '+');
			return false;
		}
    </script>
</head>
<body class="bg">
