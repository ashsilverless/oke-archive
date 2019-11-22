<?php
/**
 * The template for displaying all single posts
 *
 * @package oke
 */
get_header();
if (have_posts()) : while (have_posts()) : the_post();
$heroImage = get_field('banner_image'); ?>

<!-- ******************* Hero Content ******************* -->

<div class="hero standard h75 mb2" style="background-image: url(<?php echo $heroImage; ?>);">
    <div class="container align-center">
		<div class="col">
		    <div class="hero__content">
                <h1 class="heading heading__lg heading__caps heading__light"><?php the_title();  ?></h1>
		    </div>
		</div>
	</div>
</div><!--hero standard-->

<!-- ******************* Hero Content END ******************* -->

<div class="container cols-16-8 grid-gap">
	<div class="col mb3">
		<div class="description camp mb3">
			<?php the_content(); ?>
		</div>
		<div class="post-links">
			<div>
				<?php $next_post = get_adjacent_post(false, '', true);
				if(!empty($next_post)) {
				echo '<a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '"> <i class="fas fa-angle-left"></i>' . $next_post->post_title . '</a>'; }?>
			</div>
			<div>
				<?php $next_post = get_adjacent_post(false, '', false);
				if(!empty($next_post)) {
				echo '<a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '"> ' . $next_post->post_title . '<i class="fas fa-angle-right"></i></a>'; }?>
			</div>
		</div>
	</div>
	<div class="col">
		<h2 class="heading heading__md mb1">Discover The Timeless Beauty Of The Okavango Delta</h2>
		<?php
    $loop = new WP_Query( array(
		'post_type' => 'itineraries',
		'posts_per_page' => 3,
		'orderby'   => 'rand'
	) );
    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post();?>
		<div class="safari-summary">
			<?php $safariImage = get_field('banner_image');?>
			<div class="image" style="background:url(<?php echo $safariImage['url']; ?>);">
				<h2 class="heading heading__sm heading__light"><?php the_title(); ?></h2>
			</div>
			<div class="meta">
				<div class="nights"><i class="fas fa-moon"></i><?php the_field('number_of_nights'); ?> Nights</div>
				<div class="cost"><i class="fas fa-credit-card"></i>From $<?php the_field('cost'); ?></div>
			</div><!--meta-->
			<!--<div class="camps">
				<?php $safari_id = get_the_ID();
				if( get_field('daily_activity', $safari_id) ) { while(has_sub_field('daily_activity', $safari_id)) {
					$post_objects = get_sub_field('daily_camp', $safari_id);
					if( $post_objects ):
						$post = $post_objects;
						setup_postdata( $post ); ?>
						<div class="camps__item"><?php the_title(); ?></div>
					<?php wp_reset_postdata();
				endif; }} ?>
			</div>-->
			<a href="<?php the_permalink($safari_id); ?>" class="button">View Safari</a>
		</div>
	<?php endwhile; endif;?>

</div><!--col-->
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
