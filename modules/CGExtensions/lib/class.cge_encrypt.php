<?php

class cge_encrypt
{

  static public function encrypt($key,$data)
  {
    if( !function_exists('mcrypt_module_open') ) return FALSE;
    srand((double) microtime() * 1000000);
    $encdata = FALSE;
    $td = @mcrypt_module_open(MCRYPT_DES,'',MCRYPT_MODE_ECB,'');
    if( $td === FALSE ) return FALSE;

    $key = substr($key,0,mcrypt_enc_get_key_size($td));
    $iv_size = mcrypt_enc_get_iv_size($td);
    $iv = @mcrypt_create_iv($iv_size, MCRYPT_RAND);

    // initialize encryption handle
    $tmp = @mcrypt_generic_init($td,$key, $iv);
    if( $tmp != -1 )
      {
	$tmp = mcrypt_generic($td,$data);
	@mcrypt_generic_deinit($td);
	$encdata = $tmp;
      }
    @mcrypt_module_close($td);
    return $encdata;
  }


  static public function decrypt($key,$encdata)
  {
    if( !function_exists('mcrypt_module_open') ) return FALSE;
    $data = FALSE;
    $td = @mcrypt_module_open(MCRYPT_DES,'',MCRYPT_MODE_ECB,'');
    if( $td === FALSE ) return FALSE;

    $key = substr($key,0,mcrypt_enc_get_key_size($td));
    $iv_size = @mcrypt_enc_get_iv_size($td);
    $iv = @mcrypt_create_iv($iv_size, MCRYPT_RAND);

    // initialize encryption handle
    $tmp = @mcrypt_generic_init($td,$key, $iv);
    if( $tmp != -1 )
      {
	$data = @mdecrypt_generic($td,$encdata);
	mcrypt_generic_deinit($td);
      }
    @mcrypt_module_close($td);
    return $data;
  }

} // end of class

?>