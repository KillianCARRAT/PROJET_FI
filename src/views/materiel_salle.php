<?php
$title = 'matériels';
$lesCSS = ["basPage", "cote", "style-stock"];
require_once 'head.php';
?>

<body>
    <?php require_once "cote.php"; ?>
    <main id="main-stock">
        <h1>Fiche stock</h1>
        <section id="question">
            <form class="stock" method="post" action="/info-stock-salle">
                <div class="grand" id="matériels">
                    <?php
                    $idS = $_GET['id'];
                    ?>
                        <input type="hidden" name="idS" id="idS" value="<?php echo $idS; ?>">
                    <?php
                    $mat = $bdd->prepare('SELECT *, qte FROM MATERIEL NATURAL JOIN AVOIRSALLE WHERE idS = :idS');
                    $mat->bindParam(":idS", $idS, PDO::PARAM_INT);
                    $mat->execute();


                    $type = $bdd->prepare('SELECT * FROM TYPEM');
                    $type->execute();
                    ?>
                    <table>
                        <tr>
                            <th>Type du matériel</th>
                            <th>Nom</th>
                            <th>Quantité</th>
                            <th></th>
                        </tr>
                        <?php while ($mate = $mat->fetch()) {
                            $idM = $mate["idM"];
                            ?>
                            <tr>
                                <td>
                                    <select name="type[]">
                                        <?php while ($type = $type->fetch()) { ?>
                                            <option value="<?php echo $type['typeM']; ?>" <?php echo $mate['typeM'] === $type['typeM'] ? 'selected' : ''; ?>><?php echo $type['typeM']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="nom[]"
                                        value="<?php echo htmlspecialchars($mate['nomM'], ENT_QUOTES, 'UTF-8'); ?>">
                                </td>
                                <td>
                                    <input type="number" name="quantite[]"
                                    value="<?php echo htmlspecialchars($mate['qte'] ?? 0, ENT_QUOTES, 'UTF-8'); ?>"
                                    min="0">
                                </td>
                                <td>
                                    <button type="button" class="delete-line-btn">Supprimer</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <button type="button" id="add-line-btn">+ Ajouter une ligne</button>
                    <button type="submit" id="envoyer-stock">Valider</button>
            </form>
            </div>
        </section>
    </main>
    <?php require_once "basPage.php"; ?>
</body>

<?php
    $lesJS = ["materielSalle"];
    require_once 'script.php';
    ?>
 
</html>
