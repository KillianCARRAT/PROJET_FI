<?php $title = 'Liste_Spec_Art';
$lesCSS = ["Table_Spec", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    <main>
        <div class="main-liste-spec">
            <h1 id="les-specs-orga"> les compte des Assos</h1>
            <table id="table-spec">
                <thead>
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">mot de passe</th>
                        <th scope="col">Type</th>
                    </tr>
                </thead>
                <tbody>
                <?php $reponse = $bdd->query('SELECT * FROM UTILISATEUR where typeU="ORG" OR typeU="TEC"');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    
                        <form method="POST" action="/Cmdp">
                        <tr>
                            <input type="hidden" id="id" name="id" value=<?php echo $donnees['iden']; ?>>
                            <input type="hidden" id="admin" name="admin" value="tr"/>
                            <td><?php echo $donnees['iden']; ?></td>
                            <td><button type="submit" class="bouton-bas"> changer mot de passe</button></td>
                            <td><?php echo $donnees['typeU']; ?></td>
                         </tr>
                            </form>
                    </tbody>
                    <?php
                }
                $reponse->closeCursor();
                ?>
            </table>
        </div>
    </main>
    <?php include "basPage.php"; ?>
</body>

</html>

