<?php
$term = get_queried_object();
$heroImage = get_field('banner_image');?>

<div class="hero h75" style="background-image: url(<?php echo $heroImage['url']; ?>); background-color: <?php echo $heroColor; ?>;">
    <div class="container cols-offset3-18">
		<div class="col">
		    <div class="hero__content">
                <div class="copy align-center pl5 pr5">
                    <h1 class="heading heading__lg heading__caps heading__light"><?php echo $term->name;?> Safaris</h1>
                    <p class=""><?php echo term_description($term_id, $term);?></p>
                </div>
                <div class="filter-header">
                    <form class="controls" id="Filters">
                        <div class="container cols-8">
                            <div class="col filter-header__item">
                                <fieldset class="filter-group checkboxes">
                                    <h4 class="heading heading__sm heading__caps align-center">COST</h4>
                                    <label class="checkbox"><input type="checkbox" value=".low"/>
                                        Low<span class="checkmark"></span>
                                    </label>
                                    <label class="checkbox"><input type="checkbox" value=".medium"/>
                                        Medium<span class="checkmark"></span>
                                    </label>
                                    <label class="checkbox"><input type="checkbox" value=".high"/>
                                        High<span class="checkmark"></span>
                                    </label>
                                </fieldset>
                            </div>
                            <div class="col filter-header__item">
                                <fieldset class="filter-group checkboxes">
                                    <h4 class="heading heading__sm heading__caps align-center">Nights</h4>
                                    <label class="checkbox"><input type="checkbox" value=".less-than-three"/>
                                        Less than 3<span class="checkmark"></span>
                                    </label>
                                    <label class="checkbox"><input type="checkbox" value=".three-to-five"/>
                                        3 - 5<span class="checkmark"></span>
                                    </label>
                                    <label class="checkbox"><input type="checkbox" value=".six-to-eight"/>
                                        6 - 8<span class="checkmark"></span>
                                    </label>
                                    <label class="checkbox"><input type="checkbox" value=".more-than-eight"/>
                                        More than 8<span class="checkmark"></span>
                                    </label>
                                </fieldset>
                            </div>
                            <div class="col filter-header__item">
                                <fieldset class="filter-group checkboxes">
                                    <h4 class="heading heading__sm heading__caps align-center">Focus</h4>
                                    <label class="checkbox"><input type="checkbox" value=".land"/>
                                        Land<span class="checkmark"></span>
                                    </label>
                                    <label class="checkbox"><input type="checkbox" value=".water"/>
                                        Water<span class="checkmark"></span>
                                    </label>
                                    <label class="checkbox"><input type="checkbox" value=".water-land"/>
                                        Water & Land<span class="checkmark"></span>
                                    </label>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                    <div id="Reset" class="button">Clear Filters</div>
                </div>

            </div>
		</div>
	</div>
</div><!--hero-->
