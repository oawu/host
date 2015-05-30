<?php echo render_cell ('frame_cell', 'header', array ()); ?>

<div id='container'>

  <?php
    if ($error) { ?>
      <div class='error'><?php echo $error;?></div>
  <?php
    } ?>
  <form action='<?php echo base_url (array ('create'));?>' method='post'>
    <table class='table-form'>
      <tbody>
        <tr>
          <th>名稱</th>
          <td>
            <input type='text' name='name' value='<?php echo $name;?>' placeholder='請輸入名稱..' maxlength='200' pattern='.{1,200}' required title='請輸入名稱..' />
          </td>
        </tr>
        <tr>
          <th>網址</th>
          <td>
            <input type='text' name='domain' value='<?php echo $domain;?>' placeholder='請輸入網址..' maxlength='200' pattern='.{1,200}' required title='請輸入網址..' />
          </td>
        </tr>
        <tr>
          <th>位置</th>
          <td>
            <input type='text' name='document_root' value='<?php echo $document_root;?>' placeholder='請輸入位置..' maxlength='200' pattern='.{1,200}' required title='請輸入位置..' />
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
</div>  

<?php echo render_cell ('frame_cell', 'footer', array ()); ?>
