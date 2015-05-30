<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Frame_cell extends Cell_Controller {

  /* render_cell ('frame_cell', 'header', array ()); */
  // public function _cache_header () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function header () {
    $as = array (
      'l' => array (
        array ('name' => '列表', 'href' => base_url (), 'show' => true),
        array ('name' => '設定', 'href' => base_url ('set'), 'show' => true),
        ),
      'r' => array (
        array ('name' => '登入', 'href' => base_url ('platform/login'), 'show' => identity ()->get_session ('is_login') ? false : true),
        array ('name' => '登出', 'href' => base_url ('platform/logout'), 'show' => identity ()->get_session ('is_login') ? true : false),
        ),
      );
    return $this->setUseCssList (true)
                ->load_view (array ('as' => $as));
  }

  /* render_cell ('frame_cell', 'footer', array ()); */
  // public function _cache_footer () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function footer () {
    return $this->setUseCssList (true)
                ->load_view ();
  }

  /* render_cell ('frame_cell', 'conditions', $qs); */
  // public function _cache_conditions () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function conditions ($qs) {
    return $this->setUseCssList (true)
                ->load_view (array ('qs' => $qs));
  }

  /* render_cell ('frame_cell', 'set', array ()); */
  // public function _cache_set () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function set () {
    if (!($hosts = Path::find_by_name ('hosts')))
      $hosts = Path::create (array ('name' => 'hosts', 'value' => '/etc/hosts'));
    
    if (!($httpd_vhosts = Path::find_by_name ('httpd-vhosts')))
      $httpd_vhosts = Path::create (array ('name' => 'httpd-vhosts', 'value' => '/etc/apache2/extra/httpd-vhosts.conf'));

    if (!($document_root = Path::find_by_name ('document_root')))
      $document_root = Path::create (array ('name' => 'document_root', 'value' => '/Library/WebServer/Documents'));

    $hosts_path = identity ()->get_session ('hosts', true);
    $vhosts_path = identity ()->get_session ('vhosts', true);
    $document_root_path = identity ()->get_session ('document_root', true);

    return $this->setUseCssList (true)
                ->load_view (array (
                    'hosts_path' => $hosts_path,
                    'vhosts_path' => $vhosts_path,
                    'document_root_path' => $document_root_path,
                    'hosts' => $hosts,
                    'httpd_vhosts' => $httpd_vhosts,
                    'document_root' => $document_root,
                  ));
  }

  /* render_cell ('frame_cell', 'hosts', array ($hosts)); */
  // public function _cache_hosts () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function hosts ($hosts) {
    return $this->setUseCssList (true)
                ->load_view (array ('hosts' => $hosts));
  }
  /* render_cell ('frame_cell', 'pagination', $pagination); */
  // public function _cache_pagination () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function pagination ($pagination) {
    return $this->setUseCssList (true)
                ->load_view (array ('pagination' => $pagination));
  }
}