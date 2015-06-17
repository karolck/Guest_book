<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
   <head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">
   <title>Guest book</title>
   </head>
   <body>
   	<h1>Guest book</h1>

<?php
	require ('./data.php');
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(addEntry($_POST['title'], $_POST['author'],  $_POST['page'], $_POST['content'])){
			echo 'The entry was added';
		}else {
			echo 'Please fill out the form correctly';
		}
		echo '<p><a href="index.php">Back</a></p>';
	}else {
		$entries = getEntry();
		foreach ($entries as $entry){
			echo '<hr /><p><b>Title: <i>'.$entry['title'].'</i>; 
 				Author: '.$entry['author'].'; Date: '.$entry['date'];
 			if(strlen($entry['page']) > 0)
 			{
 				echo '; <a href="'.$entry['page'] . '"> ' . $entry['page'] .  '</a>';
 			}
 			echo '</b></p>';
 			echo '<p>'.$entry['content'].'</p>';
		}
	}
	
	
	?>
	
	<form method="post" action="index.php">
		<table border="0" width="50%">
			<tr>
				<td>Title</td>
				<td><input type="text" name="title"/></td>
			</tr>
			<tr>
				<td>Author</td>
				<td><input type="text" name="author"/></td>
			</tr>
			<tr>
				<td>Page</td>
				<td><input type="text" name="page"/></td>
			</tr>
			<tr>
				<td>Content</td>
				<td><textarea name="content" rows="4" cols="50"></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Add" /></td>
			</tr>
		</table>
	</form>