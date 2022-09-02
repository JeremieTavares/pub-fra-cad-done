<?php get_header(); ?>

<div class="wrapper-main">
    <h2 class="textCenter"><img class="imgPays" src="http://localhost/equipe-c/wp-content/uploads/2022/08/canada.jpg" alt=""> Bienvenue au pub Franco-Canadien ! <img  class="imgPays" src="http://localhost/equipe-c/wp-content/uploads/2022/08/france.png" alt=""></h2>

    <div>
        <h3 class="h3-accueil">Qui sommes nous?</h3>
        <p class="p-accueil">Opened in 2008, this isn’t the oldest establishment with skin in the pub game, but one visit to it and you’ll immediately know why the Burgundy Lion group has all but perfected this style of bar: Three floors high, equipped with an inner courtyard and a solarium for high tea in Montreal, football match screenings that position it as one of the best sports bars in Montreal and a massive whiskey selection alongside fresh pints and a solid English breakfast? How about events like cocktail competitions and fundraisers for local communities? Cheers, mate: This one’s our favourite in town right now for a classic pub experience with the right amount of bells and whistles.</p>
    </div>
    <?php
    if (is_front_page()) {
        $args = array(
            'post_type' => 'promotion', // Quel type de post on veut afficher
        );


        query_posts($args);
        if (have_posts()) {
            the_post();


    ?>

            <div class="div-promotion">
                <h2><?php the_title(); ?></h2>
                <p><?php the_content(); ?></p>
            </div>
    <?php
        }
    }
    ?>

    <div>
        <img class="imgAccueil" src="http://localhost/equipe-c/wp-content/uploads/2022/08/pubg.jpg" alt="">
    </div>


    <h2 class="textCenter">Les bieres vedettes de la semaine</h2>
    <div class="wrapper-accueil-biere">

        <?php
        $args = array(
            'post_type' => 'boisson',
            'posts_per_page'  => 2 // Quel type de post on veut afficher
        );


        query_posts($args);
        if (have_posts()) {
            while (have_posts()) {
                the_post();

        ?>
                <div class="div_menu">
                    <h2><?php the_title(); ?></h2>
                    <p><strong>Description: </strong><?php the_field('description_de_la_boisson'); ?></p>
                    <p><strong>Prix: </strong><?php the_field('prix_de_la_boisson'); ?>$</p>
                    <p><strong>Format: </strong><?php the_field('format'); ?>ml</p>
                    <img class='imgPlat' src="<?php the_field('image') ?>" />
                </div>
        <?php
            }
        } else {
            echo "Pas d'article :'(";
        } ?>
    </div>
</div>
<?php get_footer(); ?>