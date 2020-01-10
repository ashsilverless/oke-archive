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
<div class="container grid-gap cols-8-16">
    <div class="col">
        <div class="sidebar mb5">
            <?php $custom_terms = wp_get_post_terms($post->ID, 'company');?>
        <h4 class="heading heading__md heading__light heading__caps align-center">At A Glance</h4>
        <div class="detail-wrapper">
            <ul>
                <li><span class="title">Location</span><span class="detail"><?php the_terms( $post->ID, 'destinations'); ?></span></li>
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
            <?php the_field('description');?>
            <div class="gallery mt3 mb3">
			    <?php $images = get_field('gallery');
				    if( $images ):
                    foreach( $images as $image ): $url = $image['url']; ?>
	                   <a href="<?php echo $image['url']; ?>" style='background-image: url(<?php echo $url; ?>)'></a>
			        <?php endforeach;
                endif; ?>
		    </div>
            <h4 class="heading heading__md heading__caps mt2 mb1">Other <?php the_terms( $post->ID, 'company'); ?> Properties</h4>
        </div>

        <div class="container grid-gap equal-height cols-12 mb5">
        <?php if( $custom_terms ){
        // going to hold our tax_query params
        $tax_query = array();
        // add the relationship parameter
        if( $custom_terms )
        $tax_query['relation'] = 'OR' ;
        // loop through companies to build a tax query
        foreach( $custom_terms as $custom_term ) {
            $tax_query[] = array(
                'taxonomy' => 'company',
                'field' => 'slug',
                'terms' => $custom_term->slug,
            );
        }
        // put all the WP_Query args together
        $currentID = get_the_ID();
        $args = array( 'post_type' => 'camps',
                        'posts_per_page' => -1,
                        'tax_query' => $tax_query,
                        'post__not_in' => array($currentID)
                        );
        // run the query
        $loop = new WP_Query($args);
        // loop output
        if( $loop->have_posts() ) {
        while( $loop->have_posts() ) : $loop->the_post();
        $campImage = get_field('banner_image'); ?>
            <div class="col">
                <div class="listing-item">
                    <div class="image" style="background:url(<?php echo $campImage['url']; ?>);">
                        <h2 class="heading heading__sm heading__light"><?php the_title(); ?>
                    </div>
                    <div class="item"><i class="fas fa-credit-card"></i>From $<?php the_field('cost');?></div>
                    <div class="item"><i class="fas fa-map-marker-alt"></i><?php the_terms( $post->ID, 'destinations'); ?></div>
                    <!--<?php the_terms( $post->ID, 'company'); ?>-->
                    <div class="item"><?php the_field('short_description');?></div>
                    <a href="<?php the_permalink(); ?>">Learn More</a>
                </div>
            </div>
        <?php endwhile;}
        wp_reset_query();
        }?>
        </div>
    </div>
</div>

<?php endwhile;?>
</div><!--outer wrapper-->
<?php get_footer();?>
