<form action="index.php" class="container p-5 formConnexion text-start">
    <input type="hidden" name="action" value="connexion">
    <div class="row">
        <label for="user">Nom d'utilisateur :</label>
        <input type="text" name="user" class="inputText">
    </div>
    <div class="row mt-3">
        <label for="pass">Mot de passe :</label>
        <input type="password" name="pass"  class="inputText">
    </div>
    <div class="text-center mt-3">
        <input type="submit" value="Valider" class="bouton">
    </div>
</form>