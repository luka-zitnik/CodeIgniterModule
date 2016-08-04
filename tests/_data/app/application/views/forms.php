<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Forms</title>
    </head>
    <body>
		<form id="a" method="POST" action="forms/printSubmission">
			<input name="text" type="text">

			<input id="checkedByDefault" name="checkedByDefault" type="checkbox" checked="checked">
			<label for="checkedByDefault">Uncheck Me</label>

			<input id="uncheckedByDefault" name="uncheckedByDefault" type="checkbox">
			<label for="uncheckedByDefault">Check Me</label>

			<input name="file" type="file">

			<select name="options">
				<option value="1">1</option>
				<option value="2">2</option>
			</select>

			<button>Submit</button>
		</form>
    </body>
</html>
