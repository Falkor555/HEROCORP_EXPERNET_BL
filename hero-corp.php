<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hero Corp - Gestion des Héros</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css" />
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 text-center mb-4 text-primary">
                <i class="fas fa-mask"></i> Hero Corp
            </h1>
            <a href='hero-corp-inscription.php' class='btn btn-warning btn-sm' title='signup'>
                <i class='fas fa-edit'></i> Inscrire un nouveau héros
            </a>
            <!-- Formulaire de recherche -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="hero-corp.php" method="get" class="row g-3">
                        <div class="col-md-8">
                            <label for="search" class="form-label">
                                <i class="fas fa-search"></i> Rechercher un héros
                            </label>
                            <input type="text" name="search" id="search" class="form-control" 
                                   placeholder="Nom, prénom, pseudo, capacité ou équipe..." 
                                   value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-search"></i> Rechercher
                            </button>
                            <a href="hero-corp.php" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tableau des héros -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-users"></i> Liste des Héros
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-hover">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col"><i class="fas fa-hashtag"></i> ID</th>
                                <th scope="col"><i class="fas fa-user"></i> Nom</th>
                                <th scope="col"><i class="fas fa-user"></i> Prénom</th>
                                <th scope="col"><i class="fas fa-mask"></i> Pseudo</th>
                                <th scope="col"><i class="fas fa-magic"></i> Capacité</th>
                                <th scope="col"><i class="fas fa-users"></i> Équipe</th>
                                <th scope="col"><i class="fas fa-cogs"></i> Actions</th>
                            </tr>
                            </thead>

                            <tbody>
    <?php
    require('Heros.php');
    require('Capacite.php');
    require('Equipe.php');
    $user="root";
    $pass="";
    $dbname="herocorploic";
    $host="localhost";

    $db=new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
    $requete="";

    if(isset($_GET['search'])){
        $requete=$db->prepare("select h.*, c.nom_capacite, e.nom_equipe 
            from heros h 
            left join capacite c on h.capacite_id = c.id 
            left join equipe e on h.equipe_id = e.id 
            where h.nom like :nom  or
            h.prenom like :prenom or 
            h.pseudo like :pseudo or 
            c.nom_capacite like :capacite or
            e.nom_equipe like :equipe");
        $valeur="%".$_GET['search']."%";
        $requete->bindParam("nom",$valeur);
        $requete->bindParam("prenom", $valeur);
        $requete->bindParam("pseudo", $valeur);
        $requete->bindParam("capacite", $valeur);
        $requete->bindParam("equipe", $valeur);
        $requete->execute();

    }
    else $requete=$db->query("select h.*, c.nom_capacite, e.nom_equipe 
        from heros h 
        left join capacite c on h.capacite_id = c.id 
        left join equipe e on h.equipe_id = e.id");

    $heros=$requete->fetchAll(PDO::FETCH_ASSOC);


    foreach ($heros as $heroData) {
        // Créer l'objet Hero
        $hero = new Heros();
        $hero->setId($heroData['id']);
        $hero->setNom($heroData['nom']);
        $hero->setPrenom($heroData['prenom']);
        $hero->setPseudo($heroData['pseudo']);
        
        // Créer l'objet Capacite
        $capacite = new Capacite();
        if($heroData['capacite_id']) {
            $capaciteQuery = $db->prepare("SELECT * FROM capacite WHERE id = :id");
            $capaciteQuery->bindParam(':id', $heroData['capacite_id']);
            $capaciteQuery->execute();
            $capaciteQuery->setFetchMode(PDO::FETCH_CLASS, 'Capacite');
            $capacite = $capaciteQuery->fetch();
        }

        // Créer l'objet Equipe
        $equipe = new Equipe();
        if($heroData['equipe_id']) {
            $equipeQuery = $db->prepare("SELECT * FROM equipe WHERE id = :id");
            $equipeQuery->bindParam(':id', $heroData['equipe_id']);
            $equipeQuery->execute();
            $equipeQuery->setFetchMode(PDO::FETCH_CLASS, 'Equipe');
            $equipe = $equipeQuery->fetch();
        }

        echo "<tr>
            <td><span class='badge bg-secondary'>".$hero->getId()."</span></td> 
            <td><strong>".$hero->getNom()."</strong></td> 
            <td>".$hero->getPrenom()."</td> 
            <td><span class='badge bg-primary'>".$hero->getPseudo()."</span></td> 
            <td><span class='badge bg-success'>".($capacite ? $capacite->getNomCapacite() : '<em>Aucune</em>')."</span></td>
            <td><span class='badge bg-info'>".($equipe ? $equipe->getNomEquipe() : '<em>Aucune</em>')."</span></td>
            <td>
                <div class='btn-group btn-group-sm' role='group'>
                    <a href='modifier.php?id=".$hero->getId()."' class='btn btn-warning btn-sm' title='Modifier'>
                        <i class='fas fa-edit'></i> Modifier
                    </a>
                    <a href='supprimer.php?id=".$hero->getId()."' class='btn btn-danger btn-sm' 
                       onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce héros ?\")' title='Supprimer'>
                        <i class='fas fa-trash'></i> Supprimer
                    </a>
                </div>
            </td>
        </tr>";
    }
    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables JS avec Bootstrap -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#myTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json"
        },
        "pageLength": 10,
        "responsive": true,
        "order": [[ 0, "asc" ]]
    });
});
</script>

</body>
</html>


