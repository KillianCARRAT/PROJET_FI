<?php
$title = 'matériels';
$lesCSS = ["basPage", "cote", "style-stock"];
require_once 'head.php';
?>

<html>
<body>
    <?php require_once "cote.php"; ?>
    <main id="main-stock">
        <h1>Fiche stock</h1>
        <section id="question">
            <form class="stock" method="post" action="/info-stock">
                <div class="grand" id="matériels">
                    <?php
                    $mat = $bdd->prepare('SELECT * FROM MATERIEL WHERE qteAsso IS NOT NULL');
                    $mat->execute();
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
                                        <option value="instrument" <?php echo $mate['typeM'] === 'instrument' ? 'selected' : ''; ?>>Instrument</option>
                                        <option value="câble" <?php echo $mate['typeM'] === 'câble' ? 'selected' : ''; ?>>Câble</option>
                                        <option value="autres" <?php echo $mate['typeM'] === 'autres' ? 'selected' : ''; ?>>Autres</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="nom[]"
                                        value="<?php echo htmlspecialchars($mate['nomM'], ENT_QUOTES, 'UTF-8'); ?>">
                                </td>
                                <td>
                                    <input type="number" name="quantite[]"
                                    value="<?php echo htmlspecialchars($mate['qteAsso'] ?? 0, ENT_QUOTES, 'UTF-8'); ?>"
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
$lesJS = ["stockMat"];
require_once 'script.php';
?>

</html>
