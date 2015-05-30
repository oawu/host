<form action='<?php echo base_url ('');?>' method='get'>
  <div class='conditions'>
    <div class='l'>
      <input type='text' name='name' value='<?php echo isset ($qs['name']) ? $qs['name'] : '';?>' placeholder='名稱..' />
      <input type='text' name='domain' value='<?php echo isset ($qs['domain']) ? $qs['domain'] : '';?>' placeholder='網址..' />
      <input type='text' name='document_root' value='<?php echo isset ($qs['document_root']) ? $qs['document_root'] : '';?>' placeholder='位置..' />
    </div>
    <div class='r'>
      <button type='submit'>尋找</button>
    </div>
  </div>
</form>
