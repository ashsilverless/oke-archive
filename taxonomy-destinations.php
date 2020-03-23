<?php
/**
 * ============== Destinations Page
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
            <div class="description camp">
                <?php the_field('description', $term);?>
            </div>

         <div class="camp-summary full-width mb5">
            <?php
                $args = array(
                    'post_type' => 'camps',
                    'tax_query' => array(
                    'relation' => 'AND',
                        array(
                            'taxonomy' => 'destinations',
                            'field' => 'slug',
                            'terms' => array( $term->slug )
                        ),
                    )
                );
                $query = new WP_Query( $args );
                if ( $query->have_posts() ):?>
                    <h3 class="heading heading__md heading__caps mt2 mb1">Accommodation in this Area</h3>

                <?php while ( $query->have_posts() ):
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
                                <div class="description"><?php the_field('short_description');?></div>
                                <a href="<?php the_permalink(); ?>" class="button">View <?php the_title(); ?></a>
                            </div>
                        </div>
                    </div>
                    </div><!--item-->
                <?php endwhile; endif;?>
        </div><!--camp-summary-->

        </div><!--col-->
        <div class="col">
            <h3 class="heading heading__md heading__caps mb1">Other Areas To Explore</h3>
            <?php
            $catID = get_queried_object_id();
            $destterms = get_terms( array(
                'taxonomy' => 'destinations',
                'hide_empty' => true,
                'exclude' => $catID
            ) );
            foreach ($destterms as $destterm):?>
            <div class="col mb2">
                <?php $destImage = get_field('banner_image', $destterm);?>
                <a href="<?php echo get_term_link($destterm->slug, $destterm->taxonomy);?>" class="image-leader">
                    <div class="image" style="background:url(<?php echo $destImage['url']; ?>);">
                        <h2 class="heading heading__md heading__light heading__emphasis">
                            <?php echo $destterm->name;?>
                        </h2>
                    </div>
                </a>
            </div>
            <?php endforeach;?>
        </div><!--col-->

    </div>
</div><!--outer-wrapper-->

<?php get_footer();?>
