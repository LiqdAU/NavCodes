<ul class="menu-sc-wrap menu-sc-list">
    <?php
    $items = get_field('menu_items', $menu->ID);

    if (!empty($heading)) : ?>
        <li class="menu-sc-heading"><?= $heading ?></li>
    <?php endif;

    if (is_array($items)) {
        foreach ($items as $item) {
            ?><li><a href="<?= @$item['link']['url'] ?>" target="<?= @$item['link']['target'] ?>" class="menu-sc-item"><?= @$item['link']['title'] ?></a></li><?php
        }
    }

    ?>
</ul>
