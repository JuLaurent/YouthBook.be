<footer class='footer'>
    <nav class='footer__nav'>
        <div class="footer__nav-title hidden">
            <h2>Menu de navigation Footer</h2>
        </div>
        <span class='footer__nav-item'>
            <?php echo $this->Html->link(
                    'A propos',
                    array('controller' => 'dynamicPages', 'action' => 'about'),
                    array('title' => 'Aller à la page A propos', 'class' => 'footer__link')
                );
            ?>
        </span>
        <span class='footer__nav-item'>
            <?php echo $this->Html->link(
                    'Sagas',
                    array('controller' => 'sagas', 'action' => 'index'),
                    array('title' => 'Aller à la page des sagas', 'class' => 'footer__link')
                );
            ?>
        </span>
    </nav>
    <span class='footer__creator'>Site développé par Julien Laurent</span>
</footer>
