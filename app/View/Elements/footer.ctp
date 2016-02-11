<footer class='footer'>
    <span class='footer__content'>
        <?php echo $this->Html->link(
                'A propos',
                array('controller' => 'dynamicPages', 'action' => 'about'),
                array('title' => 'Aller à la page A propos', 'class' => 'footer__link')
            );
        ?>
    </span>
    <span class='important footer__content'>Site développé par Julien Laurent</span>
</footer>
