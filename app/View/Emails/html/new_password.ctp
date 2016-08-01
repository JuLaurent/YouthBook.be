<div>
    <p>Bonjour <?php echo $mailData['User']['username'] ?>, voici les instructions pour récupérer votre compte.</p>
    <p>En cliquant sur le bouton ci-dessous, vous serez redigiré vers une page qui vous permettra de modifier votre mot de passe.</p>
    <p>Une fois votre mot de passe modifié, vous serez alors redirigé vers la page de connexion du site.</p>

    <div class='mail__buttons'>
        <span class='mail__button'>
            <a href='http://youthbook.be/users/newPassword/<?php echo $mailData['User']['slug'] ?>/<?php echo $mailData['User']['token'] ?>' title='Aller à la page de modification de mot de passe (après oubli)'>Modifier mon mot de passe</a>
        </span>
    </div>

    <p>L’équipe de YouthBook.be</p>
</div>
