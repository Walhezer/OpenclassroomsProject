<?php
require 'header.php';
require 'bdd.php';

$errors = [];
$titre = $description = $artiste = $image = "";

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $artiste = trim($_POST['artiste'] ?? '');
    $image = trim($_POST['image'] ?? '');

    if (empty($titre)) {
        $errors['titre'] = "Le titre est obligatoire.";
    }

    if (empty($description)) {
        $errors['description'] = "La description est obligatoire.";
    } elseif (strlen($description) < 3) {
        $errors['description'] = "La description doit contenir au moins 3 caractères.";
    }

    if (empty($artiste)) {
        $errors['artiste'] = "Le nom de l'artiste est obligatoire.";
    }

    if (empty($image)) {
        $errors['image'] = "L’URL de l’image est obligatoire.";
    } elseif (!filter_var($image, FILTER_VALIDATE_URL)) {
        $errors['image'] = "L’URL de l’image n’est pas valide.";
    }

    // Si aucune erreur, on insère
    if (empty($errors)) {
        $bdd = connexion();
        $requete = $bdd->prepare('INSERT INTO oeuvres (titre, description, artiste, image) VALUES (?, ?, ?, ?)');
        $requete->execute([$titre, $description, $artiste, $image]);

        header('Location: oeuvre.php?id=' . $bdd->lastInsertId());
        exit;
    }
}
?>

<form method="POST" action="">
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($titre) ?>">
        <?php if (!empty($errors['titre'])): ?>
            <p style="color:red;"><?= $errors['titre'] ?></p>
        <?php endif; ?>
    </div>

    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste" id="artiste" value="<?= htmlspecialchars($artiste) ?>">
        <?php if (!empty($errors['artiste'])): ?>
            <p style="color:red;"><?= $errors['artiste'] ?></p>
        <?php endif; ?>
    </div>

    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image" id="image" value="<?= htmlspecialchars($image) ?>">
        <?php if (!empty($errors['image'])): ?>
            <p style="color:red;"><?= $errors['image'] ?></p>
        <?php endif; ?>
    </div>

    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description"><?= htmlspecialchars($description) ?></textarea>
        <?php if (!empty($errors['description'])): ?>
            <p style="color:red;"><?= $errors['description'] ?></p>
        <?php endif; ?>
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require 'footer.php'; ?>
