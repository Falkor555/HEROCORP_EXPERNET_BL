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
    $user="root";
    $pass="";
    $dbname="herocorploic";
    $host="localhost";

    $db=new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
    $requete="";

    if(isset($_GET['search'])){
        $requete=$db->prepare("select * from heros
            where nom like :nom  or
            prenom like :prenom or 
            pseudo like :pseudo or 
            capacite_id like :capacite_id");
        $valeur="%".$_GET['search']."%";
        $requete->bindParam("nom",$valeur);
        $requete->bindParam("prenom", $valeur);
        $requete->bindParam("pseudo", $valeur);
        $requete->bindParam("capacite_id", $valeur);
        $requete->execute();

    }
    else $requete=$db->query("select * from heros");

    $requete->setFetchMode(PDO::FETCH_CLASS,'Heros');

    $heros=$requete->fetchAll();


    foreach ($heros as $hero) {

        echo "<tr>
    <td>".$hero->getId()."</td> 
    <td>".$hero->getNom()."</td> 
    <td>".$hero->getPrenom()."</td> 
    <td>".$hero->getPseudo()."</td> 
    <td>".$hero->getCapacite()."</td>
    <td>".$hero->getEquipe()."</td>
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


