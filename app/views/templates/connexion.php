
<div class ="block-elem">
    <div class="connexion-block">
        <div class="connexion-form">
            <h2 class="block-element-title connexion-title">Connexion</h2>
            <form action="index.php?action=connect" method="post" class="connexion-form">
                <div class="input-label-combo">
                    <label for="mail" class="block-element-label">Adresse mail</label>
                    <input type="text" class="block-element-input" name="mail" id="mail" required>
                </div>
                <div class="input-label-combo">
                    <label for="password" class="block-element-label">Mot de passe</label>
                    <input type="password" class="block-element-input" name="password" id="password" required>
                </div>
                <button class="main-button full-button connexion-button">Se connecter</button>
            </form>
            <p class="form-subtitle">Pas de compte ? <a href="index.php?action=showRegister" class="connexion-link">Inscrivez-vous</a></p>
        </div>
        <img class="connexion-image" src="assets/books.png" alt="bibliotheque pleine de livres">
    </div>
</div>