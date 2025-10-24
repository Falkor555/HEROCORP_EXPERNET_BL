<?php
$user = "root";
$pass = "";
$dbname = "herocorploic";
$host = "localhost";
$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

if ($_POST) {
    $stmt = $db->prepare("INSERT INTO heros (nom, prenom, pseudo, capacite_id, equipe_id) VALUES (:nom, :prenom, :pseudo, :capacite_id, :equipe_id)");
    $stmt->execute([
        ':nom' => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        ':pseudo' => $_POST['pseudo'],
        ':capacite_id' => $_POST['capacite_id'] ?: null,
        ':equipe_id' => $_POST['equipe_id'] ?: null
    ]);
    header('Location: hero-corp.php');
    exit();
}

$capacites = $db->query("SELECT * FROM capacite ORDER BY nom_capacite")->fetchAll();
$equipes = $db->query("SELECT * FROM equipe ORDER BY nom_equipe")->fetchAll();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouveau Héros - Hero Corp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Créer un nouveau héros</h2>

            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" placeholder="Entrez le nom du héros">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" placeholder="Entrez le prénom du héros">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pseudo</label>
                            <input type="text" name="pseudo" class="form-control" placeholder="Entrez le pseudo du héros" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Capacité</label>
                            <select name="capacite_id" class="form-select">
                                <option value="">-- Choisir une capacité --</option>
                                <?php foreach ($capacites as $c): ?>
                                    <option value="<?php echo $c['id']; ?>">
                                        <?php echo $c['nom_capacite']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Équipe</label>
                            <select name="equipe_id" class="form-select">
                                <option value="">-- Choisir une équipe --</option>
                                <?php foreach ($equipes as $e): ?>
                                    <option value="<?php echo $e['id']; ?>">
                                        <?php echo $e['nom_equipe']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="hero-corp.php" class="btn btn-secondary">Retour</a>
                            <button type="submit" class="btn btn-success">Créer le héros</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
