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
 
	if(strcmp($_SESSION['id'],'admin')===0)
	{		
		include('../xml_writer.php');
		$writer = new writer('../rss.xml');
		if(filesize('../rss.xml')===0 or file_exists($rsslocation.'rss.xml'))
		{
			$writer->open();
			$writer->close();
		}
		$xml = simplexml_load_file($rsslocation.'rss.xml');
		$title = $xml->channel->title;
		$description = $xml->channel->description;
		$link = $xml->channel->link;
		if(isset($_POST['submit3c']))
		{	
			$ntitle = $_POST['title'];
			$ndesc = $_POST['desc'];
			$nlink = $_POST['link'];
			$title = $ntitle;
			$description = $ndesc;
			$link = $nlink;
			if(strcmp($title,"")===0 or strcmp($description,"")===0 or strcmp($link,"")===0)
			{
				$writer->open();
				$writer->rce($ntitle,$ndesc,$nlink);
				$writer->close();				
				header($rsslocation.'adm/settings.php');
			}
			else
			{
				$writer->rce_update($ntitle,$ndesc,$nlink);
				header($rsslocation.'adm/settings.php');
			}
		}
		echo '
			<html>
				<head>
					<title>RSS Feed -- Administration Panel</title>
					<META AUTHOR="Periklis Ntanasis a.k.a. Master_ex">
					<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
					<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
					<LINK REL="SHORTCUT ICON" HREF="favicon.ico"> 
				</head>
				<center>';
				if(!strcmp($nuser,$vnuser)===0 && isset($_POST['submit3a']))
				{
					echo '<font color="red">Password verification failure.</font>';
				}				
		echo	'	<table>
						<tr>
							<td><a style="color: #800000; text-decoration: none;" href="panel.php">Home</a></td>
							<td><a style="color: #800000; text-decoration: none;" href="edit.php">Edit</a></td>
							<td><b>Settings</b></td>
							<td><a style="color: #800000; text-decoration: none;" href="logout.php">Logout</a></td>
						</tr>
					</table>
					<hr>
					Required Channel Elements';
					if(strcmp($title,"")===0 or strcmp($description,"")===0 or strcmp($link,"")===0)
					{
						echo '</br><font color="red">*Must be specified!</font>';
					}
			echo	'<form action="settings.php" method="post">
						<table>
							<tr>
								<td>Title:</td>
								<td><input type="text" name="title" value="'; if(isset($ntitle)){ echo $ntitle; }else{ echo $title;} echo '"></td>
							</tr>
							<tr>
								<td>Description:</td>
								<td><textarea name="desc" cols="40" rows="5">'; if(isset($ndescription)){ echo $ndescription; }else{ echo $description;} echo '</textarea></td>
							</tr>
							<tr>
								<td>link:</td>
								<td><input type="text" name="link" value="'; if(isset($nlink)){ echo $nlink; }else{ echo $link;} echo '"></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="submit3c" value="update"></td>
							</tr>
						</table>
					</form>
				</center>
			</html>
		';
	}
?>
