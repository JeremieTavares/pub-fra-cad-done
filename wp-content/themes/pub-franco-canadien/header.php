<!DOCTYPE html>
<html lang="fr-ca">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
      <?php wp_body_open(); ?>
      <header>
            <nav id="navigation">
                  <?php
                  wp_nav_menu(
                        array(
                              'theme_location' => 'main-menu', // Mettre le nom qui a ete mis dans register_nav_menu
                              'menu_id' => 'primary-menu', // Le nom de l'ID du menu qui sera generer en HTML
                        )
                  );
                  ?>
            </nav>

            <h1 class="h1Accueil"><a class='homeLink' href="http://localhost/equipe-c">Le Pub <span class='homeLink blue'>Fra</span>nco <img class='imgCanada' src="http://localhost/equipe-c/wp-content/uploads/2022/08/canadian-leaf.png" alt=""> Can<span class='homeLink red'>adien</span></a></h1>

      </header>

      <div class="imgBanner gradiant">
            <h2>Reserver une table</h2>
            <a href="http://localhost/equipe-c/reservation/">Reserver</a>
      </div>