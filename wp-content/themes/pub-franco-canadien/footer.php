<footer>
    <span>Suivez-nous sur Facebook
        <a href="<?= get_option('url_facebook_id') ?>"><img src="<?= get_option('facebook_img_url') ?>" alt="logo-facebook" class="logoFacebook"></a>
    </span>
    <span>Nous joindre par telephone
    <a href="tel:<?= get_option('tel_id') ?>"><?= get_option('tel_id') ?></a>
    </span>

    <div class="footerGrid">
    <span>© Tous droit reservés</span>
    <h3 class=""><a class='homeLink' href="http://localhost/equipe-c">Le Pub <span class='homeLink blue'>Fra</span>nco <img class='imgCanada' src="http://localhost/equipe-c/wp-content/uploads/2022/08/canadian-leaf.png" alt=""> Can<span class='homeLink red'>adien</span></a></h3>
    <span>EquipeC - 2022</span>
    </div>
    
</footer>

<?php wp_footer() ?>
</body>

</html>