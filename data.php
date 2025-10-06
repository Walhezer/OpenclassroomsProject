<?php

// === CONFIGURATION DE LA CONNEXION ===
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = ""; 
$base = "artbox"; 

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("❌ Échec de la connexion : " . $connexion->connect_error);
}

// Encodage en UTF-8 pour les caractères spéciaux
$connexion->set_charset("utf8mb4");

echo "<h2> Début de l'importation des œuvres</h2>";

// === VOS DONNÉES ===
$oeuvres = [
    [
        'id' => 1,
        'titre' => 'Dodomu',
        'description' => 'Mia Tozerski est une artiste peintre ukrainienne réfugiée de la guerre. Sur cette œuvre, Dodomu ("domicile" en ukrainien), elle nous montre la tristesse du peuple ukrainien qu\'elle partage, ayant elle-même dû quitter son foyer. L\'œuvre évoque le drapeau liquéfié d\'une Ukraine en souffrance, pleurant la mort de ses compatriotes. Ce travail chargé d\'émotion est le symbole d\'un événement qui marquera l\'Histoire. Cette peinture à l\'acrylique rayonne grâce à son fond lisse et ses mélanges de couleurs éclatantes.',
        'artiste' => 'Mia Tozerski',
        'image' => 'img/clark-van-der-beken.png'
    ],
    [
        'id' => 2,
        'titre' => 'Aashaaheen Baadal',
        'description' => 'Sur cette oeuvre conceptuelle à la fois organique, minérale et liquide, Anaisha Devi nous transporte dans un nuage noir envoûtant. Un sombre tableau qui, par son verni éclatant, rayonne tel un marbre poli. Une oeuvre à la cohérence transcendantale, exécutée à la perfection',
        'artiste' => 'Anaisha Devi',
        'image' => 'img/pawel-czerwinski-3.png'
    ],
    [
        'id' => 3,
        'titre' => 'Nightlife Traffic',
        'description' => 'Quisque accumsan ultrices ligula vestibulum posuere. Aliquam feugiat ligula eget massa blandit condimentum. Morbi volutpat erat luctus suscipit pellentesque. Quisque cursus tempor nibh at sollicitudin. Sed blandit libero velit. Etiam tincidunt facilisis mollis. Ut mollis nunc sit amet lacinia luctus. Suspendisse volutpat enim semper arcu rutrum, et iaculis risus interdum. Duis at libero.',
        'artiste' => 'Andrew Forsythe',
        'image' => 'img/dan-cristian-padure.png'
    ],
    [
        'id' => 4,
        'titre' => 'Le refuge de l\'Havre',
        'description' => 'Nam tempus neque nec felis venenatis auctor. Nam velit risus, lobortis eu quam non, interdum efficitur nibh. Phasellus a augue ac orci lacinia mattis et vel lectus. Sed nec tellus urna. Donec at turpis turpis. Cras quam tellus, imperdiet vitae finibus id, varius quis felis. Maecenas blandit eleifend risus, vel hendrerit erat dignissim id. Nullam at laoreet nibh. Nulla gravida varius sollicitudin. Etiam non aliquam diam, tempor varius sapien. Aenean et velit eu nisi lobortis massa nunc.',
        'artiste' => 'Simon Pelletier',
        'image' => 'img/steve-johnson-5.png'
    ],
    [
        'id' => 5,
        'titre' => 'Red Washover',
        'description' => 'Nunc euismod ullamcorper tortor, id efficitur ante interdum in. Integer eu condimentum nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras viverra suscipit feugiat. Mauris vehicula luctus tellus, eu hendrerit libero laoreet ut. In tristique vehicula nisl in tempus. Morbi tempus aliquet gravida. In eget est congue, rhoncus sapien at, cursus metus.',
        'artiste' => 'Kit Van Der Borght',
        'image' => 'img/steve-johnson.png'
    ],
    [
        'id' => 6,
        'titre' => 'Chromatics',
        'description' => 'Vivamus commodo non libero at hendrerit. In lacinia dui sit amet pellentesque iaculis. Donec at ultricies sem porttitor.',
        'artiste' => 'Jean-Michel Delatronchette',
        'image' => 'img/pawel-czerwinski.png'
    ],
    [
        'id' => 7,
        'titre' => 'Digital Negative',
        'description' => 'Integer in nisl posuere, pulvinar ex ac, tincidunt risus. Nullam vel lorem et leo dignissim accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempor, magna non consectetur dapibus, est libero iaculis lacus, eget semper turpis orci vitae felis. Fusce eget molestie.',
        'artiste' => 'Hamish McKee',
        'image' => 'img/jazmin-quaynor.png'
    ],
    [
        'id' => 8,
        'titre' => 'Blast from the past',
        'description' => 'Nunc fermentum purus dapibus justo fermentum auctor. Maecenas non tincidunt leo. Morbi vitae iaculis sem. Donec quis scelerisque massa. Fusce quis accumsan diam, et interdum lectus. Suspendisse mattis pulvinar vehicula. Duis nisi.',
        'artiste' => 'Juliette Baskerville',
        'image' => 'img/steve-johnson-6.png'
    ],
    [
        'id' => 9,
        'titre' => 'Hurricane',
        'description' => 'Aliquam tristique tempus molestie. Nulla nisl eros, dapibus eu lectus in, cursus accumsan arcu. Suspendisse bibendum diam dignissim porta maximus. Praesent sollicitudin consectetur faucibus. Cras pulvinar massa a orci rutrum, id blandit enim viverra. Praesent sed congue augue. Suspendisse efficitur, nisl quis finibus faucibus, lacus felis bibendum leo, eu euismod lacus mauris in felis. Quisque dignissim et dui et aliquet. Donec ut lobortis eros, vitae tincidunt augue metus.',
        'artiste' => 'Natalie Wellington',
        'image' => 'img/victor-grabarczyk.png'
    ],
    [
        'id' => 10,
        'titre' => 'La marée rouge',
        'description' => 'Vivamus quis odio vel ligula feugiat facilisis. Donec eleifend pellentesque massa, ut malesuada est bibendum sit amet. Morbi tincidunt nec tellus vel ornare. Mauris dolor tellus, gravida eget euismod eu, viverra eget urna. Phasellus feugiat ipsum nec lorem accumsan, sed porta quam dictum massa nunc.',
        'artiste' => 'Martin Rodriguez',
        'image' => 'img/pawel-czerwinski-2.png'
    ],
    [
        'id' => 11,
        'titre' => 'Asimilacion',
        'description' => 'Mauris ut justo ac mi pretium eleifend. Curabitur sed magna ut elit facilisis pharetra. Maecenas tincidunt fermentum ipsum ut sollicitudin. Nullam feugiat, neque vel egestas sollicitudin, quam leo mattis mauris, in lacinia sem mi id risus. Nullam ultrices quam eu leo auctor tempus. Fusce vestibulum mi ex, vel ultricies purus mollis sollicitudin. Aenean ac vehicula ipsum. Nam turpis ante, ultrices eget odio sed, luctus bibendum mauris sodales sed.',
        'artiste' => 'Angel Sanchez-Fernandez',
        'image' => 'img/steve-johnson-2.png'
    ],
    [
        'id' => 12,
        'titre' => 'La Galaxia Gialla',
        'description' => 'Mauris maximus, orci sollicitudin ultrices elementum, tellus neque feugiat leo, quis lobortis purus neque vel lectus. Ut sagittis eros id lectus porttitor tincidunt. Donec scelerisque diam nec felis egestas, eget finibus ante porttitor. Sed malesuada sapien ut semper accumsan. Duis tristique dui vel egestas porttitor. Nunc tristique dapibus orci a amet.',
        'artiste' => 'Eduardo Tancredi',
        'image' => 'img/fly-d.png'
    ],
    [
        'id' => 13,
        'titre' => 'Puffy Amalgamate',
        'description' => 'Donec semper a massa quis congue. In malesuada lorem ligula, ut posuere magna pulvinar in. Proin vitae enim gravida, commodo odio.',
        'artiste' => 'Sandro De Blasi',
        'image' => 'img/orfeas-green.png'
    ],
    [
        'id' => 14,
        'titre' => 'Mirage',
        'description' => 'Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam iaculis lorem ac ex tristique egestas et nec sapien. Donec tincidunt id erat sit amet tempus. Nullam vel molestie dui. Duis a neque massa. Vivamus quis ornare lacus. Nullam eleifend condimentum egestas. Vivamus magna purus, fermentum mollis mauris sed, consectetur interdum libero. Duis interdum tortor tellus, eget sollicitudin quis.',
        'artiste' => 'Stéphanie Kaiser',
        'image' => 'img/steve-johnson-4.png'
    ],
    [
        'id' => 15,
        'titre' => 'Blaue Gelbe Muster',
        'description' => 'Curabitur dui odio, porta vel tempor sed, consectetur vitae mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Orci varius natoque penatibus nec.',
        'artiste' => 'Adelheid Von Schreiber',
        'image' => 'img/steve-johnson-3.png'
    ],
];

