<?php
$term = get_queried_object();
$heroImage = get_field('banner_image', $term);?>
<div class="scrolled-filter">
    <div class="container">
        <div class="col">
            <?php get_template_part("template-parts/type-filter"); ?>
        </div>
    </div>
</div>
<div class="hero h75" style="background-image: url(<?php echo $heroImage['url']; ?>); background-color: <?php echo $heroColor; ?>;">
    <div class="container cols-offset3-18">
		<div class="col">
		    <div class="hero__content">
                <div class="copy align-center pl5 pr5">
                    <h1 class="heading heading__lg heading__caps heading__light"><?php echo $term->name;?> Safaris</h1>
                    <p class=""><?php echo term_description($term_id, $term);?></p>
                </div>
                <?php get_template_part("template-parts/type-filter"); ?>
            </div>
		</div>
	</div>
</div><!--hero-->
<?php get_template_part("template-parts/filtered-result"); ?>
