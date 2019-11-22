<?php
/**
 * ============== Template Name: Find A Safari Page
 *
 * @package oke
 */
get_header();?>

<!--HERO-->
<?php $postid = get_the_ID(); ?>
<?php get_template_part("template-parts/filter-hero-find"); ?>

<h3 class="heading heading__md heading__caps mt2 mb2 align-center">Your Safari Options</h3>
<div class="outer-wrapper">
<div id="Container" class="filter-wrapper">
  <div class="fail-message"><span>No items were found matching the selected filters</span></div>
<div class="container">
  <?php
      $args = array(
          'post_type' => 'itineraries',
/*          'tax_query' => array(
          'relation' => 'AND',
              array(
                  'taxonomy' => 'type',
                  'field' => 'slug',
                  'terms' => array( $term->slug )
              ),
          )*/
      );
      $query = new WP_Query( $args );

        if ( $query->have_posts() ): while ( $query->have_posts() ):$query->the_post();
        //Get cost as class
        $safaricost = get_field('cost');
        if ($safaricost < '15000'){
        $safaricost = "low";
        } elseif ($safaricost > '15000' && $safaricost < '20000'){
        $safaricost = "medium";
        } elseif ($safaricost > '20000'){
        $safaricost = "high";
        }
        //Get duration as class
        $safariduration = get_field('number_of_nights');
        if ($safariduration < '3'){
        $safariduration = "less-than-three";
        } elseif ($safariduration > '2' && $safariduration < '6'){
        $safariduration = "three-to-five";
        } elseif ($safariduration > '5' && $safariduration < '9'){
        $safariduration = "six-to-eight";
        } elseif ($safariduration > '8' ){
        $safariduration = "more-than-eight";
        }
        $focus = get_the_terms($post->ID,'focus');
        $focusslug = $focus[0];
        $safariImage = get_field('banner_image');
        ?>
        <div class="col mix <?php echo $focusslug->slug;?> <?php echo $safariduration;?> <?php echo $safaricost;?>">
            <div class="safari-options">
                <div class="container cols-12">
                    <div class="col">
                        <div class="image" style="background:url(<?php echo $safariImage['url']; ?>);">
                            <h2 class="heading heading__md heading__light heading__emphasis"><?php the_title(); ?></h2>
                        </div>
                    </div>
                    <div class="col">
                        <div class="meta">
                            <div class="item"><i class="fas fa-moon"></i><?php the_field('number_of_nights');?> Nights</div>
                            <div class="item"><i class="fas fa-credit-card"></i>From $<?php the_field('cost');?></div>
                        </div>
                        <div class="camps">
                            <?php if( have_rows('daily_activity') ): while( have_rows('daily_activity') ): the_row();
                               $dailycamp = get_sub_field('daily_camp');?>
                               <span><?php echo $dailycamp->post_title;?></span>
                            <?php endwhile; endif;?>
                        </div>
                        <div class="description"><?php the_field('short_description');?></div>
                        <a href="<?php the_permalink(); ?>" class="button">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; endif;?>
    </div>
</div>
</div><!--outer wrapper-->
<div class="filter-footer fullwidth">
    <h3 class="heading heading__md heading__caps heading__light">X Safaris Match Your Criteria</h3>
    <a href="">Adjust my filter</a>
</div>

    <?php if( have_rows('view_map_cta', $postid) ): ?>
        <?php while( have_rows('view_map_cta', $postid) ): the_row();
        $mapcatImage = get_sub_field('background_image'); ?>
        <div class="map-cta" style="background-image: url(<?php echo $mapcatImage['url']; ?>);">
            <div>
                <a href="/accommodation"><?php the_sub_field('text'); ?></a>
            </div>
        </div>
        <?php endwhile; endif; ?>
        <div class="container cols-offset3-18 mb5">
            <div class="col">
                <?php
                if( have_rows('safari_type_cta', 'options') ):
                while( have_rows('safari_type_cta', 'options') ): the_row();
                $ctaImage = get_sub_field('background_image');?>
                <div class="cta bespoke align-center" style="background:url(<?php echo $ctaImage['url']; ?>);">
                    <h4 class="heading heading__md heading__light heading__caps"><?php the_sub_field('heading');?></h4>
                    <?php the_sub_field('copy');?>
                    <?php $ctaform = get_sub_field('form');
                       if( $ctaform ):
                         foreach( $ctaform as $p ): // variable must NOT be called $post (IMPORTANT)
                           $cf7_id= $p->ID;
                           echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' );
                         endforeach;
                       endif; ?>

                    <?php endwhile; endif; ?>


                </div>
            </div>
        </div>
<?php get_footer();?>
