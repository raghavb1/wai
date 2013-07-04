<?php
if (isset($_GET['q'])) {
    $q = strtolower($_GET['q']);
}
if (!$q) {
    return;
}
//echo $q;

error_reporting(0);
    include('tmdb.php');

    //'json' is set as default return format
    $tmdb = new TMDb('0012295eb8208d7db7709d0e7b73c029'); //change 'API-key' with yours

    //if you prefer using 'xml'
    $tmdb_xml = new TMDb('0012295eb8208d7db7709d0e7b73c029',TMDb::XML);

    //Title to search for
    $title = $q;

    //Search Movie with default return format
    $xml_movies_result = $tmdb_xml->searchMovie($title);
	$xml_movies_result2=simplexml_load_string($xml_movies_result);
	$t=$xml_movies_result2;
			$s=($t->movies->movie[0]->images->image[3]->attributes())	;
			echo '<div style="float:left"><img src="'.$s[1].'" width="32px" height="32px">';
			echo($xml_movies_result2->movies->movie[0]->name).'</div>|'.$xml_movies_result2->movies->movie[0]->name;
  		
		
	   // echo '<img src="'.$e[0].'">';
    //Search Movie with other return format than the default

?>