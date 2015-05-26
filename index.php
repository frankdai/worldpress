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
<?php if (is_front_page()):?>
<div class="container front-headline">
	<img class="img-responsive center-block" src="<?php echo get_template_directory_uri().'/logo.png';?>" />
	<h3 class="centered-text"><?php bloginfo('description');?></h3>
</div>
<div class="container featured-posts">
	<?php $three_featured_posts=wp_get_recent_posts(array('numberposts' => 3,'post_type' => 'feature','post_status' => 'publish'))?>
	<?php if ($three_featured_posts):?>
	<div class="jslide">
	    <div class="jslide-control left nomore"><i class="fa fa-chevron-left"></i></div>
	    <div class="jslide-control right"><i class="fa fa-chevron-right"></i></div>
	    <div class="jslide-outside">
	        <div class="jslide-container clearfix">
	        	<?php foreach ($three_featured_posts as $recent) :?>
			            <div class="jslide-item">
			            	<article class="posts clearfix">
			            		<h2><?php echo get_the_title($recent["ID"]);?></h2>
			            		<div class="post-info col-sm-3">
			            			<span class="post-catergory"><?php echo __("Posted in ");?>
			            				<strong><?php echo get_the_category($recent["ID"])[0]->cat_name;?></strong>
			            			</span>
			            			<div class="post-tags">
			            					<strong>Tags:</strong>
			            					<ul>
			            					<?php 
			            					$post_tags=wp_get_post_tags($recent["ID"]);
			            					foreach ($post_tags as $tags) {
			            						echo '<li>'.$tags->name.'</li>';
			            					}
			            					?>
			            					</ul>
			            			</div>
			            			<div class="post-details">
			            				<div class="post-author">
			            					<span><?php echo __('Posted By')?>:</span>
			            					<a href="<?php echo the_author_meta('user_url',$recent['post_author']);?>">
			            						 <?php echo the_author_meta('display_name',$recent['post_author']);?>
			            					</a>
			            				</div>
			            				<div class="post-date"><?php echo get_post_time( 'D, F j, Y', true, $recent["ID"]);?></div>
			            			</div>
			            		</div>
			            		<div class="post-content col-sm-9">
			            			<?php echo apply_filters('the_content',substr($recent["post_content"],0,1000)); ?>
			            			<a class="read-more" href="<?php echo get_permalink($recent['ID']);?>">
			            				<?php echo __('Read More')?>
			            			</a>
			            		</div>
			            	</article>
			            </div>
	            <?php endforeach;?>
	        </div>
	    </div>
	</div> 
	<?php endif;?>
</div>
<?php endif;?>
<div id="main-content" class="container main-content">
	<div class="posts-area col-sm-9">
	<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post(); ?>
				<section <?php post_class('blog-posts');?>>
				<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
				<div class="row">
					<div class="col-sm-3 post-date"><?php echo __("Posted On")?> <?php the_date(); ?></div>	
					<div class="col-sm-6 post-catergory"> <i class="fa fa-file"></i> <?php the_category(" ","single"); ?></div>	
				</div>
				<article class="post-content">
				<?php if (has_post_thumbnail()): ?>
					<div class="featured-image"><?php echo get_the_post_thumbnail(); ?> </div>
				<?php endif;?>
				<?php the_content(); ?>
				<div class="no-display forlikedata" data-postid="<?php echo $post->ID;?>" data-action="<?php echo get_template_directory_uri().'/like.php'?>"></div>
				<?php if(!get_post_custom($post->ID)['dislike']) {
					add_post_meta($post->ID,'dislike',0,true);
					}
					else {
						echo '<span class="dislike"><i class="fa fa-thumbs-o-down"></i><span>'.get_post_custom_values('dislike',$post->ID)[0].'</span></span>';
					}
				?>
				<?php if(!get_post_custom($post->ID)['like']) {
					add_post_meta($post->ID,'like',0,true);
					}
					else {
						echo '<span class="like"><i class="fa fa-thumbs-o-up"></i><span>'.get_post_custom_values('like',$post->ID)[0].'</span></span>';
					}
				?>
				<div class="tags"><?php echo __('Tagged:') ?> <?php the_tags(" "," ")?></div>
				<div class="post-info clearfix">
					<div class="authorship float-left col-sm-4"><?php echo __("Posted By ")?><?php the_author_posts_link(); ?></div>
					<div class="links float-right col-sm-4 col-sm-offset-4">
						<span>
							<a href="<?php the_permalink(); ?> ">
								<?php echo __('Permanent Link');?>
							</a>
						</span>
						<span><a href=" <?php comments_link(); ?>"><?php comments_number(__('No Comments Yet')); ?></a></span>
					</div>
				</article>
				</section>
			<?php }
		}
	?>
	<div class="pagination"><?php echo paginate_links(); ?></div>
	</div>
	<?php
	get_sidebar();
	?>
</div>

<?php
get_footer();

