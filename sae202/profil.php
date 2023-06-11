<?php
session_start();
require 'lib.inc.php';

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['numero'])) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

$mabd = connexionBD();

// Récupération des informations de l'utilisateur connecté
$idUtilisateur = $_SESSION['numero'];

// Récupération des informations de l'utilisateur à partir de la base de données
$sql = "SELECT * FROM Usagers WHERE user_id = :id";
$stmt = $mabd->prepare($sql);
$stmt->bindParam(':id', $idUtilisateur);
$stmt->execute();
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérification si le formulaire de mise à jour a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des nouvelles valeurs des champs
    $nouveauPrenom = $_POST["prenom"];
    $nouveauNom = $_POST["nom"];
    $nouveauEmail = $_POST["email"];
    $nouveauMDP = $_POST["mdp"];
    $nouveauNumero = $_POST["numero"];
    $nouveauAutre = $_POST["autre"];
    $nouveauVehicule = $_POST["vehicule"];
    $nouveauFumeur = $_POST["fumeur"];
    $nouveauAnimaux = $_POST["animaux"];
    $nouveauMusique = $_POST["musique"];

    // Requête SQL pour mettre à jour les informations de l'utilisateur
    $sqlMiseAJour = "UPDATE Usagers SET nom = :nom, usagers_email = :email, usagers_mdp = :mdp, num =:numero, autre =:autre, vehicule =:vehicule,
                   fumeur =:fumeur, animaux =: anaimaux, musique =:musique WHERE user_id = :id";
    $stmtMiseAJour = $mabd->prepare($sqlMiseAJour);
    $stmtMiseAJour->bindParam(':nom', $nouveauNom);
    $stmtMiseAJour->bindParam(':email', $nouveauEmail);
    $stmtMiseAJour->bindParam(':mdp', $nouveauMDP);
    $stmtMiseAJour->bindParam(':numero', $nouveauNumero);
    $stmtMiseAJour->bindParam(':autre', $nouveauAutre);
    $stmtMiseAJour->bindParam(':vehicule', $nouveauVehicule);
    $stmtMiseAJour->bindParam(':fumeur', $nouveauFumeur);
    $stmtMiseAJour->bindParam(':animaux', $nouveauAnimaux);
    $stmtMiseAJour->bindParam(':musique', $nouveauMusique);
    $stmtMiseAJour->bindParam(':id', $idUtilisateur);
    $stmtMiseAJour->execute();

    // Mise à jour des informations de l'utilisateur dans la session
    $_SESSION['prenom'] = $nouveauNom;
    $_SESSION['modification_reussie'] = true;

    // Redirection vers la page de profil après la mise à jour
    header("Location: profil.php");
    exit();
}

// Fermeture de la connexion à la base de données
deconnexionBD($mabd);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil utilisateur</title>
    <style>
        /* Style pour l'image de profil */
        .profile-picture {
            width: 150px; /* Ajustez la taille selon vos besoins */
            height: 150px; /* Ajustez la taille selon vos besoins */
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("mdp");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</head>
<body>
<h1>Profil utilisateur</h1>


<!-- Ajout de la balise img pour afficher l'image -->
<img src="<?php echo $utilisateur['photo_profil']; ?>" alt="Photo de profil" class="profile-picture">

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo $utilisateur['nom']; ?>" required><br><br>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?php echo $utilisateur['usagers_email']; ?>" required><br><br>

    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" value="<?php echo $utilisateur['usagers_mdp']; ?>" required>
    <input type="checkbox" onclick="togglePasswordVisibility()"> Afficher le mot de passe<br><br>

    <label for="numero">Numéro de téléphone :</label>
    <input type="number" id="numero" name="numero" value="<?php echo $utilisateur['num']; ?>" required><br><br>

    <label for="autre">autre :</label>
    <input type="text" id="autre" name="autre" value="<?php echo $utilisateur['autre']; ?>" required><br><br>

    <label for="vehicule">vehicule :</label>
    <input type="text" id="vehicule" name="vehicule" value="<?php echo $utilisateur['vehicule']; ?>" required><br><br>

    <label>fumeur:</label>
    <div>
        <input type="radio" id="non" name="fumeur" value="non" checked>
        <label for="non">Non</label>
    </div>
    <div>
        <input type="radio" id="oui" name="fumeur" value="oui">
        <label for="oui">Oui</label>
    </div>

    <label for="animaux">animaux :</label>
    <input type="text" id="animaux" name="animaux" value="<?php echo $utilisateur['animaux']; ?>" required><br><br>

    <label for="musique">musique :</label>
    <input type="text" id="musique" name="musique" value="<?php echo $utilisateur['musique']; ?>" required><br><br>

    <input type="submit" value="Mettre à jour">
</form>
<?php
if (isset($_SESSION['modification_reussie']) && $_SESSION['modification_reussie'] === true) {
    echo '<p>Les informations ont été mises à jour avec succès.</p>';
    unset($_SESSION['modification_reussie']);
}
?>
</body>
</html>
