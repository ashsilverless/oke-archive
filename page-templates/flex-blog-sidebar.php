<?php
/**
 * ============== Template Name: Flex with Blog Sidebar
 *
 * @package oke
 */
get_header();
$term = get_queried_object();?>

<!-- ******************* Hero ******************* -->
<?php get_template_part("template-parts/left-hero"); ?>

<div class="outer-wrapper mt3">
    <div class="container cols-15-9 border-split">
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
                        <div class="toggle__item <?php the_sub_field('open');?>">
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

            <?php if( have_rows('call_to_action') ):
            while( have_rows('call_to_action') ): the_row();
            $ctaImage = get_sub_field('background_image');?>

            <?php if (get_sub_field('background_image')):?>

            <div class="cta mt5" style="background-image: url(<?php echo $ctaImage['url']; ?>);">
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
            <?php endif;?>
            <?php endwhile; endif;?>


        </div><!--col-->

        <div class="col">
            <div class="sub-menu-sticky">
                <h3 class="heading heading__sm heading__caps mb2">Latest News</h3>

                    <div class="wrapper-news">
                        <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $query = new WP_Query( array(
                        'posts_per_page' => 3,
                        'paged' => $paged,
                        'category_name' => 'news'
                    ) );
                    if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post(); ?>
                        <?php $image = get_field('banner_image');?>
                        <div class="item image-top">
                            <div class="image" style="background: url(<?php echo $image; ?>)"><a href="<?php the_permalink(); ?>"></a></div>
                            <div class="content">
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="heading heading__md"><?php the_title(); ?></h3>
                                </a>
                                <p class="date"><?php echo get_the_date("jS F Y"); ?></p>
                                <p><?php echo substr(wp_strip_all_tags(get_the_content()), 0, 80) . ""; ?> ...</p>
                                <a class="button button__standard" href="<?php the_permalink(); ?>">Read More</a>
                            </div>
                        </div>
                        <!--item-->
                        <?php endwhile;?>
                        <div class="pagination">
                            <?php echo paginate_links( array(
                                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                                'total'        => $query->max_num_pages,
                                'current'      => max( 1, get_query_var( 'paged' ) ),
                                'format'       => '?paged=%#%',
                                'show_all'     => false,
                                'type'         => 'plain',
                                'end_size'     => 1,
                                'mid_size'     => 1,
                                'prev_next'    => true,
                                'prev_text'    => sprintf( '<i class="fas fa-angle-left"></i>' ),
                                'next_text'    => sprintf( '<i class="fas fa-angle-right"></i>' ),
                                'add_args'     => false,
                                'add_fragment' => '',
                            ) );

                                    ?></div>
                        <? wp_reset_postdata(); endif; ?>
                    </div>
                    <!--wrapper-news-->

            </div>
        </div>
    </div>
</div><!--outer-wrapper-->

<?php get_footer();?>
