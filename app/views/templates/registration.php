
<div class ="block-elem">
    <div class="connexion-block">
        <div class="connexion-form">
            <h2 class="block-element-title connexion-title">Inscription</h2>
            <form action="index.php?action=register" method="post" class="connexion-form">
                <div class="input-label-combo">
                    <label for="pseudo"  class="block-element-label">Pseudo</label>
                    <input type="text" class="block-element-input" name="pseudo" id="pseudo" required>
                </div>
                <!-- <div class="input-label-combo">
                <label for="image" class="block-element-label">Image de profil</label>
                <input type="file" 
                    name="image" 
                    id="image" 
                    accept="image/*">
                </div> -->
                <div class="input-label-combo">
                    <label for="mail" class="block-element-label">Adresse email</label>
                    <input type="text" class="block-element-input" name="mail" id="mail" required>
                </div>
                <div class="input-label-combo">
                    <label for="password" class="block-element-label">Mot de passe</label>
                    <input type="password" class="block-element-input" name="password" id="password" required>
                </div>
                <button class="main-button full-button connexion-button">S'inscrire</button>
                <p class="form-subtitle-inscription">Déja un compte ? <a href="index.php?action=showConnect" class="connexion-link">Connectez-vous</a></p>
            </form>
        </div>
        <img class="connexion-image" src="assets/books.png" alt="bibliotheque pleine de livres">
    </div>
</div>
