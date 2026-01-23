
<div class="connection-form">
    <form action="index.php?action=register" method="post" class="foldedCorner">
        <h2>Registration</h2>
        <div class="formGrid">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" required>
            <label for="image" class="form-group__label">Book Cover Image</label>
            <input type="file" 
                   name="image" 
                   id="image" 
                   accept="image/*">
            <label for="mail">Adresse email</label>
            <input type="text" name="mail" id="mail" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <button class="submit">S'inscrire</button>
        </div>
    </form>
    <p>Déjà inscrit ? <a>Connectez-vous</a></p>
</div>