<footer>
    <div class="container-footer">
        <div class="part-up">
            <section class="category">
                <h2 data-aos="fade-right" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">Catégories</h2>
                <ul>
                    <li data-aos="fade-right" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1200"> <a href="index.php"> Accueil </a></li>
                    <li data-aos="fade-right" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1400"> <a href="./view/planning.php"> Planning </a></li>
                </ul>
            </section>
            <section class="link">
                <h2 data-aos="fade-left" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">Liens</h2>
                <ul>
                    <li data-aos="fade-left" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1400"> <a href="./view/reservation-form.php"> Reserver une salle </a></li>
                    <?php
                    if (!isset($_SESSION['user'])) { ?>
                        <li data-aos="fade-left" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1400"> <a href="./view/connexion.php"> Connexion </a></li>
                        <li data-aos="fade-left" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1600"> <a href="./view/inscription.php"> Inscription </a></li>
                    <?php }
                    ?>
                    <li data-aos="fade-left" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1600"> <a href="./view/profil.php"> Profil </a></li>
                </ul>
            </section>
        </div>
        <hr>
        <div class="part-down">
            <section class="social">
                <li data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000"><button class="facebook"><a href="#"><img src="https://img.icons8.com/ios/30/000000/facebook--v1.png" alt="social" width="30px"></a></button></li>
                <li data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1200"><button class="twitter"><a href="#"><img src="https://img.icons8.com/ios/30/000000/twitter--v1.png" alt="social" width="30px"></a></button></li>
                <li data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1400"><button class="instagram"><a href="#"><img src="https://img.icons8.com/ios/30/000000/instagram-new--v1.png" alt="social" width="30px"></a></button></li>
                <li data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1600"><button class="github"><a href="https://github.com/hugo-chabert/reservation-salles"><img src="https://img.icons8.com/ios-glyphs/30/000000/github.png" alt="social" width="30px"></a></button></li>
            </section>
        </div>
    </div>
</footer>