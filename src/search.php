<?php
session_start();

require_once("gestions/tools.php"); //Fonction qui permet au header de faire la différence entre un professionnel et un utilisateur
require_once("connexion.php");

// Gestion des message d'erreurs des favoris
if (isset($_SESSION['favorite_message'])) {
    echo "<script>alert('" . $_SESSION['favorite_message'] . "');</script>";
    unset($_SESSION['favorite_message']);
}



// Requete de base
$sql = "SELECT * FROM doctors";
$conditions = [];
$params = [];

// On verifie chaque champ et ajoute des conditions suivant nos besoins
if (!empty($_GET['department'])) {
    $conditions[] = "department LIKE :department";
    $params[':department'] = $_GET['department'] . '%';
}

if (!empty($_GET['professional_type'])) {
    $conditions[] = "professional_type = :professional_type";
    $params[':professional_type'] = $_GET['professional_type'];
}

if (!empty($_GET['first_name'])) { 
    $conditions[] = "first_name = :first_name";
    $params[':first_name'] = $_GET['first_name'];
}

if (!empty($_GET['last_name'])) { 
    $conditions[] = "last_name = :last_name";
    $params[':last_name'] = $_GET['last_name'];
}

if (!empty($_GET['specialization'])) {
    $conditions[] = "specialization LIKE :specialization";
    $params[':specialization'] = '%' . $_GET['specialization'] . '%';
}

/*///////////////////////////////*/
if (!empty($_GET['payment_method'])) {
    // Crée une condition pour chaque méthode de paiement sélectionnée
    $payment_conditions = [];
    foreach ($_GET['payment_method'] as $method) {
        $payment_conditions[] = "FIND_IN_SET(:payment_method_$method, payment_method)";
        $params[":payment_method_$method"] = $method;
    }
    // Ajoute la condition globale pour les méthodes de paiement
    $conditions[] = "(" . implode(" OR ", $payment_conditions) . ")";
}
/*///////////////////////////////*/

if (!empty($_GET['gender'])) {
    $genders = implode("','", $_GET['gender']);
    $conditions[] = "gender IN ('" . $genders . "')";
}

if (!empty($_GET['availability'])) {
    $availability_values = implode("','", $_GET['availability']);
    $conditions[] = "availability IN ('" . $availability_values . "')";
}

// On ajoute les conditions a la requete si on désire en mettre
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Puis la requete
$query = $db->prepare($sql);
$query->execute($params);
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/fonts.css">
    <title>Recherche</title>
</head>
<body>
    
<!-- Header -->
<?php 
    require_once "gestions/header.php";
