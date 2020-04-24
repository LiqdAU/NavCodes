<ul class="navcodes-wrap navcodes-list">
    <?php
    $items = get_field('menu_items', $menu->ID);

    if (!empty($heading)) : ?>
        <li class="navcodes-heading"><?= $heading ?></li>
    <?php endif;

    if (is_array($items)) {
        foreach ($items as $item) {
            ?><li><a href="<?= @$item['link']['url'] ?>" target="<?= @$item['link']['target'] ?>" class="navcodes-item"><?= @$item['link']['title'] ?></a></li><?php
        }
    }

    ?>
</ul>
