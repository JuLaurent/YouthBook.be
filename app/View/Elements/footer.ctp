<footer class='footer'>
    <span class='footer__content'>
        <?php echo $this->Html->link(
                'A propos',
                array('controller' => 'dynamicPages', 'action' => 'about'),
                array('title' => 'Aller à la page A propos', 'class' => 'footer__link')
            );
        ?>
        <span>-</span>
        <?php echo $this->Html->link(
                'Sagas',
                array('controller' => 'sagas', 'action' => 'index'),
                array('title' => 'Aller à la page des sagas', 'class' => 'footer__link')
            );
        ?>
    </span>
    <span class='important footer__content'>Site développé par Julien Laurent</span>
</footer>
