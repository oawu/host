<?php echo render_cell ('frame_cell', 'header', array ()); ?>

<div id='container'>

<?php 
  if ($message) { ?>
    <div class='message'><?php echo $message;?></div>
<?php 
  }
  if ($error) { ?>
    <div class='error'>asd</div>
<?php 
  } ?>
  <form action='<?php echo base_url ('setting'); ?>' method='post'>
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

<?php 
  if ($error) { ?>
    <div class='error'><?php echo $error;?></div>
<?php 
  } ?>
</div>  

<?php echo render_cell ('frame_cell', 'footer', array ()); ?>
