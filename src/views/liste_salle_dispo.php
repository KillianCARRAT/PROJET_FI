<?php
$lesCSS = ["listeSalleDispo", "basPage", "cote"];
require_once 'head.php';


$type = $_POST["typePlace"];
$nbPers = $_POST["nbPers"];
$longueur = $_POST["longueur"];
$largeur = $_POST["largeur"];
$nom = $_POST["nom"];
$date = $_POST["date"];
$heure = $_POST["heure"];
$duree = $_POST["duree"];
$arrive = $_POST["arrive"];

$infos = false;

?>




<!DOCTYPE html>
<html lang="fr">
<?php require_once "cote.php" ?>

<body id="principal">

    <main>

        <?php
        $procedure = "call salles_dispo(:arrive,:duree,:heure,:jour,:type,:nb,:longueur,:largeur)";
        $execution = $bdd->prepare($procedure);
        $execution->bindParam(':arrive', $arrive, PDO::PARAM_STR);
        $execution->bindParam(':duree', $duree, PDO::PARAM_STR);
        $execution->bindParam(':heure', $heure, PDO::PARAM_STR);
        $execution->bindParam(':jour', $date, PDO::PARAM_STR);
        $execution->bindParam(':nb', $nbPers, PDO::PARAM_STR);
        $execution->bindParam(':type', $type, PDO::PARAM_STR);
        $execution->bindParam(':longueur', $longueur, PDO::PARAM_STR);
        $execution->bindParam(':largeur', $largeur, PDO::PARAM_STR);
        $execution->execute();

        $table = $bdd->prepare("select * from SalleTemp");
        $table->execute();
        ?>

        <table id="tableau">
            <thead>
                <tr>
                    <th scope="col">Selectionnez une salle</th>
                    <th scope="col">Nom de la salle</th>
                    <th scope="col">Longueur</th>
                    <th scope="col">Largeur</th>
                    <th scope="col">Nombre de place</th>
                </tr>
            </thead>
            <form method="POST" action="creer_specacle">
                <?php
                while ($row = $table->fetch()) {
                    $infos = true;
                ?>

                    <tr>
                        <td><input type="radio" name="nomS" classe="nomS" value="<?php echo htmlspecialchars($row["nomS"]); ?>" required></td>
                        <td><?php echo htmlspecialchars($row["nomS"]); ?></td>
                        <td><?php echo htmlspecialchars($row["longueurS"]); ?></td>
                        <td><?php echo htmlspecialchars($row["largeurS"]); ?></td>
                        <td><?php echo htmlspecialchars($row["nbPlaceS"]); ?></td>
                    </tr>
                <?php } ?>

        </table>

        <input type="hidden" name="nom" value=<?php echo htmlspecialchars($nom); ?>>
        <input type="hidden" name="date" value=<?php echo htmlspecialchars($date); ?>>
        <input type="hidden" name="heure" value=<?php echo htmlspecialchars($heure); ?>>
        <input type="hidden" name="duree" value=<?php echo htmlspecialchars($duree); ?>>
        <input type="hidden" name="arrive" value=<?php echo htmlspecialchars($arrive); ?>>

        <?php
        if ($infos) {
            echo '<button id="bouton" type="submit" class="bouton-bas">Ajouter le spectacle</button>';
        } else {
            echo '<button id="bouton" type="button" class="bouton-bas" onclick="window.location = \'Create_Spec2\'">Retour</button>';
        }
        ?>

        </form>

    </main>
</body>
<?php require_once "basPage.php" ?>