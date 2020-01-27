<?php
/**
 * ============== Template Name: News Page
 *
 * @package oke
 */
get_header();
$term = get_queried_object();?>

<!-- ******************* Hero ******************* -->
<?php get_template_part("template-parts/left-hero"); ?>
<div class="outer-wrapper mt3">
    <div class="container cols-16-8 grid-gap">
        <div class="col">
            <div class="wrapper-news">
                <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $query = new WP_Query( array(
            	'posts_per_page' => 5,
            	'paged' => $paged,
            	'category_name' => $category
            ) );
            if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php $image = get_field('banner_image');?>
                <div class="item">
                    <div class="image" style="background: url(<?php echo $image; ?>)"><a href="<?php the_permalink(); ?>"></a></div>
                    <div class="content">
                        <a href="<?php the_permalink(); ?>">
                            <h3 class="heading heading__md"><?php the_title(); ?></h3>
                        </a>
                        <p class="date"><?php echo get_the_date("jS F Y"); ?></p>
                        <p><?php echo substr(wp_strip_all_tags(get_the_content()), 0, 200) . "<span></span>"; ?></p>
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
        <!--col-->

        <div class="col">
            <h2 class="heading heading__md mb1">Specials</h2>
            <?php
            $loop = new WP_Query( array(
                'post_type' => 'camps',
                'posts_per_page' => 3,
                'orderby'   => 'rand'
            ) );
            if ( $loop->have_posts() ) :
                while ( $loop->have_posts() ) : $loop->the_post();?>
            <div class="safari-summary">
                <?php $safariImage = get_field('banner_image');?>
                <div class="image" style="background:url(<?php echo $safariImage['url']; ?>);">
                    <h2 class="heading heading__md heading__light"><?php the_title(); ?></h2>
                    <span><?php the_terms( $post->ID, 'destinations');?></span>
                </div>
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
                <a href="<?php the_permalink($safari_id); ?>" class="button button__standard--alt">See More</a>
            </div>
            <?php endwhile; endif;?>
        </div>
    </div>
</div>
<!--outer-wrapper-->



<?php if( have_rows('call_to_action') ):
while( have_rows('call_to_action') ): the_row();
$ctaImage = get_sub_field('background_image');?>

<?php if (get_sub_field('background_image')):?>

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
</div>
<!--cta fullwidth-->
<?php endif;?>
<?php endwhile; endif;?>

<?php get_footer();?>
