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
<!--BODY-->

<div class="container grid-gap cols-8-16">
    <div class="col">
        <div class="sidebar mb5">
            <h4 class="heading heading__md heading__light heading__caps align-center">At A Glance</h4>
            <div class="detail-wrapper">
                <ul>
                    <li><span class="title">Duration</span><span class="detail"><?php the_field('number_of_nights');?> Nights</span></li>
                    <li><span class="title">Type     </span><span class="detail"><?php the_terms( $post->ID, 'type'); ?></span></li>
                    <li><span class="title">Cost</span><span class="detail">From $<?php the_field('cost');?></span></li>
                </ul>
            </div>
            <div class="destination-summary">
                <div class="heading">Destinations</div>
                <?php if( have_rows('destinations') ): while( have_rows('destinations') ): the_row(); ?>
                    <div class="destination-summary__item"><?php the_sub_field('location');?></div>
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
                            <h2 class="heading heading__sm heading__light"><?php the_title(); ?>
                        </div>
                    	<div class="see-more">See More</div>
                    	<div class="expanding-panel">
                            <?php the_field('short_description');?>
                            <a href="<?php the_permalink(); ?>" class="button">View <?php the_title(); ?></a>
                    	</div>
                	</div>
                <?php wp_reset_postdata(); endif; 
            endwhile; endif;?>    
            </div><!--camp-summary-->
        </div><!--sidebar-->
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
                    	<p class="heading"><?php the_sub_field('heading');?> - <?php the_title(); ?>
                        	<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
    	 viewBox="0 0 19.5 40" style="enable-background:new 0 0 19.5 40;" xml:space="preserve">
    <path class="st0" d="M19.5,20L0,0c0,0,6,11,6,20S0,40,0,40L19.5,20z"/>
    </svg>
                    	</p>
                    	<div class="content">
                        	<?php the_sub_field('description');?>
                    	</div>
                    </div>
            <?php wp_reset_postdata(); 
            endif; 
        endwhile; endif;?>   
    </div><!--main-->
</div>

<?php endwhile; 
get_footer();?>