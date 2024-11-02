<?php
    session_start();

    if($_POST){
        if(isset($_POST['phone']) && !empty($_POST['phone'])
        && isset($_POST['department']) && !empty($_POST['department'])){
        
        //Si on a tout, on ce connecte a la BDD
        require_once "connexion.php";
        //Ensuite on néttoie les données envoyées
        $phone = strip_tags($_POST['phone']);
        $department = strip_tags($_POST['department']);

        $sql = "INSERT INTO doctors (`phone`, `department`) VALUES (:phone, :department)";
        $query = $db->prepare($sql);

        $query->bindValue(":phone", $phone, PDO::PARAM_INT);
        $query->bindValue(":department", $department, PDO::PARAM_INT);

        $query->execute();

        $resulta = $query->fetchAll();

    
        } else {
            $_SESSION['erreur'] = "formulaire incomplet";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form method="POST">
        <div>
            <input type="text" id="bla" name="bli">
        </div>
        <div>
            <input type="text" id="blo" name="blu">
        </div>

        <button type="submit">zipfgjzeigfj</button>
    </form>

</body>
</html>



$allusers = $db->query("SELECT * FROM doctors ORDER BY id DESC");
if(isset($_GET['firstname']) && !empty($_GET['firstname'])) {

    $recherche = htmlspecialchars($_GET['firstname']);

    $allusers = $db->query('SELECT first_name FROM doctors WHERE firstname "%'.$recherche.'%" ORDER BY id DESC');
}






<!-- code de base -->
        <!-- SEARCH FILTER -->
        <section class="search-filter">
            <form class="search-doctor-form" action="GET">
                <div class="first-section">
                    <div class="style-search">
                        <p>Tappez votre département :</p>
                        <input type="number" placeholder="ex: 58470">
                    </div>
                    
                    <div class="style-search">
                        <p>Choisissez votre professionnel :</p>
                        <select name="search-spe" id="search-spe">
                            <option value="generaliste">Médecin généraliste</option>
                            <option value="specialiste">Médecin spécialiste </option>
                            <option value="dentiste">Dentiste</option>
                            <option value="Kinesitherapeute">Kinésithérapeute</option>
                        </select>
                    </div>
                    
                    <div class="style-search">
                        <p>Tappez une spécialisation :</p>
                        <input type="text" placeholder="ex: Allergologue">
                    </div>
                </div>
                    
                <div class="billing">
                    <p>Type de réglement</p>
                    <div class="billing-method">
                        <div>
                            <input type="checkbox" id="carte-bancaire" name="" value="carte-bancaire">
                            <label for="carte-bancaire">Carte bancaire</label>
                        </div>
                        <div>
                            <input type="checkbox" id="cheque" name="" value="cheque">
                            <label for="cheque">Chèque</label>
                        </div>
                        <div>
                            <input type="checkbox" id="espece" name="" value="espece">
                            <label for="espece">Espèces</label>
                        </div>
                        <div>
                            <input type="checkbox" id="tiers-payant" name="" value="tiers-payant">
                            <label for="tiers-payant">Tiers payant</label>
                        </div>
                    </div>
                </div>

                <div class="last-section">
                    <div class="style-search">
                        <p>Nom :</p>
                        <input type="search" placeholder="ex: Doe" id="lastname" name="lastname">
                    </div>
                    
                    <div class="style-search">
                        <p>Prénom :</p>
                        <input type="search" placeholder="ex: Jane" id="firstname" name="firstname">
                    </div>
                </div>
                    

                <div class="search-info-sup">
                    <div class="billing">
                        <p>Choisissez votre médecin</p>
                        <div class="billing-method">
                            <div>
                                <input type="checkbox" id="male" name="" value="male">
                                <label for="male">Homme</label>
                            </div>
                            <div>
                                <input type="checkbox" id="female" name="" value="female">
                                <label for="female">Femme</label>
                            </div>
                        </div>
                    </div>

                    <div class="billing">
                        <p>Disponible pour de nouveaux patients ?</p>
                        <div class="billing-method">
                            <div>
                                <input type="checkbox" id="yes" name="" value="yes">
                                <label for="yes">Oui</label>
                            </div>
                            <div>
                                <input type="checkbox" id="no" name="" value="no">
                                <label for="no">Non</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="envoyer">Rechercher</button>
            </form>
        </section>


        profile-doctor.php
        profile-doctor.php
        


















        
// //Ma requete SQL
// $sql= "SELECT * FROM doctors";

// //on prépare la requete
// $query = $db->prepare($sql);

// //on execute la requete
// $query->execute();

// //on stock le résulta (le PDO::FETCH_ASSOC) permet de ne pas avoir les résulta en double
// $result = $query->fetchAll(PDO::FETCH_ASSOC);


//On ferme la connexion
require_once("deconnexion.php")
?>
