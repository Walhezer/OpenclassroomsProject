<?php
require 'bdd.php';
$bdd = connexion();

// Vérification de l'ID 
if (empty($_GET['id'])) {
    header('Location: index.php');
    exit();
}

// Requête 
$requete = $bdd->prepare('SELECT * FROM oeuvres WHERE oeuvre_id=?');
$requete->execute([$_GET['id']]);
$oeuvre = $requete->fetch(PDO::FETCH_ASSOC);


// Si aucune oeuvre trouvé, on redirige vers la page d'accueil
if (!$oeuvre) {
    require 'header.php';
    echo "<h2 style='color:red; text-align:center; margin-top:50px;'>Cette œuvre n’existe pas ou a été supprimée.</h2>";
    echo "<p style='text-align:center;'><a href='index.php'>← Retour à l’accueil</a></p>";
    require 'footer.php';
    exit;
}

// Si oeuvre trouvée, on affiche la page 
require 'header.php';
?>


<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= htmlspecialchars ($oeuvre['image']) ?>" 
             alt="<?= htmlspecialchars ($oeuvre['titre']) ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= htmlspecialchars($oeuvre['titre']) ?></h1>
        <p class="description"><?= htmlspecialchars($oeuvre['artiste']) ?></p>
        <p class="description-complete">
            <?= nl2br(htmlspecialchars($oeuvre['description'])) ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>