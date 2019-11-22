<?php
/**
 * The template for displaying search results pages
 *
 * @package oke
 */

get_header(); ?>

<!-- ******************* Hero Content ******************* -->

<div class="" style="background:#a9c2a5; height:75vh; display: grid; align-content: center;text-align:center;">
	<h2 class="heading heading__xl"><?php _e( 'Your search for', 'locale' ); ?> '<?php the_search_query(); ?>' returned <?php echo $wp_query->found_posts; ?>  results</h2>

</div>

<!-- ******************* Hero Content END ******************* -->

<?php global $wp_query; ?>

<div class="container grid-gap cols-16-8 pt3">
	<div class="col">
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<div class="search-card">
			<h2 class="heading heading__md"><a href="<?php echo get_permalink(); ?>"><?php the_title();  ?></a></h2>
			<?php $excerpt = wp_trim_words( get_field('short_description' ), $num_words = 50, $more = '...' );
			echo $excerpt;?>
			<p><?php the_excerpt(); ?></p>
			<a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
		</div>
		<?php endwhile; endif; ?>
	</div>
	<div class="col">
		<h3 class="heading heading__md heading__caps">Browse By Type</h3>
		<div class="container cols-8">
			<?php
			$typeterms = get_terms( array(
				'taxonomy' => 'type',
				'hide_empty' => false,
			) );
			foreach ($typeterms as $typeterm):?>
			<div class="col">
				<?php $typeImage = get_field('banner_image', $typeterm);?>
				<a href="<?php echo get_term_link($typeterm->slug, $typeterm->taxonomy);?>" class="image-leader">
					<div class="image" style="background:url(<?php echo $typeImage['url']; ?>);">
						<h2 class="heading heading__md heading__light heading__emphasis">
							<?php echo $typeterm->name;?> Safaris
						</h2>
					</div>
				</a>
			</div>
			<?php endforeach;?>


		</div>

		<h3 class="heading heading__md heading__caps">Browse By Focus</h3>
		<div class="container cols-8">
			<?php
			$typeterms = get_terms( array(
				'taxonomy' => 'focus',
				'hide_empty' => false,
			) );
			foreach ($typeterms as $typeterm):?>
			<div class="col">
				<?php $typeImage = get_field('banner_image', $typeterm);?>
				<a href="<?php echo get_term_link($typeterm->slug, $typeterm->taxonomy);?>" class="image-leader">
					<div class="image" style="background:url(<?php echo $typeImage['url']; ?>);">
						<h2 class="heading heading__md heading__light heading__emphasis">
							<?php echo $typeterm->name;?> Safaris
						</h2>
					</div>
				</a>
			</div>
			<?php endforeach;?>
		</div>
		<h3 class="heading heading__md heading__caps">Browse By Region</h3>
		<?php $destTerms = get_terms(
			'destinations',
			array(
				'hide_empty' => 0
			));
		   foreach($destTerms as $destTerm) :?>
		      <a href="<?php echo get_term_link( $destTerm->slug, $destTerm->taxonomy ); ?>"><?php echo $destTerm->name; ?></a>
		<?php endforeach;?>
	</div>
</div>

<?php get_footer(); ?>
