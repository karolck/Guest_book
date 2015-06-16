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
	
	$data = array(0 => base64_encode(htmlspecialchars($title)),
 			base64_encode(htmlspecialchars($author)),
 			time(),
 			base64_encode(htmlspecialchars($page)),
 			base64_encode(nl2br(htmlspecialchars($content)))			
	);
	
	fwrite($file, implode('|', $data)."\r\n");
	fclose($file);
	return true;
	
	//zmiana HTML na zwyk�y tekst
	$content = htmlspecialchars($content);
	$content = nl2br($content);
	$content = base64_encode($content);
	
	//pobieranie wpis�w, najpierw odwracamy tablic� tak aby najnowsze wpisy by�y na pocz�tku
	// nast�pnie dekodujemy dane i pakujemmy wszystko do tablicy rezult
	
	
	function getEntry(){
		$entries = array_reverse(file(Entries));
		
		$i =1;
		$rezult = array();
		
		foreach ($entries as $entry){
			$entry = explode('|', trim($entry));
			$rezult [] = array(
					'id' => $i,
					'title' => base64_decode($entry[0]),
					'author' => base64_decode($entry[1]),
					'date' => date('d.m.Y, H:i', $entry[2]),
					'page' => base64_decode($entry[3]),
					'content' => base64_decode($entry[4])
			);
			$i++;
		}
		return $rezult;
		
	}
	
	
}