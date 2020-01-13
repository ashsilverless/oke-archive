<?php if ( is_page_template( 'page-templates/accommodation.php' ) ) {?>
<div class="popup-image wrapper">
    <div class="open trigger"><i class="fas fa-map-marked-alt"></i></div>
    <div class="profile-image reveal">
        <?php get_template_part('inc/img/small-map');?>
        <div class="close-trigger"><i class="far fa-times-circle"></i></div>
    </div>
</div>
<?php } else {}?>

<div class="overlay-filter">
    <h4 class="heading heading__sm heading__light">Water State</h4>
    <div class="layer-buttons">
        <div class="layer-buttons__item off active">Off</div>
        <div class="layer-buttons__item low">Low</div>
        <div class="layer-buttons__item high">High</div>
    </div>
</div>
