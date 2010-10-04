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
		if(isset($_POST['cancel']))
		{
			header('Location: '.$rsslocation.'/adm/edit.php');
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
			if(isset($_POST['submit']))
			{
				include('../xml_writer.php');
				$writer = new writer('../rss.xml');
				$wr = new writer('../archive.xml');
				$wr->set_archive('archive.xml');
				$wr->add_new($_POST['title'],$_POST['description'],$_POST['link'],$_POST['category']);
				$writer->edit($_POST['pos'],$_POST['title'],$_POST['description'],$_POST['link'],$_POST['category']);
				echo "The entry was successfully updated!</br>You may review it <a style='color: #800000; text-decoration: none;' href='$rsslocation'>here</a> or you may <a style='color: #800000; text-decoration: none;' href='".$rsslocation."adm/edit.php>edit another Feed</a>.";
			}
			if(isset($_POST['ok']))
			{
				include('../xml_writer.php');
				$writer = new writer('../rss.xml');
				$writer->delete($_POST['pos']);
				echo "The feed was successfully deleted!</br>You may review it <a style='color: #800000; text-decoration: none;'$rsslocation'>here</a> or you may <a style='color: #800000; text-decoration: none;' href='".$rsslocation."adm/edit.php>edit another Feed</a>.";
			}
			if(isset($_POST['delete']))
			{
				echo "Are you sure that you want to delete this feed?</br>Press \"OK\" for yes or \"Cancel\" for no.</br>";
				echo '<form method="post" action="edit2.php">
					<input type="hidden" name="pos" value="'.$_POST['pos'].'">
					<table>
						  <tr>
							  <td><input type="submit" name="ok" value="OK"></td>
							  <td><input type="submit" name="cancel" value="Cancel"></td>
						  </tr>
					  </table></form>';
				echo '<form method="post" action="edit2.php">
					<input type="hidden" name="pos" value="'.$_POST['pos'].'">
					<input type="hidden" name="title" value="'.$_POST['title'].'">
					<input type="hidden" name="description" value="'.$_POST['description'].'">
					<input type="hidden" name="link" value="'.$_POST['link'].'">
					<input type="hidden" name="category" value="'.$_POST['category'].'">
					<table>
						<tr>
							<td>If you want to perform update now click<td>
							<td><td><input type="submit" name="submit" value="here">.</td>
						</tr>
					</table></form>';
			}
			if(isset($_POST['edit']))
			{
				$xml = simplexml_load_file($rsslocation.'rss.xml');
				$i = $_POST['entry'];
				echo '<form method="post" action="edit2.php">
				<input type="hidden" name="pos" value="'.$i.'">
				<table border="0">
						<tr>		
							<td>Title:</td>
							<td><input type="text" name="title" value="'.$xml->channel->item[$i-1]->title.'"></td>
						</tr>
						<tr>
							<td>link:</td>
							<td><input type="text" name="link" value="'.$xml->channel->item[$i-1]->link.'"></td>
						</tr>
						<tr>
							<td>Category:</td>
							<td><input type="text" name="category" value="'.$xml->channel->item[$i-1]->category.'"></td>
						</tr>
						<tr>
							<td>Description:</td>
							<td><textarea name="description" cols="40" rows="5">'.$xml->channel->item[$i-1]->description.'</textarea></td>
						</tr>
						<tr>
						</tr>
						<tr>
							<table>
								<tr>
									<td><input type="submit" name="delete" value="delete"></td>
									<td><input type="submit" name="submit" value="update"></td>
								</tr>
							</table>
						</tr>
				</table></form>';	
			}
			echo '</center>
			</html>
		';
	}
?>
