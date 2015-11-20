<?php
// Last request was more than 30 minutes ago
if (isset($_SESSION['activity']) && (time() - $_SESSION['activity'] > 1800)) {
    session_unset();
    session_destroy();
}

if(session_id() == '')
	session_start(); 


//Always tracking last activity of Session
$_SESSION['activity'] = time();

 
if( !isset($_SESSION['leadSource']) && isset($_SERVER['HTTP_REFERER']) ) :

	function searchArray($search, $array) {
		foreach($array as $key => $value) {
			if (strpos($search,$value)) 
				return $key;
		}
		return false;
	}

	$social = array('twitter.com','t.co','facebook.com','fb.com','linkedin.com','flickr.com','vimeo.com','xing.com','instagram.com','foursquare.com','fb.me','plus.google.com','youtube.com','youtu.be','reddit.com','tumblr.com');
	$search = array('ask','bing','msn.com','yahoo','google');

	$_SESSION['orig'] = parse_url($_SERVER['HTTP_REFERER']);
	
	switch(true) {
		
		case ( isset($_REQUEST['gclid']) || isset($_REQUEST['kw']) ) :
			$leadSource = "Search - Paid";
			break;
	
		case (strpos($_SESSION['orig']['host'], "canto.com") != false) :
			$leadSource = "Web Direct";
			break;

		case ( searchArray($_SESSION['orig']['host'], $search) != false ) :
			$leadSource = "Search - Organic";
			break;

		case ( in_array($_SESSION['orig']['host'], $social) ) :
			$leadSource = "Social";
			break;
			
		default :
			$leadSource = "Unknown";
			break;		
	}
	
	if($leadSource == "Unknown" && (strpos($_SESSION['orig']['host'], '.') != false) )
		$leadSource = "Referring Website";


	$_SESSION['leadSource'] = $leadSource;
	$_SESSION['refer'] 		= $_SERVER['HTTP_REFERER'];	

endif;

if( !isset($_SESSION['refer']) ) :

	$_SESSION['leadSource'] = "Web Direct";
	$_SESSION['refer'] 		= "Not Provided";	

endif;

//Clear Tracking Variables on thank you pages
if(isset($_REQUEST['eid']))
	session_destroy();

?>
