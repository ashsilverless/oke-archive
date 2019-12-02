<?php
/**
 * ============== Template Name: Accommodation
 *
 * @package oke
 */
get_header();?>

<!-- ******************* Hero ******************* -->
<div class="map-outer-wrapper">
	<?php get_template_part('template-parts/overlay-filter');?>
	<div class="camp-map">
		<div class="positioning-wrapper">
			<img src="<?php echo get_template_directory_uri(); ?>/inc/img/test-map.png"/>
			<!--<?php get_template_part('template-parts/test-overlay1');?>-->
			<div id="Container" class="marker-wrapper">
				<?php
				$args = array(
				  'post_type'   => 'camps',
				 );
				$camps = new WP_Query( $args );
				if( $camps->have_posts() ) :
				while( $camps->have_posts() ) :
				    $camps->the_post();
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
					$focusslug = $focus[0];

					?>

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

	<div class="filter-wrapper">
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

<div class="outer-wrapper">
<div class="container grid-gap cols-16-8 pt3">
	<div class="col">
		<div class="leading-copy">
			<?php the_field('leading_copy_paragraph');?>
		</div>
		<div class="two-columns mb3">
			<?php the_field('page_copy');?>
		</div>
		<?php $ctaImage = get_field('background_image');?>
			<div class="cta cta--focus" style="background-image: url(<?php echo $ctaImage['url']; ?>);">
				<div class="content">
					<h3 class="heading heading__lg heading__light">
						<?php the_field('heading');?>
					</h3>
					<p><?php the_field('content');?></p>
					<a href="<?php the_field('button_target');?>"><?php the_field('button_text');?></a>
				</div>
			</div><!--cta focus-->
	</div>
	<div class="col">
		<h4 class="heading heading__md heading__caps heading__body mb1">Our Travel Partners</h4>
		<div class="company-summary toggle-wrapper">
			<?php
			$terms = get_terms( array(
			    'taxonomy' => 'company'
			) );
			$number = 1;
			foreach ($terms as $term):
			$companyImage = get_field('banner_image', $term);
			?>
			<div class="company-summary__item">
					<input class="toggle" id="id-<?php echo $number;?>" type="checkbox"/>
					<div class="header">
  					<label class="group" for="id-<?php echo $number;?>">
						<h2 class="heading heading__sm heading__caps heading__body"><?php echo $term->name;?></h2>
						<?php get_template_part("template-parts/arrow-large"); ?>
					</label>
				</div>
				<div class="body hideable">
					<div class="image" style="background:url(<?php echo $companyImage['url']; ?>);"></div>
					<?php the_field('short_description', $term);?>
					<a href="<?php echo $term_link = get_term_link( $term ); ?>" class="button"><span>View All</span>ACCOMMODATION</a>
				</div>
			</div>
			<?php
			$number++;
			endforeach;?>
		</div><!--company-sidebar-->
	</div>
</div>
</div><!--outer wrapper-->
<?php get_footer();?>
