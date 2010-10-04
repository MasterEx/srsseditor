<?php
session_start();
/*
 * The MIT License
 *
 * Copyright (c) 2010 Ntanasis Periklis 
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
 
include("configuration.php");
 
if($_SESSION['id']===null)
{
	$_SESSION['id'] = 'user';
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="el" xml:lang="el">
	<head>
		<title>RSS Feed - Login</title>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
		<META AUTHOR="Periklis Ntanasis a.k.a. Master_ex">
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
		<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
		<LINK REL="SHORTCUT ICON" HREF="favicon.ico"> 
	</head>
	<center><h2>Administrator Login</h2></center>
	<?php if(strcmp($_SESSION['id'],'FAIL')===0){ echo "<center><font color='red'>Your username or password is wrong!</font></center>"; session_destroy(); $_SESSION['id'] = 'user'; } ?>
	<form action='panel.php' method='post'>
		<center>
			<table>
				<tr>
					<td> Username:</td>
					<td><input type='text' name='user'/></td>
				</tr>
				<tr>
					<td> Password:</td>
					<td><input type='password' name='pass'/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type='submit' name='submit' value='Login'/></td>
				</tr>
			</table>
		</center>
	</form>
</html>
