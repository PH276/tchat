<?php require_once ('inc/init.inc.php') ?>
<?php
if (isset($_POST['connexion'])){
    $resultat = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
    $membre = $resultat->fetch(PDO::FETCH_ASSOC);
    debug ($_SERVER);

    if ($resultat->rowCount() == 0){
        $pdo->query("INSERT INTO membre (pseudo, civilite, ville, date_de_naissance, ip, date_connexion) VALUE (
            '$_POST[pseudo]',
            '$_POST[civilite]',
            '$_POST[ville]',
            '$_POST[date_de_naissance]',
            '$_SERVER[REMOTE_ADDR]',"
            . time().

            ")");
            $id_membre = $pdo->lastInsertId();
            echo $id_membre;
        $msg .= "Vous n'êts pas inscrit";
    }elseif ($resultat->rowCount() > 0 && $membre['ip'] == $_SERVER[REMOTE_ADDR]) {
        $pdo->exec("UPDATE membre SET date_connexion=".time()." WHERE id_membre= $membre[id_membre]");
        $id_membre = $membre['id_membre'];
    } else{
        $msg .= '<p class="erreur">Ce pseudo  existe déjà</p>';
    }

if (!empty($msg)){
    $_SESSION['id_membre'] = $id_membre;
    $_SESSION['civilite'] = $_POST['civilite'];
    $_SESSION['pseudo'] = $_POST['pseudo'];
    header('location:index.php');
}
 ?>
<?php require_once ('inc/header.inc.php') ?>

<form class="" action="" method="post">

    <fieldset>

        <label for="pseudo">Pseudo : </label>
        <input id="pseudo" type="text" name="pseudo" value=""><br><br>

        <label for="civilite">Civilite : </label>
        <select  name="civilite">
            <option value="m">Homme</option>
            <option value="f">Femme</option>
        </select><br><br>

        <label for="ville">Ville  : </label>
        <input id="ville" type="text" name="ville" value=""><br><br>

        <label for="date_de_naissance">Date de naissance : </label>
        <input id="date_de_naissance" type="date" name="date_de_naissance" value=""><br><br>

        <input id="pseudo" type="submit" name="connexion" value="connexion"><br>


    </fieldset>
</form>


<?php require_once ('inc/footer.inc.php'); ?>
