<?php

return [
    'token' => env('TINYMCE_TOKEN', ''),
    'plugins' => [
        'anchor', 'autolink', 'autoresize', 'charmap', 'codesample', 'code', 'emoticons', 'image', 'link',
        'lists', 'advlist', 'media', 'searchreplace', 'table', 'wordcount', 'directionality',
        'fullscreen', 'help', 'nonbreaking', 'pagebreak', 'preview', 'visualblocks', 'visualchars'
    ],
    'menubar' => 'file edit insert view format table tools',
    'toolbar' => 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | '
        . 'link image media table tabledelete hr nonbreaking pagebreak | align lineheight | '
        . 'numlist bullist indent outdent | emoticons charmap | removeformat | codesample | ltr rtl | '
        . 'tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | '
        . 'tableinsertcolbefore tableinsertcolafter tabledeletecol | '
        . 'fullscreen preview print visualblocks visualchars code | help',
    'options' => [
        'table_class_list' => [
            ['title' => 'Bootstrap Table', 'value' => 'table table-striped table-bordered']
        ]
    ],
    'callbacks' => [],
];
