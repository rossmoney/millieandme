<?php get_header(); ?>
<div id="content">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

			<article>
				<h1><?php the_title(); ?></h1>
				<?php edit_post_link('<small>Edit this entry</small>','',''); ?>
				<?php if ( has_post_thumbnail() ) { /* loades the post's featured thumbnail, requires Wordpress 3.0+ */ echo '<div class="featured-thumbnail">'; the_post_thumbnail(); echo '</div>'; } ?>
				<div class="post-content">
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
				</div><!--.post-content-->
			</article>

			<div id="post-meta">
				<p>
					Posted on <?php the_time('F j, Y'); ?> at <?php the_time() ?>
				</p>
				<p>
					Receive new post updates: <a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow">Entries (RSS)</a>
					<br />
					Receive follow up comments updates: <?php comments_rss_link('RSS 2.0'); ?>
				</p>
			</div><!--#post-meta-->

			<?php /* If a user fills out their bio info, it's included here */ ?>


		</div><!-- #post-## -->

		<div class="newer-older">
			<div class="older">
				<p>
					<?php previous_post_link('%link', '&laquo; Previous post') ?>
				</p>
			</div><!--.older-->
			<div class="newer">
				<p>
					<?php next_post_link('%link', 'Next Post &raquo;') ?>
				</p>
			</div><!--.older-->
		</div><!--.newer-older-->
		
	<?php endwhile; /* end loop */ ?>
</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>