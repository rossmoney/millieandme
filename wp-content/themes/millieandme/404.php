<?php get_header(); ?>
<div id="content">
	<div id="error404" class="post">
		<h1>Sorry the page you are trying to view is not available!</h1>
		<div class="post-content">
			<div style="text-align:center;">
				Did you type the url? You may have typed it in incorrectly.<br /><br />
			Why not check out our <a href="events">events</a> or <a href="contact">contact us</a> for more information.
				<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
			</div>	
		</div><!--.post-content-->
	</div><!--#error404 .post-->
</div><!--#content-->
<?php get_footer(); ?>