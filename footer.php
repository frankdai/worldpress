<?php
/**
 * The footer template file.
 * @package Wolrdpress
 * @since RestImpo 0.0.1
*/
?>
<footer id="wrapper-footer">
	<?php 
	$footer_column_number=(int) is_active_sidebar('first_footer_widget')+(int) is_active_sidebar('second_footer_widget')+(int) is_active_sidebar('third_footer_widget');
	$footer_column_number=12/$footer_column_number;
	?>
	<div class="container">
		<?php if (is_active_sidebar('first_footer_widget')): ?>
		<div class="col-md-<?php echo $footer_column_number?>">
			<?php dynamic_sidebar( 'first_footer_widget' ); ?>
		</div>
		<?php endif;?>
		<?php if (is_active_sidebar('second_footer_widget')): ?>
		<div class="col-md-<?php echo $footer_column_number?>">
			<?php dynamic_sidebar( 'second_footer_widget' ); ?>
		</div>
		<?php endif;?>
		<?php if (is_active_sidebar('third_footer_widget')): ?>
		<div class="col-md-<?php echo $footer_column_number?>">
			<?php dynamic_sidebar( 'third_footer_widget' ); ?>
		</div>
		<?php endif;?>
  	</div>
</footer>
<footer class="credit">
	<div class="container">
		<div class="col-xs-6 powered-by-wordpress text-left">Proudly Powered By <a href="http://wordpress.org">Wordpress</a></div>
		<div class="col-xs-6 theme-credit text-right">Themed By <a href="http://frankdai.com">Frank Dai</a></div>
	</div>
</footer>
<?php wp_footer(); ?>      
</body>
</html>