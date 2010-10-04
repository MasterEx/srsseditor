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
 
	if(isset($_POST['submit']))
	{
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$md5 = md5(md5(md5($pass)));		
		$prefix = 'http://localhost/rss/';
		if(strcmp($user,$aname)===0 && strcmp($md5,$apass)===0)
		{
			$_SESSION['id'] = "";
			$_SESSION['id'] = "admin";
		}
		else
		{
			$_SESSION['id'] = "";
			$_SESSION['id'] = "FAIL";
			header('Location: index.php');
		}
	}
	if(strcmp($_SESSION['id'],'admin')===0)
	{		
		echo '
			<html>
				<head>
					<title>RSS Feed -- Administration Panel</title>
					<META AUTHOR="Periklis Ntanasis a.k.a. Master_ex">
					<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
					<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
					<LINK REL="SHORTCUT ICON" HREF="favicon.ico"> 
				</head>
				<center>
					<table>
						<tr>
							<td><b>Home</b></td>
							<td><a style="color: #800000; text-decoration: none;" href="edit.php">Edit</a></td>
							<td><a style="color: #800000; text-decoration: none;" href="settings.php">Settings</a></td>
							<td><a style="color: #800000; text-decoration: none;" href="logout.php">Logout</a></td>
						</tr>
					</table>
					<hr>
					<form method="post" action="http://localhost/rss/adm/commit.php">
						<table>
							<tr>
								<td>Title:</td>
								<td><input type="text" name="title"></td>
							</tr>
							<tr>
								<td>link:</td>
								<td><input type="text" name="link"></td>
							</tr>
							<tr>
								<td>Category:</td>
								<td><input type="text" name="cat"></td>
							</tr>
							<tr>
								<td>Description:</td>
								<td><textarea name="desc" cols="40" rows="5"></textarea></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="submit2" value="submit"></td>
							</tr>
						</table>
					</form>
				</center>
			</html>
		';
	}
?>
