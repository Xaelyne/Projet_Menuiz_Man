<?php 
    if($action != 'accueil' && $action != 'connexion' && $action != 'accueilAdmin' && $action != 'accueilTechnicienHOT' && $action != 'accueilTechnicienSAV') { 
        // récupération du rôle utilisateur grâce à son id
        $id = $_GET['id'];
        $user = getUtilisateur($id);
        $role = $user['roleUtilisateur']; // 1 2 3
//var_dump($role); // OK !

        if($role == 1) $retourAccueil = "accueilAdmin";
        else if ($role == 2) $retourAccueil = "accueilTechnicienHOT";
        else if ($role == 3) $retourAccueil = "accueilTechnicienSAV";
        
?>
    <footer class="text-center">
        <br><br>
        <a href="index.php?action=<?=$retourAccueil?>&id=<?=$id?>"><button class="btn bouton">Retour à l'accueil</button></a>
    </footer>
<?php
    } 
?>

<!-- TEST -->
<div class="container">
    <p>VUE FOOTER</p>
    <h6><b>Mot de passe</b> : 123456</h6>
    <h6><b>Les utilisateurs</b> : </h6>
    <div class="container">
        <p>tartenpion : Admin</p>
        <p>jeannemar : Technicien Hotline</p>
        <p>ironman : Technicien SAV</p>
    </div>
</div>

</body>
</html>