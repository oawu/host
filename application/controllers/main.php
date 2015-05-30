<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Main extends Site_controller {

  public function __construct () {
    parent::__construct ();

    if (!identity ()->get_session ('is_login'))
      return redirect (array ('platform', 'login'));
  }

  public function demo ($offset = 0) {
    $this->load->library ('CreateDemo');

    Host::create (array (
      'name' => CreateDemo::text (2, 5),
      'domain' => CreateDemo::eng () . '.ioa.tw',
      'document_root' => '~/www/host/',
      ));
  }
  public function index ($offset = 0) {
    $message = identity ()->get_session ('_flash_message', true);
    $error = identity ()->get_session ('_flash_error', true);

    $qks = array ('name', 'domain', 'document_root');
    $qs = array_filter (array_combine($qks, array_map (function ($q) { return $this->input_get ($q); }, $qks)));
    $temp = array_slice ($qs, 0);
    array_walk ($temp, function (&$v, $k) { $v = $k . '=' . $v; });
    $q = implode ('&amp;', $temp);

    $temp = array_slice ($qs, 0);
    array_walk ($temp, function (&$v, $k) { $v = $k . ' LIKE ' . Host::escape ('%' . $v . '%'); });
    $conditions = array (implode (' AND ', $temp));

    $limit = 15;
    $total = Host::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;

    $this->load->library ('pagination');
    $pagination_config = array (
      'total_rows' => $total,
      'num_links' => 5,
      'per_page' => $limit,
      'base_url' => base_url (array ('%s', $q ? '?' . $q : '')),
      'uri_segment' => $offset ? 1 : 0,
      'page_query_string' => false,
      'first_link' => '第一頁', 'last_link' => '最後頁', 'prev_link' => '上一頁', 'next_link' => '下一頁',
      'full_tag_open' => '<ul class="pagination">', 'full_tag_close' => '</ul>', 'first_tag_open' => '<li>', 'first_tag_close' => '</li>',
      'prev_tag_open' => '<li>', 'prev_tag_close' => '</li>', 'num_tag_open' => '<li>', 'num_tag_close' => '</li>',
      'cur_tag_open' => '<li class="active"><a href="#">', 'cur_tag_close' => '</a></li>',
      'next_tag_open' => '<li>', 'next_tag_close' => '</li>', 'last_tag_open' => '<li>', 'last_tag_close' => '</li>',
      );

    $this->pagination->initialize ($pagination_config);
    $pagination = $this->pagination->create_links ();
    
    $hosts = Host::find ('all', array ('offset' => $offset, 'limit' => $limit, 'order' => 'id DESC', 'conditions' => $conditions));

    $this->load_view (array (
      'pagination' => $pagination,
      'hosts' => $hosts,
      'qs' => $qs,
      'message' => $message,
      'error' => $error
      ));
  }

  public function set () {
    $message = identity ()->get_session ('_flash_message', true);
    $error = identity ()->get_session ('_flash_error', true);

    if (!($path_hosts = Path::find_by_name ('hosts')))
      $path_hosts = Path::create (array ('name' => 'hosts', 'value' => '/etc/hosts'));
    
    if (!($path_vhosts = Path::find_by_name ('vhosts')))
      $path_vhosts = Path::create (array ('name' => 'vhosts', 'value' => '/etc/apache2/extra/httpd-vhosts.conf'));

    if (!($path_document_root = Path::find_by_name ('document_root')))
      $path_document_root = Path::create (array ('name' => 'document_root', 'value' => '/Library/WebServer/Documents'));

    $hosts_path = ($hosts_path = identity ()->get_session ('hosts', true)) ? $hosts_path : $path_hosts->value;
    $vhosts_path = ($vhosts_path = identity ()->get_session ('vhosts', true)) ? $vhosts_path : $path_vhosts->value;
    $document_root_path = ($document_root_path = identity ()->get_session ('document_root', true)) ? $document_root_path : $path_document_root->value;

    $this->load_view (array (
      'message' => $message,
      'error' => $error,
      'hosts_path' => $hosts_path,
      'vhosts_path' => $vhosts_path,
      'document_root_path' => $document_root_path,
      ));
  }
  public function setting () {
    $hosts = trim ($this->input_post ('hosts'));
    $vhosts = trim ($this->input_post ('vhosts'));
    $document_root = trim ($this->input_post ('document_root'));

    if (!($hosts && $vhosts && $document_root))
      return identity ()->set_session ('_flash_error', '輸入資訊有誤！', true)
                        ->set_session ('hosts', $hosts, true)
                        ->set_session ('vhosts', $vhosts, true)
                        ->set_session ('document_root', $document_root, true) && redirect ('', 'refresh');

    if (!(file_exists ($hosts)))
      return identity ()->set_session ('_flash_error', 'hosts 檔案不存在，請確認檔案是否存在！', true)
                        ->set_session ('hosts', $hosts, true)
                        ->set_session ('vhosts', $vhosts, true)
                        ->set_session ('document_root', $document_root, true) && redirect ('', 'refresh');

    if (!(file_exists ($vhosts)))
      return identity ()->set_session ('_flash_error', 'vhosts 檔案不存在，請確認檔案是否存在！', true)
                        ->set_session ('hosts', $hosts, true)
                        ->set_session ('vhosts', $vhosts, true)
                        ->set_session ('document_root', $document_root, true) && redirect ('', 'refresh');

    if (!(file_exists ($document_root)))
      return identity ()->set_session ('_flash_error', 'document_root 資料夾不存在，請確認資料夾是否存在！', true)
                        ->set_session ('hosts', $hosts, true)
                        ->set_session ('vhosts', $vhosts, true)
                        ->set_session ('document_root', $document_root, true) && redirect ('', 'refresh');

    if (!(is_writable ($hosts)))
      return identity ()->set_session ('_flash_error', 'hosts 檔案不能讀寫！<br />請輸入指令: <b>sudo chmod 666 ' . $hosts . '</b>', true)
                        ->set_session ('hosts', $hosts, true)
                        ->set_session ('vhosts', $vhosts, true)
                        ->set_session ('document_root', $document_root, true) && redirect ('', 'refresh');

    if (!(is_writable ($vhosts)))
      return identity ()->set_session ('_flash_error', 'hosts 檔案不能讀寫！<br />請輸入指令: <b>sudo chmod 666 ' . $vhosts . '</b>', true)
                        ->set_session ('hosts', $hosts, true)
                        ->set_session ('vhosts', $vhosts, true)
                        ->set_session ('document_root', $document_root, true) && redirect ('', 'refresh');

    if (!(is_dir ($document_root)))
      return identity ()->set_session ('_flash_error', 'document_root 不是資料夾，請確認 document_root 是資料夾路徑！', true)
                        ->set_session ('hosts', $hosts, true)
                        ->set_session ('vhosts', $vhosts, true)
                        ->set_session ('document_root', $document_root, true) && redirect ('', 'refresh');

    if (!($hosts_path = Path::find_by_name ('hosts'))) {
      $hosts_path = Path::create (array ('name' => 'hosts', 'value' => $hosts));
    } else {
      $hosts_path->value = $hosts;
      $hosts_path->save ();
    }
    if (!($vhosts_path = Path::find_by_name ('vhosts'))) {
      $vhosts_path = Path::create (array ('name' => 'vhosts', 'value' => $vhosts));
    } else {
      $vhosts_path->value = $vhosts;
      $vhosts_path->save ();
    }
    if (!($document_root_path = Path::find_by_name ('document_root'))) {
      $document_root_path = Path::create (array ('name' => 'document_root', 'value' => $document_root));
    } else {
      $document_root_path->value = $document_root;
      $document_root_path->save ();
    }

    

    identity ()->set_session ('_flash_message', '設定成功！請重新啟動 apache2<br />輸入指令: <b>sudo apachectl restart</b>', true);
    
    return redirect ('set');
  }
  public function add () {

    $error = identity ()->get_session ('_flash_error', true);
    $name = identity ()->get_session ('name', true);
    $domain = identity ()->get_session ('domain', true);
    $document_root = identity ()->get_session ('document_root', true);

    $this->load_view (array (
      'error' => $error,
      'name' => $name,
      'domain' => $domain,
      'document_root' => $document_root,
      ));
  }
  public function create () {
    $name = trim ($this->input_post ('name'));
    $domain = trim ($this->input_post ('domain'));
    $document_root = trim ($this->input_post ('document_root'));

    if (!($name && $domain && $document_root))
      return identity ()->set_session ('_flash_error', '輸入資訊有誤！', true)
                        ->set_session ('name', $name, true)
                        ->set_session ('domain', $domain, true)
                        ->set_session ('document_root', $document_root, true) && redirect (array ($this->get_class (), 'add'), 'refresh');

    if (Host::find_by_domain ($domain))
      return identity ()->set_session ('_flash_error', '重複 Domain，請再檢查一遍！', true)
                        ->set_session ('name', $name, true)
                        ->set_session ('domain', $domain, true)
                        ->set_session ('document_root', $document_root, true) && redirect (array ($this->get_class (), 'add'), 'refresh');

    if (!verifyCreateOrm ($host = Host::create (array ('name' => $name, 'domain' => $domain, 'document_root' => $document_root))))
      return identity ()->set_session ('_flash_error', '新增失敗，請程式設計人員確認狀況！', true)
                        ->set_session ('name', $name, true)
                        ->set_session ('domain', $domain, true)
                        ->set_session ('document_root', $document_root, true) && redirect (array ($this->get_class (), 'add'), 'refresh');

    identity ()->set_session ('_flash_message', '新增成功！', true);
    
    return redirect ('');

  }
}
