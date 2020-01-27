<?php

if( get_field('hero_type') == 'image' ):
	$heroImage = get_field('hero_background_image');
elseif ( get_field('hero_type') == 'color' ):
	$heroColor = get_field('hero_background_colour');
endif;

if( get_field('hero_type') !== 'slider'):

?>

<div class="hero home <?php the_field('hero_height');?>" style="background-image: url(<?php echo $heroImage['url']; ?>); background-color: <?php echo $heroColor; ?>;">

    <div class="container cols-3-12-6-3">
        <div class="col"></div>
		<div class="col">
		    <div class="hero__content">
                <div class="inner-section">
                    <h1 class="heading heading__md heading__light mt0 mb0"><em><?php the_field('hero_copy');?></em></h1>
                </div>
                <div class="inner-section">
                    <?php get_template_part('inc/img/ode', 'logo-top');?>
                    <?php get_template_part('inc/img/ode', 'logo-bottom');?>
                </div>
                <div class="inner-section">
                    <h2 class="heading heading__lg heading__light mt0 mb0 slow-fade"><em>
                        <?php the_field('hero_heading');?></em>
                    </h2>
                </div>
               <div class="buttons">
                   <a href="#explore"  class="explore">Explore Now</a>
                   <a href="/enquire">Enquire</a>
               </div>
		    </div>
		</div>
	</div>

</div><!--hero-->

<?php endif;?>
