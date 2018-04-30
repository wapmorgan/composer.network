<?php
$sizes = array(
    '0' => array(
        'height' => 16,
        'font' => 10,
        'char_width' => 6,
    ),
    '1' => array(
        'height' => 20,
        'font' => 12,
        'char_width' => 7,
    ),
    '2' => array(
        'height' => 22,
        'font' => 13,
        'char_width' => 8,
    ),
);
$package = isset($_GET['package']) && ($package = strtolower(trim($_GET['package']))) && preg_match('~^[a-z0-9-]+\/[a-z0-9-]+$~', $package) ? $package : 'wapmorgan/php-code-fixer';
$size = isset($_GET['size']) && in_array($_GET['size'], ['0', '1', '2']) ? $_GET['size'] : '1';
$h = $sizes[$size]['height'];
$font = $sizes[$size]['font'];
$char_width = $sizes[$size]['char_width'];
$label = isset($_GET['label']) ? preg_replace('~[^a-z0-9: ]~i', null, $_GET['label']) : 'packagist';
$p = strlen($label) * $char_width * 1.1;
     /*    THIS WIDTH FOR CHAR    */
$l = strlen($package) * $char_width * 1.1;

$total = $l + $p;
header('Content-Type: image/svg+xml');
?>
<svg xmlns="http://www.w3.org/2000/svg" width="<?=$total?>" height="<?=$h?>"
    xmlns:xlink="http://www.w3.org/1999/xlink">
    <linearGradient id="b" x2="0" y2="100%">
        <stop offset="0" stop-color="#bbb" stop-opacity=".1"/>
        <stop offset="1" stop-opacity=".1"/>
    </linearGradient>
    <mask id="a">
        <rect width="<?=$total?>" height="<?=$h?>" rx="3" fill="#fff"/>
    </mask>
    <g mask="url(#a)">
        <rect width="<?=$total?>" height="<?=$h?>" fill="#555"/>
        <rect xmlns="http://www.w3.org/2000/svg" width="<?=$p?>" height="<?=$h?>" fill="#28a3df"/>
        <rect x="<?=$p?>" width="<?=$l?>" height="<?=$h?>" fill="url(#b)"/>
    </g>
    <!-- <image x="5" y="1" width="18" height="17" xlink:href="composer.png"/> -->
    <g fill="#fff" text-anchor="middle" font-family="Courier New, monospace" font-size="<?=$font?>">
        <text x="<?=$p/2?>" y="<?=$h*0.75?>" fill="#010101" fill-opacity=".3"><?=$label?></text>
        <a fill="white" xlink:href="https://packagist.org/packages/<?=$package?>"><text x="<?=$p/2?>" y="<?=$h*0.7?>"><?=$label?></text></a>
        <text x="<?=$l/2+$p?>" y="<?=$h*0.75?>" fill="#010101" fill-opacity=".3"><?=$package?></text>
        <text x="<?=$l/2+$p?>" y="<?=$h*0.7?>"><?=$package?></text>
    </g>
