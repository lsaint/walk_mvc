
<?php

return [
    'title' => 'Site Settings',

    'edit_fields' => array(
    'site_name' => array(
        'title' => 'Name',
        'type' => 'text',
    ),
    'page_cache_lifetime' => array(
        'title' => 'Page Cache Lifetime (in minutes)',
        'type' => 'number',
    ),
    'logo' => array(
        'title' => 'Image (200 x 150)',
        'type' => 'image',
        'naming' => 'random',
        'location' => 'public/photo/',
        'size_limit' => 2,
        'sizes' => array(
            array(200, 150, 'crop', 'public/photo', 100),
        )
    )
    ),
];
