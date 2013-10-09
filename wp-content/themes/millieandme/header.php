<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php if ( is_category() ) {
		echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
	} elseif ( is_tag() ) {
		echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
	} elseif ( is_archive() ) {
		wp_title(''); echo ' Archive | '; bloginfo( 'name' );
	} elseif ( is_search() ) {
		echo 'Search for &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
	} elseif ( get_the_title() == "Home") {
		bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
	}  elseif ( is_404() ) {
		echo 'Error Page Not Found | '; bloginfo( 'name' );
	} elseif ( is_single() ) {
		wp_title('');
	} else {
		echo wp_title(''); echo ' | '; bloginfo( 'name' );
	} ?></title>
	<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
	<meta name="keywords" content="Event Organising, Party Planning, Bar Services, Catering">
	<meta name="designer" content="Strictly Webs" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<meta name="viewport" content="width=device-width; initial-scale=1"/><?php /* Add "maximum-scale=1" to fix the Mobile Safari auto-zoom bug on orientation changes, but keep in mind that it will disable user-zooming completely. Bad for accessibility. */ ?>
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" type="image/x-icon" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
	<?php wp_enqueue_script("jquery"); /* Loads jQuery if it hasn't been loaded already */ ?>
	<?php /* The HTML5 Shim is required for older browsers, mainly older versions IE */ ?>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?> <?php /* this is used by many Wordpress features and for plugins to work proporly */ ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/millieandme.css" />
	<link rel="shortcut icon" href="favicon.ico" />
	
	<script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/easySlider1.5.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			if(document.getElementById('slider') != null)
			{
				$("#slider").easySlider();
			}
		});
	</script>
	
	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-25608523-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
</head>

<body <?php body_class(); ?>>
<div class="none">
	<p><a href="#content">Skip to Content</a></p><?php /* used for accessibility, particularly for screen reader applications */ ?>
</div><!--.none-->
<div id="header">
    <div id="wrap">
	<div id="menu"><nav>
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); /* if the visitor is NOT logged in, this primary navigation will be displayed. if a single menu should be displayed for both conditions, set the same menues to be displayed under both conditions through the Wordpress backend */ ?>
	</nav></div>
	<div id="logo">
		<a href="/"></a>
	</div>
    </div>
</div>
<div id="main"><!-- this encompasses the entire Web site -->
	<div id="wrap" style="background-color: #fff;">
		<div id="logotext">
                    Event Organising<br />Party Planning<br />Bar Services<br />Catering
                </div>
                <div id="photoblock">
<?php
	$directorycrawl = $_SERVER['REQUEST_URI'];
	$directorycrawl = explode('/', $directorycrawl);
	for($i = 0; $i < ( count($directorycrawl) - 2 ); $i++)
	{
		$depth .= "../";
	}
	$albumdata = FALSE;
	$photocount = 0;
	$pagetitle = str_replace(' ', '', wp_title('', false));
	if($pagetitle == "") $pagetitle = str_replace(' ', '', get_the_title());
	$accountID = '102979426097809995892';
	$retrieve_url = "http://picasaweb.google.com/data/feed/api/user/".$accountID."/album/".$pagetitle."Top?kind=photo";
	//print $retrieve_url;
	$albumdata = @simplexml_load_file($retrieve_url);
	if($albumdata) {
		foreach($albumdata->entry as $photo)
		{
			$photocount++;
			if($photocount > 2) break;
			$title = $photo->title;
			$summary = $photo->summary;
			  
			$gphoto = $photo->children('http://schemas.google.com/photos/2007');
			$size = $gphoto->size;
			$height = $gphoto->height;
			$width = $gphoto->width;
			  
			$media = $photo->children('http://search.yahoo.com/mrss/');
			$thumbnail = $media->group->thumbnail[1];
			$content = $media->group->content;
			$tags = $media->group->keywords;
			$thumburl = $thumbnail->attributes()->{'url'};
			$photourl = $content->attributes()->{'url'};
			
			$gphotosize = (int) $gphoto->size;
			
			$ext = explode(".", $photourl);
			
			$photopath = "photos/". $pagetitle. "Top/" . $gphotosize . "." . $ext[(count($ext) - 1)];
			$photofilepath = getcwd() . "/" .$photopath;
			$filesize = filesize($photofilepath);
				
			if(!file_exists($photofilepath) || $filesize != $gphotosize)
			{
			
			@mkdir(getcwd() . "/photos/". $pagetitle. "Top/");
			$fp = fopen($photofilepath, 'w');
			$ch = curl_init($photourl);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			$data = curl_exec($ch);
			curl_close($ch);
			fclose($fp);
			
			}
			
			?>
			<img src="<?php if($pagetitle != "Home") { print $depth; } print $photopath; ?>" alt="<?php print $title; ?>" />
			<?php
		}
	}
