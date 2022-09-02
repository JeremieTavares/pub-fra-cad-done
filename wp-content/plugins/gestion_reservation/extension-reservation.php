<?php
/*
Plugin Name: Gestion des reservation
Description: Pluggin for TP Final
Author: Equipe C
Version: 1.0
*/


// ====================================================================================================================
// Ceci lis l'url d'une page wordpress et regarde si ca macth, si cest le cas redirige vers cette page custom
add_filter('page_template', 'template_page_reservation');
function template_page_reservation($page_template)
{
    if (is_page('reservation')) {
        $page_template = dirname(__FILE__) . '/template/reservation.php';
    }
    return $page_template;
}
// ====================================================================================================================



// ====================================================================================================================
// Permet de generer le contenu/afficher des pages archive-php / 2ime manieres de faire
add_filter('archive_template', 'get_custom_post_type_template_reservation');
function get_custom_post_type_template_reservation($archive_template)
{
    global $post;
    $plugin_root_dir = WP_PLUGIN_DIR . '/gestion_reservation/';

    if (is_archive() && get_post_type($post) == 'reservation') {
        $archive_template = $plugin_root_dir . '/template/archive-reservation.php';
    }
    return $archive_template;
}
// ====================================================================================================================




// ====================================================================================================================
// Cette function permet de cree la table qui va gerer les enregistrement aux evenements
// Lors de l'activation du plugin cette function sera executé et la table sera cree en BD
function wp_table_reservation()
{
    global $wpdb;
    $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}table_reservation
                    (id INT AUTO_INCREMENT, 
                    table_number INT NOT NULL,
                    nb_pers INT NOT NULL,
                    prenom VARCHAR(255) NOT NULL, 
                    nom VARCHAR(255) NOT NULL,
                    telephone VARCHAR(20) NOT NULL,
                    courriel VARCHAR(255) NOT NULL,
                    PRIMARY KEY (id))");
}
register_activation_hook(__FILE__, 'wp_table_reservation');
// ====================================================================================================================




// ====================================================================================================================
function returnAllInscriptionForTable()
{
    global $wpdb;
    $reservation = $wpdb->get_results('SELECT *
                                   FROM wp_table_reservation wtr 
                                   ORDER BY wtr.table_number asc', OBJECT);
    return $reservation;
}
// ====================================================================================================================




// ====================================================================================================================
// J'ai cree une function qui selectionne tous les gens inscrit aux tables.
// J'ai decide de faire cela pour avoir une fonction reutilisable
function returnTableReservation()
{
    $reservation = returnAllInscriptionForTable();

    return returnTableWithNoReservation($reservation);
}
// ====================================================================================================================




// ====================================================================================================================
function returnTableWithNoReservation($reservation)
{
    $selectOptions = [];
    $count = count($reservation);
    $table = [1, 2, 3, 4, 5, 6, 7, 8];

    for ($i = 0; $i < $count; $i++) {
        $tableNbr = (int) $reservation[$i]->table_number;

        if (((int)$key = array_search($tableNbr, $table, true)) !== false)
            unset($table[$key]);
    }

    foreach ($table as $value)
        array_push($selectOptions, "<option value='$value'>Table $value</option>");

    return $selectOptions;
}
// ====================================================================================================================






// ====================================================================================================================
// ajoute un « hook » qui cree un menu dans le panneau administrateur
// NOM DU HOOK / FUNCTION A CALL - cette function devra contenir une function interne qui est add_menu_page()
add_action('admin_menu', 'addMenuForEventSubs');


// C'est la fonction addMenu() identifiée dans le hook précédent. Cette function defini les attributs de ce menu
function addMenuForEventSubs()
{
    add_menu_page(
        'Reservation', //Titre de la page menu
        'Reservation', //Titre du menu
        'manage_options', //Quel fonctionnalitees peut t'il faire
        'mes_options_for_event_subs', // Slug du menu
        'displayTableForRegisteredEventsUsers' // Function a call qui gere le menu/affiche le contenu dans le menu/ ou function qui traite ce que le menu fera
    );
}

//  FUNCTION QUI CONTIENT LES CHAMPS DU FORM PERMETTANT LA MODIFICATION
function displayTableForRegisteredEventsUsers()
{
    echo '<h1> Client ayant reservé une table</h1>';

    $results = returnAllInscriptionForTable();

?>
    <table class='formEvents'>
        <thead>
            <th>Table #</th>
            <th>Nombre de personne</th>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Telephone</th>
            <th>Supprimer</th>
        </thead>
        <tbody>
            <?php
            foreach ($results as $value1) {
            ?>
                <tr>
                    <td class='formEventsTd'><?= $value1->table_number ?></td>
                    <td class='formEventsTd'><?= $value1->nb_pers ?></td>
                    <td class='formEventsTd'><?= $value1->prenom ?></td>
                    <td class='formEventsTd'><?= $value1->nom ?></td>
                    <td class='formEventsTd'><?= $value1->telephone ?></td>
                    <td class='formEventsTd'>
                        <form action="<?= plugin_dir_path('reservation-delete.php') ?>" method="POST">
                            <input type="hidden" name="event-id" value="<?= $value1->id ?>">
                            <input type="hidden" name="delete" value="event">
                            <button type="submit" class="btnDelete"><span class="xDelete">X</span></button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <form action="<?= plugin_dir_path('reservation-delete.php') ?>" method="POST" class="formDeleteAll">
        <input type="hidden" name="deleteAll" value="event">
        <button type="submit" class="btnDelete"><span class="xDeleteAll">Supprimer toutes les reservations</span></button>
    </form>


    <h1 class="h1ReservationPanelAdmin">Reserver une table</h1>
    <?php
    $reservation = returnTableReservation();

    ?>

    <form action="<?= plugin_dir_path('reservation-insert.php') ?>" method="POST">
        <div class="d-flex-col">
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

            <input type="submit" value="Confirmer" name="submitAdmin" id="submit">
        </div>
    </form>
    <?php

    ?>
    </div>


    <script>
        const btnDelete = document.querySelectorAll('.btnDelete')

        for (const btn of btnDelete) {
            btn.addEventListener('click', (e) => {
                if (!confirm('Etes vous certain de vouloir supprimer?')) {
                    e.preventDefault()
                }
            })
        }
    </script>
<?php
}
// ====================================================================================================================