<?php include ('inc/init.inc.php') ?>
<?php
if(!isset($_SESSION['pseudo'])){
    header('location:connexion.php');
}
?>
<?php include ('inc/header.inc.php') ?>

<div id="conteneur">
    <div id="message_tchat">
        <?php
        echo '<h2>connecté en tant que : ' . $_SESSION['pseudo'] . '</h2>';

        //récupération des messages de la BDD
        $res = $pdo->query("SELECT d.id_dialogue, m.pseudo, m.civilite, d.message, date_format(d.date, '%H:%i:%s') as heure, date_format(d.date, '%d/%m/%Y') as datefr
            FROM dialogue d
            LEFT JOIN membre m ON m.id_membre=d.id_membre
            ORDER BY d.date");
        $dialogues = $res->fetchAll(FETCH_ASSOC);
        foreach ($dialogues as $dial){
            echo '<div>';
            print_r($dial);
            echo '</div>';
        }

        ?>
    </div>
    <div id="liste_membre_connecte">
        <?php
        $res = $pdo->query("SELECT * FROM membre");
        $membres = $res->fetchAll(FETCH_ASSOC);
        ?>
    </div>

    <div class="clear"></div>
    <div id="smiley">

    </div>
    <div id="formulaire_tchat">

    </div>
</div>



<?php include ('inc/footer.inc.php') ?>