?>
                </div>	  
		<div style="clear:both;"></div>
<?php
	$albumdata = FALSE;
	$accountID = '102979426097809995892';
	$albumstouse = array();
	/*if($pagetitle == "Home")
	{
		$sxml = @simplexml_load_file("http://picasaweb.google.com/data/feed/api/user/".$accountID."?kind=album");
	
		// iterate over entries in album
		// print each entry's title, size, dimensions, tags, and thumbnail image
		foreach ($sxml->entry as $album) {
		  $albumtitle = $album->title;
		  $albumpublished = $album->published;
		  $shorttitle = str_replace(' ', '', $albumtitle);
		  if(substr($shorttitle, count($shorttitle) - 8) == "Gallery")
		  {
			$albumstouse[] = $shorttitle;
		  }
		}
		?>
			<div id="slidercontainer"><div id="slider"><ul>
		<?php
	} else {*/
		$albumstouse[] = $pagetitle."Gallery";
	//}
	
	foreach($albumstouse as $album)
	{
		$albumdata = @simplexml_load_file("http://picasaweb.google.com/data/feed/api/user/".$accountID."/album/" . $album ."?kind=photo");
		if($albumdata) {
			if($pagetitle != "Home") {
			?>
			<div id="slidercontainer"><div id="slider"><ul>
			<?php
			}
			foreach($albumdata->entry as $photo)
			{
				$title = $photo->title;
				$summary = $photo->summary;
				  
				$gphoto = $photo->children('http://schemas.google.com/photos/2007');
				$size = $gphoto->size;
				$height = $gphoto->height;
				$width = $gphoto->width;
				  
				$media = $photo->children('http://search.yahoo.com/mrss/');
				$thumbnail = $media->group->thumbnail[1];
				$content = $media->group->content;
				$tags = $media->group->keywords;
				$thumburl = $thumbnail->attributes()->{'url'};
				$photourl = $content->attributes()->{'url'};
				$gphotosize = (int) $gphoto->size;
			
				$ext = explode(".", $photourl);
			
				$photopath = "photos/". $pagetitle. "Gallery/" . $gphotosize . "." . $ext[(count($ext) - 1)];
				$photofilepath = getcwd() . "/" .$photopath;
				$filesize = filesize($photofilepath);
				
				if(!file_exists($photofilepath) || $filesize != $gphotosize)
				{
				
				@mkdir(getcwd() . "/photos/". $pagetitle. "Gallery/");
			     
				$fp = fopen($photofilepath, 'w');
				$ch = curl_init($photourl);
				curl_setopt($ch, CURLOPT_FILE, $fp);
				$data = curl_exec($ch);
				curl_close($ch);
				fclose($fp);
				
				}
				
				?>
				<li><img src="<?php if($pagetitle != "Home") { print $depth; } print $photopath; ?>" alt="<?php print $title; ?>" width="425" /></li>
				<?php
			}
			if($pagetitle != "Home") {
			?>
			</ul></div>
				<div style="clear:both;"></div>
			</div>
			<?php
			}
		}
	}
	/*if($pagetitle == "Home") {
		?>
		<!--</ul></div></div>-->
		<?php
	}*/
?>