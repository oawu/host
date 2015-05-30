<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_records extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `records` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名稱',
        `introduction` text COMMENT '內容',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        PRIMARY KEY (`id`),
        KEY `name_index` (`name`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `records`;"
    );
  }
}