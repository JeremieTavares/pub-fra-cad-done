<?php
session_start();
/*
Plugin Name: Reservation insert
Description: Plugin to communicate with the file that submit the forms, this plugin gets the data submitted by the form and insert it in the database.
Author: Equipe c
*/


// ====================================================================================================================
// Une function de redirection pour renvoyer sur la page d'accueil
function redirectToHomePage($table_number, $nb_pers)
{
    echo '<script type="text/javascript">window.location.href = "http://localhost/equipe-c/reservation?table=' .$table_number .'&nbpers='.$nb_pers.'&reservation=success";</script>';
}
// ====================================================================================================================



// ====================================================================================================================
// ICI JE RECUPERE LES INFORMATIONS ENVOYER DEPUIS LE FORMULAIRE DES EVENEMENT ET
// J'ENREGISTRE LES INFORMATIONS DANS MA TABLE wp_event_subscriber
if (isset($_POST['submit'])) {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $table_number = $_POST['table_num'];
    $nb_pers = $_POST['nb_pers'];
    $telephone = $_POST['tel'];

    global $wpdb;

    $wpdb->query($wpdb->prepare(
        "INSERT INTO wp_table_reservation
                                (prenom, nom, table_number, nb_pers, telephone ) 
                                VALUES (%s, %s, %d, %d, %s)",
        $prenom,
        $nom,
        $table_number,
        $nb_pers,
        $telephone
    ));

    redirectToHomePage($table_number, $nb_pers);
}
// ====================================================================================================================




// ====================================================================================================================
if (isset($_POST['submitAdmin'])) {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $table_number = $_POST['table_num'];
    $nb_pers = $_POST['nb_pers'];
    $telephone = $_POST['tel'];

    global $wpdb;

    $wpdb->query($wpdb->prepare(
        "INSERT INTO wp_table_reservation
                                (prenom, nom, table_number, nb_pers, telephone ) 
                                VALUES (%s, %s, %d, %d, %s)",
        $prenom,
        $nom,
        $table_number,
        $nb_pers,
        $telephone
    ));

    redirectToAdminPage();
}
// ====================================================================================================================
