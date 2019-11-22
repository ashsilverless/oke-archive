<?php
/**
 * ============== Destinations Page
 *
 * @package oke
 */
get_header();
$term = get_queried_object();?>

<!-- ******************* Hero ******************* -->
<?php $heroImage = get_field('banner_image', $term);?>

<div class="hero standard h75" style="background-image: url(<?php echo $heroImage['url']; ?>);">
    <div class="container align-center">
		<div class="col lg-narrow">
		    <div class="hero__content">
                <h1 class="heading heading__lg heading__caps heading__light slow-fade">
                    <?php echo $term->name;?>
                </h1>
				<p class="heading__light heading__sm">
					<?php the_field('sub_heading', $term);?>
				</p>
		    </div>
		</div>
	</div>
</div><!--hero standard-->

<div class="outer-wrapper mt3">

    <div class="container cols-16-8 grid-gap">
        <div class="col">
            <div class="description camp">
                <?php the_field('description', $term);?>
            </div>
            <h3 class="heading heading__md heading__caps mt2 mb1">Accommodation in this Area</h3>

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
