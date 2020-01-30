<div class="map-outer-wrapper">
    <?php get_template_part('template-parts/map-features');?>
    <div class="camp-map">
        <div class="positioning-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/inc/img/master-mapv1.jpg" />
            <?php get_template_part('template-parts/water-overlayv1');?>
            <?php get_template_part('template-parts/labels-overlayv1');?>
            <div id="Container" class="marker-wrapper">

                <?php if( have_rows('daily_activity') ): while( have_rows('daily_activity') ): the_row(); $post_object = get_sub_field('daily_camp');
                if( $post_object ):
                    // override $post
                    $post = $post_object;
                    setup_postdata( $post );
                     ?>
                     <?php $mapImage = get_field('banner_image', $post);?>
                     <?php if( have_rows('map_marker', $post) ):

                     while ( have_rows('map_marker', $post) ) : the_row();
                     $markerPositionVert = get_sub_field('distance_from_top');
                     $markerPositionHoriz =  get_sub_field('distance_from_left');?>

                     <div id="" class="marker" style="top:<?php the_sub_field('distance_from_top');?>.000001%; left: <?php the_sub_field('distance_from_left');?>.000001%; display:block;">
                         <div class="camp-map__card <?php if ( $markerPositionVert < 35 ) {echo 'high';};?> <?php if ( $markerPositionHoriz < 10 ) {echo 'left';};?> <?php if ( $markerPositionHoriz > 89 ) {echo 'right';};?>">
                         <div class="inner">
                             <?php echo $markerHigh;?>
                             <div class="image" style="background-image: url(<?php echo $mapImage['url']; ?>);"></div>
                             <h2 class="heading heading__sm"><?php the_title();?></h2>
                         </div>
                     </div><!--card-->
                     </div>
                     <!--marker-->
                 <?php endwhile; endif;//end of have rows loop?>
                <?php wp_reset_postdata();
                endif;
                endwhile; endif; //end of post data loop?>
            </div>
            <!--marker-wrapper-->
        </div>
        <!--posn-wrapper-->
    </div>
    <!--camp-map-->

</div>
<!--outer-wrapper-->
