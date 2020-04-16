<?php global $post;

$shortcode = empty($post->post_name) ?
    'Your shortcode will be displayed here once the post has been saved.' :
    "[show-menu menu=\"{$post->post_name}\"]";

?>
<br /><br />
<div><b>Shortcode</b> <input style="display: block; margin-top: 5px; width: 100%" type="text" readonly="readonly" value="<?= str_replace("\"", "&quot;", $shortcode) ?>" /></div>
