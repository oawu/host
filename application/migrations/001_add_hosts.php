<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_hosts extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `hosts` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名稱',
        `domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'domain',
        `document_root` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'document root 位置',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '註冊時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        PRIMARY KEY (`id`),
        UNIQUE KEY `domain_unique` (`domain`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );

    $this->db->query ("INSERT INTO `hosts` (`id`, `name`, `domain`, `document_root`, `created_at`, `updated_at`)
        VALUES (1, '本機', 'localhost', '', '" . date ('Y-m-d H:i:s') . "', '" . date ('Y-m-d H:i:s') . "');");
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `hosts`;"
    );
  }
}