<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-10-2010 20:59
 */
if (!defined('NV_IS_FILE_MODULES')) {
    die('Stop!!!');
}

$sql_drop_module = array();
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data;

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  find_text varchar(255) NOT NULL DEFAULT '',
  replace_text text NOT NULL,
  status tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

// plugin
$plugin_file = 'find_replace_text.php';
$plugin_area = 4;

$_sql = 'SELECT max(weight) FROM ' . $db_config['prefix'] . '_plugin WHERE plugin_area=' . $plugin_area;
$weight = $db->query($_sql)->fetchColumn();
$weight = intval($weight) + 1;

try {
    $sth = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_plugin (plugin_file, plugin_area, weight) VALUES (:plugin_file, :plugin_area, :weight)');
    $sth->bindParam(':plugin_file', $plugin_file, PDO::PARAM_STR);
    $sth->bindParam(':plugin_area', $plugin_area, PDO::PARAM_INT);
    $sth->bindParam(':weight', $weight, PDO::PARAM_INT);
    $sth->execute();
    nv_save_file_config_global();
} catch (PDOException $e) {
    //
}