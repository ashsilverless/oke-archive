<!--=========== global =============-->
<div id="map-outer-wrapper" class="map-outer-wrapper">
	<?php get_template_part('template-parts/map-features');?>
	<div class="camp-map">
		<div class="positioning-wrapper">
			<img src="<?php echo get_template_directory_uri(); ?>/inc/img/master-mapv1.jpg"/>
			<?php get_template_part('template-parts/water-overlayv1');?>
			<?php get_template_part('template-parts/labels-overlayv1');?>
			<div id="Container" class="marker-wrapper">
				<?php
				$args = array(
				  'post_type'   => 'camps',
				 );

				$camps = new WP_Query( $args );
				if( $camps->have_posts() ) : while( $camps->have_posts() ) : $camps->the_post();
					$mapImage = get_field('banner_image');
					//Show cost as class
					$safaricost = get_field('cost');
					if ($safaricost < '1000'){
					$safaricost = "low";
					} elseif ($safaricost > '1000' && $safaricost < '2000'){
					$safaricost = "medium";
					} elseif ($safaricost > '2000'){
					$safaricost = "high";
					}
					//Get focus as slug for class
					$focus = get_the_terms($post->ID,'focus');
					$focusslug = $focus[0];?>

					<?php if( have_rows('map_marker') ):
					while ( have_rows('map_marker') ) : the_row();
					$markerPositionVert = get_sub_field('distance_from_top');
					$markerPositionHoriz = get_sub_field('distance_from_left');?>

                    <div class="marker mix <?php echo $focusslug->slug;?> <?php echo $safaricost;?>" style="top:<?php the_sub_field('distance_from_top');?>.000001%; left: <?php the_sub_field('distance_from_left');?>.000001%;">
						<div class="camp-map__card <?php if ( $markerPositionVert < 35 ) {echo 'high';};?> <?php if ( $markerPositionHoriz < 10 ) {echo 'left';};?> <?php if ( $markerPositionHoriz > 89 ) {echo 'right';};?>">
							<div class="inner">
								<?php echo $markerHigh;?>
								<div class="image" style="background-image: url(<?php echo $mapImage['url']; ?>);"></div>
								<h2 class="heading heading__sm"><?php the_title();?></h2>
								<div class="meta">
									<span>Family Safari</span>
									<span><i class="fas fa-credit-card"></i>From $<?php the_field('cost'); ?></span>
								</div>
								<a href="<?php the_permalink();?>">Learn more</a>
							</div>
						</div><!--card-->
					</div><!--marker-->
					<?php endwhile; endif;?>
				<?php wp_reset_postdata();
				endwhile; endif;?>
			</div><!--marker-wrapper-->
		</div><!--posn-wrapper-->
	</div><!--camp-map-->

	<div id="map-filter-wrapper" class="filter-wrapper">
		<div class="filter-wrapper__trigger">
			<span><i class="fas fa-filter"></i>Filter</span>
			<span><i class="far fa-times-circle"></i>Close</span>
			<form class="controls">
				<button id="Reset" class="filter-reset">Clear Filters</button>
			</form>
		</div>
		<?php get_template_part("template-parts/filter-map-accom"); ?>
	</div>
</div><!--outer-wrapper-->
