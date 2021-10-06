<article>

</article>

<aside>
    <?php
    foreach ($asides['right'] as $widget) {
    ?>
        <div class="widget">
            <h2><?php $widget['title'] ?></h2>
            <?php $widget['content'] ?>
        </div>
    <?php
    }
    ?>
</aside>