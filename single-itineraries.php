<?php
/**
 * ============== Itinerary Page
 *
 * @package oke
 */
get_header();
while ( have_posts() ): the_post(); ?>
<!--HERO-->
<?php get_template_part("template-parts/carousel-hero"); ?>
<div class="outer-wrapper">
    <div class="container grid-gap cols-8-16">
        <div class="col">
            <div class="sidebar mb5">
                <h4 class="heading heading__md heading__light heading__caps align-center">At A Glance</h4>
                <div class="detail-wrapper">
                    <ul>
                        <li><span class="title">Duration</span><span class="detail">
                                <?php the_field('number_of_nights');?> Nights</span></li>
                        <li><span class="title">Type </span><span class="detail">
                                <?php the_terms( $post->ID, 'type' , '<div>','', '</div>'); ?></span></li>
                        <li><span class="title">Cost</span><span class="detail">From $
                                <?php the_field('cost');?></span></li>
                    </ul>
                </div>
                <div class="destination-summary">
                    <div class="heading">Destinations</div>
                    <?php if( have_rows('destinations') ): while( have_rows('destinations') ): the_row(); ?>
                    <div class="destination-summary__item">
                        <?php the_sub_field('location');?>
                    </div>
                    <?php endwhile; endif;?>
                </div>
                <div class="camp-summary">
                    <?php if( have_rows('daily_activity') ): while( have_rows('daily_activity') ): the_row(); $post_object = get_sub_field('daily_camp');
            if( $post_object ):
                // override $post
                $post = $post_object;
                setup_postdata( $post );
                $campImage = get_field('banner_image'); ?>
                    <div class="camp-summary__item">
                        <div class="image" style="background:url(<?php echo $campImage['url']; ?>);">
                            <h2 class="heading heading__sm heading__light">
                                <?php the_title(); ?>
                        </div>
                        <div class="see-more">See More</div>
                        <div class="expanding-panel">
                            <?php the_field('short_description');?>
                            <a href="<?php the_permalink(); ?>" class="button">View
                                <?php the_title(); ?></a>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); endif;
            endwhile; endif;?>
                </div>
                <!--camp-summary-->
            </div>
            <!--sidebar-->
        </div>
        <div class="col">
            <div class="description safari mb3">
                <?php the_field('description');?>
            </div>
            <div class="safari-itinerary">
                <!--DAILY REPEATER-->
                <?php if( have_rows('daily_activity') ): while( have_rows('daily_activity') ): the_row();
            $post_object = get_sub_field('daily_camp');
            if( $post_object ):
                $post = $post_object;
                setup_postdata( $post ); ?>
                <div class="safari-itinerary__item">
                    <p class="heading">
                        <?php the_sub_field('heading');?> -
                        <?php the_title(); ?>
                        <?php get_template_part("template-parts/arrow-large"); ?>
                    </p>
                    <div class="content">
                        <?php the_sub_field('description');?>
                    </div>
                </div>
                <?php wp_reset_postdata();
            endif;
        endwhile; endif;?>
                <div class="map-outer-wrapper">
                    <?php get_template_part('template-parts/map-features');?>
                    <div class="camp-map">
                        <div class="positioning-wrapper">
                            <img src="<?php echo get_template_directory_uri(); ?>/inc/img/master-mapv1.jpg" />
                            <div id="wipe" class="wipe"></div>
                            <?php get_template_part('template-parts/water-overlayv1');?>
                            <?php get_template_part('template-parts/labels-overlayv1');?>
                            <div id="Container" class="marker-wrapper">
                                <?php $mapImage = get_field('banner_image');?>
                                <!--<?php if( have_rows('map_marker') ):
                            while ( have_rows('map_marker') ) : the_row();
                            $markerPositionVert = get_sub_field('distance_from_top');
                            $markerPositionHoriz = get_sub_field('distance_from_left');?>-->
                                <div class="marker" style="top:<?php the_sub_field('distance_from_top');?>.000001%; left: <?php the_sub_field('distance_from_left');?>.000001%;">
                                    <!--<div class="camp-map__card <?php if ( $markerPositionVert < 35 ) {echo 'high';};?> <?php if ( $markerPositionHoriz < 10 ) {echo 'left';};?> <?php if ( $markerPositionHoriz > 89 ) {echo 'right';};?>">
                                    <div class="inner">
                                        <?php echo $markerHigh;?>
                                        <div class="image" style="background-image: url(<?php echo $mapImage['url']; ?>);"></div>
                                        <h2 class="heading heading__sm"><?php the_title();?></h2>
                                    </div>
                                </div><!--card-->-->
                                </div>
                                <!--marker-->
                                <?php endwhile; endif;?>
                            </div>
                            <!--marker-wrapper-->
                        </div>
                        <!--posn-wrapper-->
                    </div>
                    <!--camp-map-->
                </div>
                <!--outer-wrapper-->
            </div>
            <!--main-->
        </div>
        <?php endwhile;?>
    </div>
    <!--outer-wrapper-->
    <?php get_footer();?>
