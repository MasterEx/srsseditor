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
	if(isset($_POST['submit2']))
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
							<hr><center>';
				if(strcmp($title,"")===0 or strcmp($description,"")===0 or strcmp($link,"")===0)
				{
					echo '<font color="red">You must specify the Required Channel Elements</font> in <a style="color: #800000; text-decoration: none;" href="settings.php">Settings</a> or you may return to <a style="color: #800000; text-decoration: none;" href="panel.php">Home</a>.';
				}		
				else
				{
					if($archive==1)
					{
						$wr = new writer('../archive.xml');
						$wr->set_archive('archive.xml');
						$wr->add_new($_POST['title'],$_POST['desc'],$_POST['link'],$_POST['cat']);
					}
					if($feedslimit==1)
					{
						$writer->add_new_limit($_POST['title'],$_POST['desc'],$_POST['link'],$_POST['cat']);
					}
					else
					{
						$writer->add_new($_POST['title'],$_POST['desc'],$_POST['link'],$_POST['cat']);
					}
					echo		'Your RSS Feed was updated!
									</br>You may review it <a style="color: #800000; text-decoration: none;" href="'.$rsslocation.'">here</a> or you may <a style="color: #800000; text-decoration: none;" href="panel.php">create a new Feed</a>.';
				}				
				echo		'</center>
						</center>
					</html>
				';
	}
}
?>
