<?php get_header(); ?>
<h1 class="h1Menu">Nos plats au menu</h1>
<div class="wrapper">


    <?php
    $args = array(
        'post_type' => 'menu', // Quel type de post on veut afficher
    );


    query_posts($args);
    if (have_posts()) {
        while (have_posts()) {
            the_post();

    ?>
            <div class="div_menu">
                <h2><?php the_title(); ?></h2>
                <p><strong>Description: </strong><?php the_field('description_du_plat'); ?></p>
                <p><strong>Prix: </strong><?php the_field('prix_du_plat'); ?>$</p>
                <img class='imgPlat' src="<?php the_field('image_du_plat') ?>" />
            </div>
    <?php
        }
    } else {
        echo "Pas d'article :'(";
    } ?>
</div>


<?php get_footer(); ?>