<?php get_header();
if (have_posts()) {
    while (have_posts()) {
        the_post();

?>

        <div class="divReservation">
            <h1 class="textCenter"><?php the_title(); ?></h1>

    <?php
    }
}
    ?>

    <!-- <h1>Reserver une table</h1> -->
    <?php
    $reservation = returnTableReservation();

    if (isset($_GET['reservation']) && $_GET['reservation'] === 'success') {
        echo '<span class="sessionSuccess">Votre reservation pour la table ' . $_GET['table'] . ' pour ' . $_GET['nbpers'] . ' est confirmé. Merci !</span>';
    }
    ?>
        </div>
        <form action="<?= plugin_dir_path('reservation-insert.php') ?>" method="POST">
            <div class="formEventRegister">
                <div class="d-flex-col formReservationPublic">
                    <label for="prenom">Prenom:</label>
                    <input type="text" name="prenom" id="prenom" required>

                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom" required>

                    <label for="table_num">Numero de table:</label>
                    <select name="table_num" id="table_num">
                        <?php foreach ($reservation as $value) {
                            echo $value;
                        } ?>
                    </select>


                    <label for="nb_pers">Nombre de personne:</label>
                    <select name="nb_pers" id="nb_pers">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>


                    <label for="tel">Telephone:</label>
                    <input type="tel" name="tel" id="tel" required>

                    <input type="submit" value="Confirmer" name="submit" id="submit">
                </div>
        </form>


        <?php get_footer(); ?>