// === INSERTION DES DONNÉES ===
$compteur_succes = 0;
$compteur_erreurs = 0;

// Préparation de la requête SQL
$sql = "INSERT INTO oeuvres (id, titre, description, artiste, image) VALUES (?, ?, ?, ?, ?)";
$stmt = $connexion->prepare($sql);

if (!$stmt) {
    die("Erreur de préparation : " . $connexion->error);
}

// Insertion de chaque œuvre
foreach ($oeuvres as $oeuvre) {
    $stmt->bind_param("issss", 
        $oeuvre['id'],
        $oeuvre['titre'], 
        $oeuvre['description'], 
        $oeuvre['artiste'],
        $oeuvre['image']
    );
    
    if ($stmt->execute()) {
        echo "✅ Œuvre #{$oeuvre['id']} - '{$oeuvre['titre']}' ajoutée avec succès<br>";
        $compteur_succes++;
    } else {
        echo "❌ Erreur pour l'œuvre #{$oeuvre['id']} - '{$oeuvre['titre']}' : " . $stmt->error . "<br>";
        $compteur_erreurs++;
    }
}

// Fermeture
$stmt->close();
$connexion->close();

// Résumé
echo "<hr>";
echo "<h3>📊 Résumé de l'importation</h3>";
echo "<p>✅ <strong>$compteur_succes</strong> œuvres importées avec succès</p>";
echo "<p>❌ <strong>$compteur_erreurs</strong> erreurs</p>";
echo "<p>🎉 Import terminé !</p>";

?>