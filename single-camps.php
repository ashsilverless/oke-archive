<?php
/**
 * ============== Camp Page
 *
 * @package oke
 */
get_header();
while ( have_posts() ): the_post(); ?>

<!--HERO-->
<?php get_template_part("template-parts/carousel-hero"); ?>
<div class="outer-wrapper">
<?php get_template_part("template-parts/floating-heading"); ?>
<div class="container grid-gap cols-8-16">
    <div class="col">
        <div class="sidebar mb5">
            <?php $custom_terms = wp_get_post_terms($post->ID, 'company');?>
        <h4 class="heading heading__md heading__light heading__caps align-center">
            <i class="fas fa-info info-panel"></i>
            <?php the_title();?></h4>
        <div class="detail-wrapper">
            <ul>
                <li><span class="title">Location</span><span class="detail"><?php the_terms( $post->ID, 'destinations', '<div>','', '</div>'); ?></span></li>
                <li><span class="title">Parent Company</span><span class="detail"><?php the_terms( $post->ID, 'company'); ?></span></li>
                <li><span class="title">Cost</span><span class="detail">From $<?php the_field('cost');?></span></li>
                <li><span class="title">Rooms</span><span class="detail"><?php the_field('number_of_rooms');?></span></li>
                <li><span class="title">Activities</span><span class="detail activities">
                    <ul>
                        <?php $campActivities = get_terms( 'activity' );
                        foreach ( $campActivities as $campActivity ) {?>
                          <li>
                            <?php $activityicon = get_field( 'icon', $campActivity)["url"];
                            $activityicon   = explode("/wp-content/", $activityicon)[1];?>
                            <?php echo file_get_contents("./wp-content/" . $activityicon, FILE_USE_INCLUDE_PATH); ?>
                            <?php echo $campActivity->name;?>
                          </li>
                        <?php }?>
                    </ul>

                </span></li>
            </ul>
        </div>
        <h4 class="heading heading__xs heading__light heading__caps mb1">Safaris Featuring This Property:</h4>
<?php $current_id = get_the_ID();
// filter to allow query of acf sub field
function my_posts_where( $where ) {
	$where = str_replace("meta_key = 'daily_activity_$", "meta_key LIKE 'daily_activity_%", $where);
	return $where;
}
add_filter('posts_where', 'my_posts_where');
$args = array(
	'numberposts'	=> -1,
	'post_type'		=> 'itineraries',
	'meta_query'	=> array(
		'relation'		=> 'OR',
		array(
			'key'		=> 'daily_activity_$_daily_camp',
			'compare'	=> '=',
			'value'		=> $current_id,
		),
	)
);
$the_query = new WP_Query( $args );?>
<?php if( $the_query->have_posts() ): while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
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
<?php endwhile; endif;
	wp_reset_query();	 ?>
        </div>
    </div>
    <div class="col">
        <div class="description camp pl2">
            <?php the_field('short_description');?>
            <a href="#full-descr" class="button button__standard button__standard--fixed-width">Learn More</a>
            <!--======= Gallery=====-->
            <?php if( get_field('gallery') ): ?>
                <h4 class="heading heading__md heading__caps mt2">Gallery</h4>
                <div class="gallery mt0 mb5">

    			    <?php $images = get_field('gallery');
    				    if( $images ):
                        foreach( $images as $image ): $url = $image['url']; ?>
    	                   <a href="<?php echo $image['url']; ?>" style='background-image: url(<?php echo $url; ?>)'></a>
    			        <?php endforeach;
                    endif; ?>
    		    </div>
            <?php endif; ?>
            <!--=========== MAP =============-->
            <h4 class="heading heading__md heading__caps mt2 mb1"> <?php the_title(); ?> On The Map</h4>
            <div class="map-outer-wrapper">
            	<?php get_template_part('template-parts/map-features');?>
            	<div class="camp-map">
            		<div class="positioning-wrapper">
            			<img src="<?php echo get_template_directory_uri(); ?>/inc/img/master-mapv1.jpg"/>
            			<div id="wipe" class="wipe"></div>
            			<?php get_template_part('template-parts/water-overlayv1');?>
            			<?php get_template_part('template-parts/labels-overlayv1');?>
            			<div id="Container" class="marker-wrapper">

            					<?php $mapImage = get_field('banner_image');
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
            							</div>
            						</div><!--card-->
            					</div><!--marker-->
            					<?php endwhile; endif;?>
            			</div><!--marker-wrapper-->
            		</div><!--posn-wrapper-->
            	</div><!--camp-map-->

            </div><!--outer-wrapper-->

            <!--=========== FULL DESCRIPTION =============-->
                <h2 id="full-descr" class="heading heading__md heading__caps mt2">About <?php the_title(); ?></h4>
                    <?php the_field('description');?>

            <?php if( get_field('combines_well_with') ): ?>
            <h4 class="heading heading__md heading__caps mt2 mb1">Combines Well With</h4>
        <?php endif;?>
        </div>

        <?php $post_objects = get_field('combines_well_with');

        if( $post_objects ): ?>
            <div class="container grid-gap equal-height cols-12 mb5">
            <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
                <?php setup_postdata($post);

                $campImage = get_field('banner_image'); ?>
                    <div class="col">
                        <div class="listing-item">
                            <div class="image" style="background:url(<?php echo $campImage['url']; ?>);">
                                <h2 class="heading heading__sm heading__light"><?php the_title(); ?>
                            </div>
                            <div class="item"><i class="fas fa-credit-card"></i>From $<?php the_field('cost');?></div>
                            <div class="item"><i class="fas fa-map-marker-alt"></i><?php the_terms( $post->ID, 'destinations'); ?></div>
                            <?php the_terms( $post->ID, 'company'); ?>
                            <div class="item"><?php the_field('short_description');?></div>
                            <a href="<?php the_permalink(); ?>">Learn More</a>
                        </div>
                    </div>
            <?php endforeach; ?>
        </div>
        <?php wp_reset_postdata();?>
        <?php endif;?>
        </div>
    </div>
</div>

<?php endwhile;?>
</div><!--outer wrapper-->
<?php get_footer();?>
