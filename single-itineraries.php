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
<?php get_template_part("template-parts/floating-heading"); ?>
    <div class="container grid-gap cols-8-13">
        <div class="col">
            <div class="sidebar">
                <h2 class="heading heading__md heading__light heading__caps align-center"><i class="fas fa-info info-panel"></i><?php the_title();?></h4>
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
                <p class="heading__light heading__caps align-center mb1">Featured Properties</p>
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
                        <?php if (get_sub_field('image')):?>
                            <img src="<?php the_sub_field('image');?>"/>
                            <?endif;?>
                        <?php the_sub_field('description');?>
                    </div>
                </div>
                <?php wp_reset_postdata();
            endif;
                endwhile; endif;?>
                <h3 class="heading heading__md heading__caps mt3 mb1">Map View</h3>
                <div class="itinerary-map">
                	<?php get_template_part("template-parts/itinerary-map"); ?>
                </div>
            </div>
            <!--main-->
            <div class="enquire-cta mt5">
                <i class="fas fa-comments"></i>
                <h3 class="heading heading__lg">Book This Safari</h3>
                <p>At Okavango Delta Explorations we specialise in crafting safaris to this unique ecosystem.</p>
                <p>Get in touch to begin your Okavango Delta Exploration</p>
                <a href="" class="button button__large centered mt1">Enquire Now</a>
            </div>
                <?php if( get_field('extensions') ): ?>
                    <h3 class="heading heading__md heading__caps mt3 mb1">Extensions to this safari</h3>
                <?php endif;?>
                <?php $post_objects = get_field('extensions');
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
        <?php endwhile;?>
    </div>
    <!--outer-wrapper-->
    <?php get_footer();?>
