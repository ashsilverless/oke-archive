<?php
/**
 * The template for displaying FOCUS taxonomy
 *
 * @package ode
 */
get_header();
$term = get_queried_object();?>

<!--HERO-->

<div class="" style="background:#a9c2a5; height:75vh; display: grid; align-content: center;text-align:center;">MAP</div>     

<div class="container cols-16-8 grid-gap">
    <div class="col pt3">
        <div class="pr15"><?php the_field('description', $term);?></div>
        <h2 class="heading heading__md heading__caps mt2 mb1">
            <?php echo $term->name;?> Focused Properties
        </h2>  
         <div class="camp-summary full-width mb5">          
            <?php
                $args = array(
                    'post_type' => 'camps',
                    'tax_query' => array(
                    'relation' => 'AND',
                        array(
                            'taxonomy' => 'focus',
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
        </div><!--camp-summary full-width-->

        <?php if( have_rows('call_to_action', $term) ): 
        while( have_rows('call_to_action', $term) ): the_row(); 
        $ctaImage = get_sub_field('background_image');?>   
            <div class="cta cta--focus" style="background-image: url(<?php echo $ctaImage['url']; ?>);">
                <div class="content">
                    <h3 class="heading heading__lg heading__light">
                        <?php the_sub_field('heading', $term);?>
                    </h3>
                    <p><?php the_sub_field('content', $term);?></p>
                    <a href="<?php the_sub_field('button_target');?>"><?php the_sub_field('button_text');?></a> 
                </div> 
            </div><!--cta focus-->
         <?php endwhile; endif;?> 
 
    </div>
    
    <div class="col pt2">
        <h2 class="heading heading__md heading__caps mt2 mb1">Other Property Types</h2>
        <div class="leaders focus">    
        <?php 
        $current_tax = get_queried_object_id();
        $taxterms = get_terms( 'focus', array( 
        'orderby' => 'name',
        'order'   => 'ASC',
        'exclude' => $current_tax
        ));
        if ( ! empty( $taxterms ) ){
            foreach ( $taxterms as $taxterm ) {
            $taxImage = get_field('banner_image', $taxterm);?>
            <div class="image" style="background:url(<?php echo $taxImage['url']; ?>);"></div>
            <h2 class="heading heading__sm heading__caps mt1">
                <?php echo $taxterm->name;?> Focused Properties
            </h2>
            <?php the_field('description', $taxterm);?>                   
            <a href="<?php echo $term_link = get_term_link( $taxterm ); ?>" class="button">View Properties</a>
        <?php  }
        }?>
        </div><!--leaders-focus-->
    </div>
</div>

<?php get_footer();?>