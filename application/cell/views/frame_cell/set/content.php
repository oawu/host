<!-- <form class='bar' action='<?php echo base_url ('set'); ?>' method='post'>
  <div class='l'>
    <label for='hosts'>
      hosts:
      <input type='text' id='hosts' name='hosts' value='<?php echo $hosts_path ? $hosts_path : $hosts->value;?>' placeholder='請輸入 hosts 檔案位置..' maxlength='200' pattern=".{1,200}" required title="請輸入 hosts 檔案位置.."/>
    </label>
    
    <label for='vhosts'>
      httpd-vhosts:
      <input type='text' id='vhosts' name='vhosts' value='<?php echo $vhosts_path ? $vhosts_path : $httpd_vhosts->value;?>' placeholder='請輸入 vhosts 檔案位置..' maxlength='200' pattern=".{1,200}" required title="請輸入 vhosts 檔案位置.."/>
    </label>
  </div>
  <div class='r'>
    <button type='submit'>更新</button>
  </div>
</form>   -->
<form action='<?php echo base_url ('set'); ?>' method='post'>
    <table class='table-form'>
      <tbody>
        <tr>
          <th width='200'>hosts</th>
          <td>
            <input type='text' name='hosts' value='<?php echo $hosts_path ? $hosts_path : $hosts->value;?>' placeholder='請輸入 hosts 檔案位置..' maxlength='200' pattern=".{1,200}" required title="請輸入 hosts 檔案位置.."/>
          </td>
        </tr>
        <tr>
          <th>httpd-vhosts</th>
          <td>
            <input type='text' name='vhosts' value='<?php echo $vhosts_path ? $vhosts_path : $httpd_vhosts->value;?>' placeholder='請輸入 vhosts 檔案位置..' maxlength='200' pattern=".{1,200}" required title="請輸入 vhosts 檔案位置.."/>
          </td>
        </tr>
        <tr>
          <th>DocumentRoot</th>
          <td>
            <input type='text' name='document_root' value='<?php echo $document_root_path ? $document_root_path : $document_root->value;?>' placeholder='請輸入 DocumentRoot 檔案位置..' maxlength='200' pattern='.{1,200}' required title='請輸入 DocumentRoot 檔案位置..' />
          </td>
        </tr>
        <tr>
          <td colspan='2'>
            <a class='button' href='<?php echo base_url ('');?>'>列表</a>
            <button type='reset' class='button'>重填</button>
            <button type='submit' class='button'>確定</button>
          </td>
        </tr>
      </tbody>
    </table>
  </form>