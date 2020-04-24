<?php if (!empty($heading)) : ?>
    <h3 class="navcodes-heading"><?= $heading ?></h3>
<?php endif; ?>
<div class="navcodes-wrap navcodes-tiles">
    <?php

    $items = get_field('menu_items', $menu->ID);

    if (is_array($items)) {
        foreach ($items as $item) {
            if (empty(@$item['title'])) {
                $item['title'] = 'Read More';
            }
            ?><a href="<?= @$item['link']['url'] ?>" target="<?= @$item['link']['target'] ?>" class="navcodes-item">
                <div class="navcodes-item-top">
                    <?php if (is_string($item['icon']) && !empty($item['icon'])) : ?>
                        <img src="<?= $item['icon'] ?>" />
                    <?php endif; if (is_string(@$item['link']['title']) && !empty($item['link']['title'])) : ?>
                        <h4><?= $item['link']['title'] ?></h4>
                    <?php endif; ?>
                </div>
                <div class="navcodes-item-bottom"><span><?= $item['title'] ?></span></div>
            </a><?php
        }
    }

    ?>
</div>
