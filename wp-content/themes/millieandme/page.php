<?php get_header(); ?>
	<div id="content">
		<h1><?php if(get_the_title() != "Home") the_title(); ?></h1>	
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="entry">
		     <?php the_content('Read the rest of this entry »'); ?>
		</div>
	<?php endwhile; ?>
	</div>
<?php get_footer(); ?>
