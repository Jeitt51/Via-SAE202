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
    $nouveauNom = $_POST["nom"];
    $nouveauEmail = $_POST["email"];
    $nouveauMDP = $_POST["mdp"];

    // Requête SQL pour mettre à jour les informations de l'utilisateur
    $sqlMiseAJour = "UPDATE Usagers SET nom = :nom, usagers_email = :email, usagers_mdp = :mdp WHERE user_id = :id";
    $stmtMiseAJour = $mabd->prepare($sqlMiseAJour);
    $stmtMiseAJour->bindParam(':nom', $nouveauNom);
    $stmtMiseAJour->bindParam(':email', $nouveauEmail);
    $stmtMiseAJour->bindParam(':mdp', $nouveauMDP);
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

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo $utilisateur['nom']; ?>" required><br><br>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?php echo $utilisateur['usagers_email']; ?>" required><br><br>

    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" value="<?php echo $utilisateur['usagers_mdp']; ?>" required>
    <input type="checkbox" onclick="togglePasswordVisibility()"> Afficher le mot de passe<br><br>

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
