<?php
define('Enrties','./entries.txt');

function addEntry($title, $author, $page, $content){
	//trim - us�wanie bia�ych znak�w
	$title = trim($title);
	$author = trim($author);
	$page = trim($page);
	$content = trim($content);
	
	//strlen - zliczanie d�ugo�ci znak�w
	if(strlen($title) < 3)
	{
		return false;
	}
	
	if(strlen($author) < 3)
	{
		return false;
	}
	
	if(strlen($content) < 10)
	{
		return false;
	}
	
	if(strlen($page) > 0)
	{
		if(strpos($page, 'http://') !== 0)
		{
			$page = 'http://'.$page;
		}
	}
	
	// Dodawanie wpisu
	
	$file = fopen(Entries, 'a');
	
	$data = array(0 => base64_encode(htmlspecialchars($tytul)),
 			base64_encode(htmlspecialchars($autor)),
 			time(),
 			base64_encode(htmlspecialchars($www)),
 			base64_encode(nl2br(htmlspecialchars($tresc)))			
	);
	
	fwrite($file, implode('|', $data)."\r\n");
	fclose($file);
	return true;
	
	//zmiana HTML na zwyk�y tekst
	$content = htmlspecialchars($content);
	
}