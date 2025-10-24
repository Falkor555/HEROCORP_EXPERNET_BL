<?php
$user = "root";
$pass = "";
$dbname = "herocorploic";
$host = "localhost";
$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

$heroId = $_GET['id'];

if ($_POST) {
    $stmt = $db->prepare("UPDATE heros SET nom = :nom, prenom = :prenom, pseudo = :pseudo, capacite_id = :capacite_id, equipe_id = :equipe_id WHERE id = :id");
    $stmt->execute([
        ':nom' => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        ':pseudo' => $_POST['pseudo'],
        ':capacite_id' => $_POST['capacite_id'] ?: null,
        ':equipe_id' => $_POST['equipe_id'] ?: null,
        ':id' => $heroId
    ]);
    header('Location: hero-corp.php');
    exit();
}

$hero = $db->prepare("SELECT * FROM heros WHERE id = :id");
$hero->execute([':id' => $heroId]);
$hero = $hero->fetch(PDO::FETCH_ASSOC);

$capacites = $db->query("SELECT * FROM capacite ORDER BY nom_capacite")->fetchAll();
$equipes = $db->query("SELECT * FROM equipe ORDER BY nom_equipe")->fetchAll();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier - Hero Corp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Modifier le héros</h2>
            
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $hero['nom']; ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" value="<?php echo $hero['prenom']; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Pseudo</label>
                            <input type="text" name="pseudo" class="form-control" value="<?php echo $hero['pseudo']; ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Capacité</label>
                            <select name="capacite_id" class="form-select">
                                <option value="">-- Aucune --</option>
                                <?php foreach ($capacites as $c): ?>
                                    <option value="<?php echo $c['id']; ?>" <?php echo ($hero['capacite_id'] == $c['id']) ? 'selected' : ''; ?>>
                                        <?php echo $c['nom_capacite']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Équipe</label>
                            <select name="equipe_id" class="form-select">
                                <option value="">-- Aucune --</option>
                                <?php foreach ($equipes as $e): ?>
                                    <option value="<?php echo $e['id']; ?>" <?php echo ($hero['equipe_id'] == $e['id']) ? 'selected' : ''; ?>>
                                        <?php echo $e['nom_equipe']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="hero-corp.php" class="btn btn-secondary">Retour</a>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>