?>

    <main>
        <!-- SEARCH FILTER -->
        <section class="search-filter">
            <form class="search-doctor-form" method="GET" action="search.php">
                <div class="first-section">
                    <div class="style-search">
                        <p>Tapez votre département :</p>
                        <input type="number" name="department" placeholder="ex: 58470">
                    </div>
                    
                    <div class="style-search">
                        <p>Choisissez votre professionnel :</p>
                        <select name="professional_type" id="search-spe">
                            <option value="">Tous</option>
                            <option value="generaliste">Médecin généraliste</option>
                            <option value="specialiste">Médecin spécialiste</option>
                            <option value="dentiste">Dentiste</option>
                            <option value="Kinesitherapeute">Kinésithérapeute</option>
                        </select>
                    </div>
                    
                    <div class="style-search">
                        <p>Tapez une spécialisation :</p>
                        <input type="text" name="specialization" placeholder="ex: Allergologue">
                    </div>
                </div>
                    
                <div class="billing">
                    <p>Type de règlement</p>
                    <div class="billing-method">
                        <div>
                            <input type="checkbox" id="carte-bancaire" name="payment_method[]" value="Carte_Bancaire">
                            <label for="carte-bancaire">Carte bancaire</label>
                        </div>
                        <div>
                            <input type="checkbox" id="cheque" name="payment_method[]" value="Cheque">
                            <label for="cheque">Chèque</label>
                        </div>
                        <div>
                            <input type="checkbox" id="espece" name="payment_method[]" value="Especes">
                            <label for="espece">Espèces</label>
                        </div>
                        <div>
                            <input type="checkbox" id="tiers-payant" name="payment_method[]" value="Tiers_payant">
                            <label for="tiers-payant">Tiers payant</label>
                        </div>
                    </div>
                </div>

                <div class="last-section">
                    <div class="style-search">
                        <p>Nom :</p>
                        <input type="search" placeholder="ex: Doe" id="lastname" name="last_name">
                    </div>
                    
                    <div class="style-search">
                        <p>Prénom :</p>
                        <input type="search" placeholder="ex: Jane" id="firstname" name="first_name">
                    </div>
                </div>
                
                <div class="search-info-sup">
                    <div class="billing">
                        <p>Choisissez votre médecin</p>
                        <div class="billing-method">
                            <div>
                                <input type="checkbox" id="male" name="gender[]" value="H">
                                <label for="male">Homme</label>
                            </div>
                            <div>
                                <input type="checkbox" id="female" name="gender[]" value="F">
                                <label for="female">Femme</label>
                            </div>
                        </div>
                    </div>

                    <div class="billing">
                        <p>Disponible pour de nouveaux patients ?</p>
                        <div class="billing-method">
                            <div>
                                <input type="checkbox" id="yes" name="availability[]" value="Oui">
                                <label for="yes">Oui</label>
                            </div>
                            <div>
                                <input type="checkbox" id="no" name="availability[]" value="Non">
                                <label for="no">Non</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn-mod-user" type="submit" name="envoyer">Rechercher</button>
            </form>
        </section>

    <!-- Message si aucun résultat -->
    <?php if (empty($result)): ?>
        <div class="no-results-message">
            <p>Aucun professionnel de la santé ne correspond à votre recherche.</p>
        </div>
    <?php endif; ?>

        <!-- DOCOTR CARDS -->
        <section class="doctor-cards">

        <?php
            foreach($result as $doctor){
        ?>
        
            <figure class="doctor-card">
                <div class="doc-img-profil">
                    <img class="img-doc" src="<?= !empty($doctor['doc_image']) ? 'assets/images/profiles_doctors/' . htmlspecialchars($doctor['doc_image']) : 'assets/images/profiles_doctors/doctor-img-notfound.png'; ?>" alt="doc img">
                </div>
                <figcaption>
                    <div class="doc-name">
                        <span>Profile</span>
                        <h1>Dr. <?= $doctor['first_name'].' '. $doctor['last_name']?></h1>
                        <h2><?= $doctor['professional_type'].'<br>'. $doctor['specialization']?></h2>

                        <div class="gender-doc">
                            <p>Genre :
                                <?php 
                                    if ($doctor['gender'] === 'H') {
                                        echo 'Homme';
                                    } elseif ($doctor['gender'] === 'F') {
                                        echo 'Femme';
                                    } else {
                                        echo 'Non spécifié';
                                    }
                                ?>
                            </p>
                            <div>______________</div>
                        </div>
                    </div>


                    <div class="doc-information">
                        <h3>Horaires et contact:</h3>
                        <div class="infosup-doc">
                            <table class="doc-table-read">
                                <tbody>
                                    <tr>
                                        <th class="doc-day-read">Lundi</th>
                                        <td class="doc-hour-read"><?= $doctor['Monday_schedules']?></td>
                                    </tr>
                                    <tr>
                                        <th class="doc-day-read">Mardi</th>
                                        <td class="doc-hour-read"><?= $doctor['Tuesday_schedules']?></td>
                                    </tr>
                                    <tr>
                                        <th class="doc-day-read">Mercredi</th>
                                        <td class="doc-hour-read"><?= $doctor['Wednesday_schedules']?></td>
                                    </tr>
                                    <tr>
                                        <th class="doc-day-read">Jeudi</th>
                                        <td class="doc-hour-read"><?= $doctor['Thursday_schedules']?></td>
                                    </tr>
                                    <tr>
                                        <th class="doc-day-read">Vendredi</th>
                                        <td class="doc-hour-read"><?= $doctor['Friday_schedules']?></td>
                                    </tr>
                                    <tr>
                                        <th class="doc-day-read">Samedi</th>
                                        <td class="doc-hour-read"><?= $doctor['Saturday_schedules']?></td>
                                    </tr>
                                    <tr>
                                        <th class="doc-day-read">Dimanche</th>
                                        <td class="doc-hour-read"><?= $doctor['Sunday_schedules']?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="infospecial">
                                <!-- GENDER -->
                                <div class="doc-adress">
                                    <span class="underline">Adresse:</span>
                                    <p class="complet-adress">
                                        <span><?= $doctor['address']?></span>
                                        <span><?= $doctor['department']?></span>
                                        <span><?= $doctor['city']?></span>
                                    </p>
                                </div>


                                <!-- PAYMENT METHOD -->
                                <div>
                                    <p class="doc-method">mode paiement accepté</p>
                                    <span><?php
                                        // Vérifiez si payment_method n'est pas null ou vide
                                        if (!empty($doctor['payment_method'])) {
                                            // Convertir le SET en tableau
                                            $payment_methods = explode(',', $doctor['payment_method']);
                                            
                                            // Parcourir chaque payement_méthode et les afficher sur une nouvelle ligne
                                            foreach ($payment_methods as $method) {
                                                // Remplacer les underscores par des espaces
                                                $formatted_method = str_replace('_', ' ', $method);
                                                echo "<div>$formatted_method</div>";
                                            }
                                        } else {
                                            echo "<div>Aucune information de paiement disponible.</div>"; // Message alternatif si aucune info
                                        }
                                    ?></span>
                                </div>

                                <!-- PHONE -->
                                <div class="doc-tel">
                                    <p>Tel: <span><?= $doctor['phone']?></span></p>
                                </div>

                                <!-- AVAIBILITY -->
                                <div class="doc-bis">
                                    <p>Nouveaux patients: <span>
                                    <?php 
                                        if ($doctor['availability'] === 'Oui') {
                                            echo 'Oui';
                                        } elseif ($doctor['availability'] === 'Non') {
                                            echo 'Non';
                                        } else {
                                            echo 'Non spécifié';
                                        }
                                    ?>    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="holder-btn-doc">
                        <a class="btn-add-doc" href="gestions/addFavorite.php?doctor_id=<?php echo $doctor['id']; ?>">Ajouter aux Favoris</a>
                    </div>
                </figcaption>
            </figure>
        <?php
            }
        ?>
            
        </section>
    </main>


    <!-- FOOTER -->
<?php 
    include_once "gestions/footer.php";
?>

    <script src="javascript/script.js"></script>
</body>
</html>