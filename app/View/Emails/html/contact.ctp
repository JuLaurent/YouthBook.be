<div>
    <dl class='contact__informations'>
        <dt class='contact__term'>Nom</dt>
        <dd class='contact__description'><?php echo $mailData['Contact']['name']; ?></dd>
        <dt class='contact__term'>Adresse mail</dt>
        <dd class='contact__description'><?php echo $mailData['Contact']['mail']; ?></dd>
        <dt class='contact__term'>Sujet</dt>
        <dd class='contact__description'><?php echo $mailData['Contact']['subject']; ?></dd>
        <dt class='contact__term'>Message</dt>
        <dd class='contact__description'><?php echo $mailData['Contact']['text']; ?></dd>
    </dl>
</div>
