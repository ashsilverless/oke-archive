<?php
/**
 * ============== Template Name: Okavango Sub Page
 *
 * @package oke
 */
get_header();
$term = get_queried_object();?>

<!-- ******************* Hero ******************* -->
<?php get_template_part("template-parts/left-hero"); ?>
<div class="outer-wrapper mt3">
    <div class="container cols-offset-3-12-6 grid-gap">
        <div class="col">
            <?php
            if( have_rows('flexible_layout') ):
            while ( have_rows('flexible_layout') ) : the_row();

                if( get_row_layout() == 'text_module' ):?>
                <div class="text-module mb3">
                    <h3 class="heading heading__md heading__caps">
                        <?php the_sub_field('heading');?>
                    </h3>
                    <?php the_sub_field('copy');?>
                </div><!--text-module-->

            <?php elseif( get_row_layout() == 'gallery_module' ):
                $images = get_sub_field('images');
                if( $images ): ?>
                    <div class="gallery mb3">
                        <?php foreach( $images as $image ): ?>
                            <a href="<?php echo $image['url']; ?>" class="lightbox-gallery"  alt="<?php echo $image['alt']; ?>" style="background-image: url(<?php echo $image['url']; ?>);"><!--<?php echo $image['caption']; ?>--></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            <?php elseif( get_row_layout() == 'number_counters' ):?>
                <?php if (get_sub_field('number_heading')):?>
                    <h2 class="heading heading__md heading__caps mb1"><?php the_sub_field('number_heading');?></h2>
                <?php endif;?>
                <?php the_sub_field('number_copy');?>
                <div class="wrapper--number-counter mt3 mb3">
                    <?php if( have_rows('number_counter_item') ):
                    while ( have_rows('number_counter_item') ) : the_row();?>
                        <div class="number-counter">
                            <div class="number-counter__number" data-count="<?php the_sub_field('total_number');?>">0</div>
                            <div class="number-counter__text">
                                <?php the_sub_field('number_text');?>
                            </div>
                        </div>
                    <?php endwhile; endif;?>
                </div>

            <?php elseif( get_row_layout() == 'carousel_module' ):?>
                <div class="carousel_module owl-carousel owl-theme mb3">
                    <?php
                    $images = get_sub_field('images');
                    if( $images ):
                    foreach( $images as $image ): ?>
                        <div class="carousel_module__item" style="background:url(<?php echo $image; ?>)"></div>
                    <?php endforeach; endif; ?>
                </div>

            <?php elseif( get_row_layout() == 'toggle_module' ):?>
                <?php if (get_sub_field('heading')):?>
                    <h3 class="heading heading__md heading__caps mb1">
                        <?php the_sub_field('heading');?>
                    </h3>
                    <?php the_sub_field('intro');?>
                <?php endif;?>

                <div class="toggle mb3">
                    <?php if( have_rows('items') ):
                    while ( have_rows('items') ) : the_row();?>
                        <div class="toggle__item">
                            <p class="heading"><?php the_sub_field('heading');?>
                                <?php get_template_part("template-parts/arrow-large");?>
                            </p>
                            <div class="content <?php if (get_sub_field('image')) echo 'has-image';?>">
                                <?php if (get_sub_field('image')):
                                $toggleImage = get_sub_field('image');?>
                                    <div class="image" style="background:url(<?php echo $toggleImage; ?>)"></div>
                                <?php endif;?>
                                <div class="inner">
                                    <?php the_sub_field('copy');?>
                                    <?php if (get_sub_field('button_text')):?>
                                        <a href="<?php the_sub_field('button_target');?>" class="button button__standard"><?php the_sub_field('button_text');?></a>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; endif; ?>
                </div>
                <?php endif;
            endwhile; endif;?>
        </div><!--col-->

        <div class="col">
<?php if (is_page('land')) {?>
    <div class="sticky">
        <h2 class="heading heading__md heading__caps mb1">Concessions in The Okavango Delta</h2>
        <?php
        $terms = get_terms( array(
            'taxonomy' => 'destinations',
            //'hide_empty' => false,
        ) );
        //$number = 1;
        foreach ($terms as $term):
        $destinationImage = get_field('banner_image', $term);
        ?>
        <div class="destination-summary__item mb1">
        <a href="<?php echo $term_link = get_term_link( $term ); ?>">
                    <h2 class="heading heading__xs heading__caps heading__body heading__light"><?php echo $term->name;?></h2>

                <div class="image" style="background:url(<?php echo $companyImage['url']; ?>);"></div>
                <?php the_field('short_description', $term);?>
        </a>
        </div>
        <?php
        //$number++;
        endforeach;?>
    </div>
<?php } else {?>
            <h2 class="heading heading__md heading__caps mb1">Featured Property</h2>
            <?php $post_object = get_field('featured_property');
            if( $post_object ):
            	$post = $post_object;
            	setup_postdata( $post );
                $campImage = get_field('banner_image', $post);?>
                <div class="camp-summary featured_property">
                    <div class="camp-summary__item">
                        <a href="<?php the_permalink(); ?>">
                            <div class="image" style="background-image: url(<?php echo $campImage['url']; ?>);">
                                <h2 class="heading heading__sm heading__light"><?php the_title(); ?></h2>
                            </div>
                        </a>
                        <div class="location">
                            <i class="fas fa-map-marker-alt"></i><?php the_terms( $post->ID, 'destinations'); ?>
                        </div>
                        <div class="description">
                            <?php the_field('short_description', $post); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="button button__standard">Learn More</a>
                        <a href="/accommodation" class="button button__standard--alt">See All Properties</a>
                    </div>
                </div>
                <?php wp_reset_postdata();?>
            <?php endif; ?>

            <h2 class="heading heading__md heading__caps mt2 mb1"><?php the_field('side_heading');?></h2>
            <?php if (get_field('side_image')):?>
                <div class="side-panel mb3">
                    <div class="image" style="background-image: url(<?php the_field('side_image'); ?>);">
                        <h2 class="heading heading__sm heading__light"><?php the_field('image_text');?></h2>
                    </div>
                    <div class="content">
                        <?php the_field('side_copy');?>
                    </div>
                    <a href="<?php the_field('side_button_target');?>" class="button button__standard"><?php the_field('side_button_text');?></a>
                    <a href="" class="button button__standard button__standard--alt"><?php the_field('side_button_text');?></a>
                </div>
            <?php endif;?>
            <?}?>
        </div>
    </div>
</div><!--outer-wrapper-->
<?php if( have_rows('call_to_action') ):
while( have_rows('call_to_action') ): the_row();
$ctaImage = get_sub_field('background_image');?>
<div class="cta cta--fullwidth" style="background-image: url(<?php echo $ctaImage['url']; ?>);">
    <div class="container align-center pt5 pb3">
        <div class="col">
            <div class="content lg-narrow">
                <h3 class="heading heading__md heading__caps heading__light"><?php the_sub_field('heading');?></h3>
                <p><?php the_sub_field('content');?></p>
                <a href="<?php the_sub_field('button_target');?>" class="button button__ghost"><?php the_sub_field('button_text');?></a>
            </div>
        </div>
    </div>
</div><!--cta fullwidth-->
<?php endwhile; endif;?>
<?php get_footer();?>
