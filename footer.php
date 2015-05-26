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
</footer>  <!-- end of wrapper-footer -->
<?php wp_footer(); ?>      
</body>
</html>