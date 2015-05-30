<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Platform extends Site_controller {
  private $account = 'oa';
  private $password = '123456';

  public function __construct () {
    parent::__construct ();
  }

  public function login () {
    if (identity ()->get_session ('is_login'))
      return redirect ('');

    $message = identity ()->get_session ('_flash_error', true);
    $account   = identity ()->get_session ('account', true);

    $this->load_view (array ('message' => $message, 'account' => $account));
  }

  public function signin () {
    if (!$this->has_post ())
      return redirect (array ($this->get_class (), 'login'));

    if (identity ()->get_session ('is_login'))
      return redirect ('');

    $account  = trim ($this->input_post ('account'));
    $password = trim ($this->input_post ('password'));

    if (!(($this->account == $account) && ($this->password == $password)))
      return identity ()->set_session ('_flash_error', '登入失敗，請再確認一次帳號與密碼！', true)
                        ->set_session ('account', $account, true) && redirect (array ($this->get_class (), 'login'), 'refresh');

    identity ()->set_session ('_flash_message', '登入成功！', true)
               ->set_session ('is_login', true);
    return redirect ('');
  }

  public function logout () {
    if (!identity ()->get_session ('is_login'))
      return redirect ('');

    identity ()->set_session ('_flash_message', '登出成功！', true)
               ->set_session ('is_login', false);
    return redirect ('');
  }
}
