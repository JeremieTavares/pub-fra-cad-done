<?php
/*
Plugin Name: Reservation delete
Description: Plugin to communicate with the file that submit the forms to delete a registered user from an event, this plugin gets the data submitted by the form and delete it in the database.
Author: Equipe c
*/



// ====================================================================================================================
// Une function de redirection pour renvoyer sur la page de gestions des gens inscrits aux evenements (Admin)
function redirectToAdminPage()
{
    echo '<script type="text/javascript">window.location.href = "http://localhost/equipe-c/wp-admin/admin.php?page=mes_options_for_event_subs";</script>';
}
// ====================================================================================================================





// ====================================================================================================================
// ICI JE REGARDE SI JAI RECU UN ACTION DE SUPPRESSION POUR LES GENS INSCRIT A UN EVENEMENT
if (isset($_POST['delete']) && $_POST['delete'] == 'event') {
    $id = $_POST['event-id'];
    $table_name = 'wp_table_reservation';
    $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = $id"));
    redirectToAdminPage();
}
// ====================================================================================================================



// ====================================================================================================================
// ICI JE REGARDE SI JAI RECU UN ACTION DE SUPPRESSION POUR LES GENS INSCRIT A UN EVENEMENT
if (isset($_POST['deleteAll']) && $_POST['deleteAll'] == 'event') {
    $table_name = 'wp_table_reservation';
    $wpdb->query($wpdb->prepare("DELETE FROM $table_name"));

    redirectToAdminPage();
}
// ====================================================================================================================

