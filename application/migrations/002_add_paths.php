<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_paths extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `paths` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名稱',
        `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '路徑',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '註冊時間',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "' COMMENT '更新時間',
        PRIMARY KEY (`id`),
        KEY `name_index` (`name`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );

    $this->db->query ("INSERT INTO `paths` (`id`, `name`, `value`, `created_at`, `updated_at`)
        VALUES (1, 'hosts', '/etc/hosts', '" . date ('Y-m-d H:i:s') . "', '" . date ('Y-m-d H:i:s') . "');");

    $this->db->query ("INSERT INTO `paths` (`id`, `name`, `value`, `created_at`, `updated_at`)
        VALUES (2, 'vhosts', '/etc/apache2/extra/httpd-vhosts.conf', '" . date ('Y-m-d H:i:s') . "', '" . date ('Y-m-d H:i:s') . "');");

    $this->db->query ("INSERT INTO `paths` (`id`, `name`, `value`, `created_at`, `updated_at`)
        VALUES (3, 'document_root', '/Library/WebServer/Documents', '" . date ('Y-m-d H:i:s') . "', '" . date ('Y-m-d H:i:s') . "');");
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `paths`;"
    );
  }
}