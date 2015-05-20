<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Worldpress
 * @since Worldpress 0.1
 */

get_header(); ?>

<div id="main-content" class="container main-content">
	<?php
		if ( have_posts() ) {
			while ( have_posts() ) {

				the_post(); ?>

				
				<article>
				<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
				<div><?php the_date(); ?></div>	
				<?php the_content(); ?>
				<div><?php wp_link_pages(); ?></div>
				<div><?php echo $post->ID;?></div>
				<pre><?php echo array_shift(get_attached_media('image'))->guid;?></pre>
				<?php if(!get_post_custom($post->ID)['dislike']) {
					add_post_meta($post->ID,'dislike',0,true);
					}
					else {
						echo '<span class="dislike">'.get_post_custom_values('dislike',$post->ID)[0].'</span>';
					}
				?>
				<?php if(!get_post_custom($post->ID)['like']) {
					add_post_meta($post->ID,'like',0,true);
					}
					else {
						echo '<span class="like">'.get_post_custom_values('like',$post->ID)[0].'</span>';
					}
				?>
				<div><?php the_tags(" "," ")?></div>
				<div><?php the_author_posts_link(); ?></div>
				</article>
			<?php }
		}
	?>
	<div class="nav-next alignright"><?php echo paginate_links(); ?></div>
</div>

<?php
get_sidebar();
get_footer();
