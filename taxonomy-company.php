<?php
/**
 * The template for displaying COMPANY taxonomy
 *
 * @package ode
 */
get_header();
$term = get_queried_object();?>

<!--HERO-->
<?php get_template_part("template-parts/carousel-hero"); ?>

<!--BODY--> 
<div class="container cols-offset3-18">
    <div class="col">
        <h2 class="heading heading__md heading__caps align-center mt2 mb2"><?php echo $term->name;?> Camps In the Okavango Delta</h2>
    </div>
    <div class="col">
        <div class="camp-summary full-width">            
            <?php
                $args = array(
                    'post_type' => 'camps',
                    'tax_query' => array(
                    'relation' => 'AND',
                        array(
                            'taxonomy' => 'company',
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
                            <div class="description"><?php the_field('description');?></div>
                            <a href="<?php the_permalink(); ?>" class="button">View <?php the_title(); ?></a>
                        </div>
                    </div>                        
                </div>         
            </div>

<?php endwhile; endif;?> 

</div>
    </div>
</div>

<div class="container cols-offset3-18">
    <div class="col">
        <h4 class="heading heading__md heading__caps align-center mt2 mb2">Overview</h4>
        <div class="description multi-col mb1"><?php the_field('description', $term);?></div>     
    </div>
</div>    


    <div class="map">
        <h4 class="heading heading__md heading__caps align-center mt2 mb2">Camp Locations</h4>
        <div class="" style="background:#a9c2a5; height:75vh;">MAP</div>     
    </div>

<div class="container cols-offset3-18">    
    <div class="col">
        <h4 class="heading heading__md heading__caps align-center mt2 mb2">Safaris Featuring <?php echo $term->name;?></h4>

        <div class="camp-summary full-width">
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
    <div class="camp-summary__item">
    <div class="container cols-12">
        <div class="col">
            <?php $safariImage = get_field('banner_image');?>
            <div class="image" style="background:url(<?php echo $safariImage['url']; ?>);">
                <h2 class="heading heading__sm heading__light"><?php the_title(); ?></h2>
            </div> 
        </div>
        <div class="col">
            <div class="content">
                <div class="camps">
                    <?php $safari_id = get_the_ID();
                    if( get_field('daily_activity', $safari_id) ) { while(has_sub_field('daily_activity', $safari_id)) { 
                        $post_objects = get_sub_field('daily_camp', $safari_id);
                        if( $post_objects ):
                            $post = $post_objects;
                            setup_postdata( $post ); ?>
                            <p class="destinations list"><i class="fas fa-map-marker-alt"></i><?php the_title(); ?></p>
                        <?php wp_reset_postdata(); 
                    endif; }} ?>
                </div>
                <div class="description"><?php the_field('short_description');?></div>
                <a href="<?php the_permalink($safari_id); ?>" class="button">Learn More</a>    
            </div>        
        </div>     
    </div>
</div><!--camp-summary-item-->
<?php endwhile; endif; 
	wp_reset_query();	 ?>





    
</div><!--camp-summary-->
    </div>
</div>

<?php get_footer();?>