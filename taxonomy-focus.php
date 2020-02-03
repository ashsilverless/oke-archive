<?php
/**
 * The template for displaying FOCUS taxonomy
 *
 * @package ode
 */
get_header();
$term = get_queried_object();?>
<?php $args = array(
    'post_type' => 'camps',
    'tax_query' => array(
    'relation' => 'AND',
        array(
            'taxonomy' => 'focus',
            'field' => 'slug',
            'terms' => array( $term->slug )
        ),
    )
);
$query = new WP_Query( $args );?>
<!-- ******************* Map Component ******************* -->
<!--=========== global =============-->
<div  id="map-outer-wrapper" class="map-outer-wrapper has-overlay">
<div class="overlay-text">
    <h1 class="heading heading__xl heading__light"><?php echo $term->name;?> Focused Properties</h1>
    <h2 class="heading heading__sm heading__light"><?php the_field('sub_heading', $term);?></h2>
</div>
	<?php get_template_part('template-parts/map-features');?>
	<div class="camp-map">
		<div class="positioning-wrapper">
			<img src="<?php echo get_template_directory_uri(); ?>/inc/img/master-mapv1.jpg"/>
            <?php get_template_part('template-parts/water-overlayv1');?>
            <?php get_template_part('template-parts/labels-overlayv1');?>
			<div id="Container" class="marker-wrapper">
                <?php if ( $query->have_posts() ): while ( $query->have_posts() ):
                    $query->the_post();
					$mapImage = get_field('banner_image');?>

					<?php if( have_rows('map_marker') ):
					while ( have_rows('map_marker') ) : the_row();
					$markerPositionVert = get_sub_field('distance_from_top');
					$markerPositionHoriz = get_sub_field('distance_from_left');?>

                    <div class="marker mix" style="top:<?php the_sub_field('distance_from_top', $term);?>.000001%; left: <?php the_sub_field('distance_from_left', $term);?>.000001%;">
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
</div><!--outer-wrapper-->

<div class="container cols-16-8 grid-gap">
    <div class="col pt3">
        <div class="pr15"><?php the_field('description', $term);?></div>
        <h2 class="heading heading__md heading__caps mt2 mb1">
            <?php echo $term->name;?> Focused Properties
        </h2>
         <div class="camp-summary full-width mb5">
            <?php
                $args = array(
                    'post_type' => 'camps',
                    'tax_query' => array(
                    'relation' => 'AND',
                        array(
                            'taxonomy' => 'focus',
                            'field' => 'slug',
                            'terms' => array( $term->slug )
                        ),
                    )
                );
                $query = new WP_Query( $args );

                if ( $query->have_posts() ): while ( $query->have_posts() ):
                $query->the_post();
                $campImage = get_field('banner_image');?>

                <div class="camp-summary__item">
                <div class="container cols-12">
                    <div class="col">
                       <div class="image" style="background:url(<?php echo $campImage['url']; ?>);">
                            <h2 class="heading heading__sm heading__light">
                                <?php the_title(); ?>
                            </h2>
                        </div>
                    </div>
                    <div class="col">
                        <div class="content">
                            <p class="cost"><i class="fas fa-credit-card"></i> From $<?php the_field('cost');?></p>
                            <p class="destinations"><i class="fas fa-map-marker-alt"></i><?php the_terms( $post->ID, 'destinations'); ?></p>
                            <div class="description"><?php the_field('short_description');?></div>
                            <a href="<?php the_permalink(); ?>" class="button">View <?php the_title(); ?></a>
                        </div>
                    </div>
                </div>
                </div><!--item-->
            <?php endwhile; endif;?>
        </div><!--camp-summary full-width-->

        <?php if( have_rows('call_to_action', $term) ):
        while( have_rows('call_to_action', $term) ): the_row();
        $ctaImage = get_sub_field('background_image');?>
            <div class="cta cta--focus" style="background-image: url(<?php echo $ctaImage['url']; ?>);">
                <div class="content">
                    <h3 class="heading heading__lg heading__light">
                        <?php the_sub_field('heading', $term);?>
                    </h3>
                    <p><?php the_sub_field('content', $term);?></p>
                    <a href="<?php the_sub_field('button_target');?>"><?php the_sub_field('button_text');?></a>
                </div>
            </div><!--cta focus-->
         <?php endwhile; endif;?>

    </div>

    <div class="col pt2">
        <h2 class="heading heading__md heading__caps mt2 mb1">Other Property Types</h2>
        <div class="leaders focus">
        <?php
        $current_tax = get_queried_object_id();
        $taxterms = get_terms( 'focus', array(
        'orderby' => 'name',
        'order'   => 'ASC',
        'exclude' => $current_tax
        ));
        if ( ! empty( $taxterms ) ){
            foreach ( $taxterms as $taxterm ) {
            $taxImage = get_field('banner_image', $taxterm);?>
            <div class="image" style="background:url(<?php echo $taxImage['url']; ?>);"></div>
            <h2 class="heading heading__sm heading__caps mt1">
                <?php echo $taxterm->name;?> Focused Properties
            </h2>
            <?php the_field('description', $taxterm);?>
            <a href="<?php echo $term_link = get_term_link( $taxterm ); ?>" class="button">View Properties</a>
        <?php  }
        }?>
        </div><!--leaders-focus-->
    </div>
</div>

<?php get_footer();?>
