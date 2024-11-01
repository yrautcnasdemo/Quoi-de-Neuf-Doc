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
