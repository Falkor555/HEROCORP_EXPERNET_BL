<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />

</head>
<body>
<form action="hero-corp.php" method="get">
    <label for="search">Rechercher</label>
    <input type="text" name="search" id="search">
    <input type="submit" value="Search" >
</form>
<table id="myTable" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Pseudo</th>
        <th>Capacité</th>
        <th>Équipe</th>
        <th>Action</th>
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
    <td>".$hero->getId()."</td> 
    <td>".$hero->getNom()."</td> 
    <td>".$hero->getPrenom()."</td> 
    <td>".$hero->getPseudo()."</td> 
    <td>".($capacite ? $capacite->getNomCapacite() : '')."</td>
    <td>".($equipe ? $equipe->getNomEquipe() : '')."</td>
    <td><a href='modifier.php?id=".$hero->getId()."'>Modifier</a> | <a href='supprimer.php?id=".$hero->getId()."'>Supprimer</a></td>
</tr>";
    }
    ?>

    </tbody>

</table>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

</body>
</html>


