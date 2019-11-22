<?php
/**
 * ============== Template Name: Okavango
 *
 * @package oke
 */
get_header();?>

<!-- ******************* Hero ******************* -->
<?php if( have_rows('hero') ): while( have_rows('hero') ): the_row();
 $heroImage = get_sub_field('background_image');?>
<div class="hero hero__section-lead h100" style="background-image: url(<?php echo $heroImage['url']; ?>);">
    <div class="above-leader">
        <h3 class="heading heading__xl heading__caps heading__light">
            <?php the_sub_field('heading');?>
        </h3>
        <h2 class="heading heading__sm heading__light heading__alt">
            <?php the_sub_field('sub_heading');?>
        </h2>
    </div>
    <div class="hero-leader mb2">
        <div class="container grid-gap cols-8">
            <?php if( have_rows('leader') ):
            while( have_rows('leader') ): the_row();
            $leaderImage = get_sub_field('image');?>
                <div class="col">
                <div class="hero-leader__item">
                    <div class="image" style="background-image: url(<?php echo $leaderImage['url']; ?>);"></div>
                    <div class="content">
                         <h3 class="heading heading__lg inline-icon">
                           <sup>The</sup>
                           <?php the_sub_field('heading');?>
                           <?php $thisicon = get_sub_field( 'icon')["url"];
                           $thisicon   = explode("/wp-content/", $thisicon)[1];?>
                           <?php echo file_get_contents("./wp-content/" . $thisicon, FILE_USE_INCLUDE_PATH); ?>
                        </h3>
                       <p><?php the_sub_field('copy');?></p>
                       <a href="<?php the_sub_field('button_target');?>" class="button button__standard">
                           Read More
                       </a>
                    </div>
                </div>
            </div>
            <?php endwhile; endif;?>
        </div>
    </div>
</div>
<?php endwhile; endif;?>

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

<?php if( have_rows('image_panels') ):
while( have_rows('image_panels') ): the_row();
$panelImage = get_sub_field('image');?>
<div class="container fullwidth cols-12 image-panels <?php the_sub_field('align_panel');?>">
    <div class="col">
        <div class="image" style="background-image: url(<?php echo $panelImage['url']; ?>);"></div>
    </div>
    <div class="col">
        <div class="content">
            <h3 class="heading heading__md inline-icon">
                <sup>The</sup>
                <?php the_sub_field('heading');?>
                <?php $thisicon = get_sub_field( 'icon')["url"];
                $thisicon   = explode("/wp-content/", $thisicon)[1];?>
                <?php echo file_get_contents("./wp-content/" . $thisicon, FILE_USE_INCLUDE_PATH); ?>
            </h3>
            <p><?php the_sub_field('copy');?></p>
            <a href="<?php the_sub_field('target_link');?>" class="">Read More</a>
        </div>
    </div>
</div>
<?php endwhile; endif;?>

<?php if( have_rows('fullwidth_info_block') ):
while( have_rows('fullwidth_info_block') ): the_row();
$fullwidthImage = get_sub_field('background_image');?>
<div class="fullwidth-info-block" style="background-image: url(<?php echo $fullwidthImage['url']; ?>);">
    <div class="container cols-offset3-18 last mb5 pt5">
    <div class="col">
        <div class="container boxed-content last cols-16-8">
            <div class="col info-panel">
                <?php if( have_rows('info_panel') ):
                while( have_rows('info_panel') ): the_row(); ?>
                    <div class="heading-wrapper">
                        <?php get_template_part('template-parts/panel-icon');?>
                        <h3 class="heading heading__md">
                            <?php the_sub_field('title');?>
                        </h3>
                    </div>
                    <div class="content">
                        <p><?php the_sub_field('copy');?></p>
                        <a href="<?php the_sub_field('button_target');?>" class="button button__standard button__standard--fixed-width">
                           <?php the_sub_field('button_text');?>
                        </a>
                    </div>
                <?php endwhile; endif;?>
            </div>

        </div>
    </div>
    </div>
</div><!--fullwidth-info-block-->
<?php endwhile; endif;?>

<?php if( have_rows('lower_call_to_action') ):
while( have_rows('lower_call_to_action') ): the_row();
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
