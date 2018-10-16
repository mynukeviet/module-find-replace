<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 07 Mar 2015 03:43:56 GMT
 */
if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!defined('NV_ADMIN')) {
    global $nv_Cache, $contents;

    $_sql = 'SELECT find_text, replace_text FROM ' . NV_PREFIXLANG . '_find_replace WHERE status=1';
    $list = $nv_Cache->db($_sql, 'id', 'find-replace');

    if (!empty($list)) {
        foreach ($list as $l) {
            $array_replace[$l['find_text']] = $l['replace_text'];
        }
    }

    foreach ($array_replace as $find => $replace) {
        $contents = str_replace($find, $replace, $contents);
    }
}
