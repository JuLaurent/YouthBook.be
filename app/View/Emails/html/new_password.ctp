<div>
    <p>Bonjour <?php echo $mailData['User']['username'] ?>, voici les instructions pour récupérer votre compte.</p>
    <p>En cliquant sur le bouton ci-dessous, vous serez redigiré vers une page qui vous permettra de modifier votre mot de passe.</p>
    <p>Une fois votre mot de passe modifié, vous serez alors redirigé vers la page de connexion du site.</p>

    <div style="text-align:center;margin:60px 30px;" class='mail__buttons'>
        <span style="width:200px;display:inline-block;" class='mail__button'>
            <a href='http://youthbook.be/users/newPassword/<?php echo $mailData['User']['slug'] ?>/<?php echo $mailData['User']['token'] ?>' title='Aller à la page de modification de mot de passe (après oubli)' style="box-sizing:border-box;display:inline-block;width:100%;padding:1.4em;color:white;background-color:#002138;text-align:center;text-decoration:none;box-shadow:-1px 1px 5px 0px rgba(0,0,0,0.75);">Modifier mon mot de passe</a>
        </span>
    </div>

    <p>L’équipe de YouthBook.be</p>
</div>
