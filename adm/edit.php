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
							<td><a style="color: #800000; text-decoration: none;" href="panel.php">Home</a></td>
							<td><b>Edit</b></td>
							<td><a style="color: #800000; text-decoration: none;" href="settings.php">Settings</a></td>
							<td><a style="color: #800000; text-decoration: none;" href="logout.php">Logout</a></td>
						</tr>
					</table>
					<hr>';
			$prefix = 'http://www.example.com/rssfeed/';$xml = simplexml_load_file($prefix.'rss.xml');
			$i=1;
			$flag = 0;
			echo '<table border="0">';		  
			foreach($xml->channel->item as $item)
			{
				echo '	<form method="post" action="edit2.php">
						<tr>							
							<td><b>'.$i.'</b></td>	
							<td '; if($flag===1){echo ' bgcolor="#C7C7C7" ';} echo '>'.$item->title.'</td>
							<td><input type="submit" name="edit" value="edit"></td>
							<input type="hidden" name="entry" value="'.$i.'">
							</form>
						</tr>';
				if($flag===1)
				{
					$flag = 0;
				}
				else
				{
					$flag = 1;
				}
				$i = $i + 1;
			}
			echo '</table>
				</center>
			</html>
		';
	}
?>
