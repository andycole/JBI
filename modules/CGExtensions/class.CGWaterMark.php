<?php

define('CGWATERMARK_ALIGN_UL',0);
define('CGWATERMARK_ALIGN_UC',1);
define('CGWATERMARK_ALIGN_UR',2);
define('CGWATERMARK_ALIGN_ML',3);
define('CGWATERMARK_ALIGN_MC',4);
define('CGWATERMARK_ALIGN_MR',5);
define('CGWATERMARK_ALIGN_LL',6);
define('CGWATERMARK_ALIGN_LC',7);
define('CGWATERMARK_ALIGN_LR',8);
define('CGWATERMARK_ERROR_NOTREADY',1000);
define('CGWATERMARK_ERROR_BADFILE',1001);
define('CGWATERMARK_ERROR_BADFILETYPE',1002);
define('CGWATERMARK_ERROR_NOFILE',1003);
define('CGWATERMARK_ERROR_CREATEWM',1004);
define('CGWATERMARK_ERROR_LOADIMG',1005);
define('CGWATERMARK_ERROR_OTHER',1006);

class CGWatermark
{
  var $_text;
  var $_bg_color;
  var $_text_color;
  var $_text_angle;
  var $_text_font;
  var $_text_size;
  var $_wmimg_file;
  var $_alignment;
  var $_hmargin;
  var $_vmargin;
  var $_padding_x;
  var $_padding_y;
  var $_transparent;
  var $_translucency;

  var $h_wmimage;
  var $h_resultimage;
  var $t_wmsize;
  var $h_textcolor;
  var $t_error;

  function CGWatermark()
    {
      $this->h_wmimage = '';
      $this->h_resultimage = '';
      $this->h_textcolor = '';
      $this->h_bgcolor = '';
      $this->t_wmsize = '';
      $this->t_error = 0;

      $this->_transparent = 1;
      $this->_hmargin = 20;
      $this->_vmargin = 20;
      $this->_padding_x = 5;
      $this->_padding_y = 5;
      $this->_text='';
      $this->_bg_color = array(0,0,0); // black
      $this->_text_color= array(255,255,255); // white
      $this->_text_angle = 0;
      $this->_text_font='';
      $this->_text_size='';
      $this->_wmimg_file = '';
      $this->_alignment = CGWATERMARK_ALIGN_MC;
      $this->_translucency = 100;
    }

  function GetError()
    {
      return $this->t_error;
    }

  function SetWatermarkText($text)
    {
      $this->_text = $text;
      $this->_wmimg_file = '';
    }

  function SetWatermarkImage($filename)
    {
      $this->_wmimg_file = $filename;
    }

  function SetAlignment($alignment)
    {
      $this->_alignment = $alignment;
    }

  function GetAlignment()
    {
      return $this->_alignment;
    }

  function SetFont($font)
    {
      $this->_text_font = $font;
    }

  function SetTextSize($points)
    {
      $this->_text_size = $points;
    }

  function SetTextAngle($angle)
    { 
      $this->_text_angle = (int)$angle;
    }

  function SetTextColor($red,$green,$blue)
    {
      $red = (int)$red;
      $red = max($red,0);
      $red = min($red,255);
      $green = (int)$green;
      $green = max($green,0);
      $green = min($green,255);
      $blue = (int)$blue;
      $blue = max($blue,0);
      $blue = min($blue,255);
      $this->_text_color = array($red,$green,$blue);
    }

  function SetBackgroundColor($red,$green,$blue,$transparent = 0)
    {
      $red = (int)$red;
      $red = max($red,0);
      $red = min($red,255);
      $green = (int)$green;
      $green = max($green,0);
      $green = min($green,255);
      $blue = (int)$blue;
      $blue = max($blue,0);
      $blue = min($blue,255);
      $this->_bg_color = array($red,$green,$blue);
      $this->_transparent = $transparent;
    }

  function SetTranslucency($num)
    {
      $num = (int)$num;
      $num = max($num,0);
      $num = min($num,100);
      $this->_translucency = $num;
    }

  function CheckReady()
    {
      if( empty($this->_wmimg_file) && empty($this->_text) )
	{
	  echo "DEBUG1 DIE AT: __FILE__:__LINE__<br/>";
	  stack_trace(); die();
	  $this->t_error = CGWATERMARK_ERROR_NOTREADY;
	  return FALSE;
	}

      if( !empty($this->_text) && 
	  (empty($this->_text_font) || empty($this->_text_size)) )
	{
	  echo "DEBUG2 DIE AT: __FILE__:__LINE__<br/>";
	  stack_trace(); die();
	  $this->t_error = CGWATERMARK_ERROR_NOTREADY;
	  return FALSE;
	}

      if ( !empty($this->_text) && !file_exists($this->_text_font) )
	{
	  echo "DEBUG3 ".$this->_text_font.'<br/>';
          stack_trace(); die();
	  $this->t_error = CGWATERMARK_ERROR_NOTREADY;
	  return FALSE;
	}

      return TRUE;
    }

  function _cleanup()
    {
      // todo.
    }

  function _generateImageFromText(&$width,&$height)
    {
      if( FALSE === $this->CheckReady() ) return FALSE;
      if( !empty($this->h_wmimage) ) 
	{
	  // Already have The image
	  return TRUE;
	}

      //
      // Generate a transparent PNG image type thing
      // with the text we want
      //

      // First find the bounding box
      $this->t_wmsize = imageftbbox($this->_text_size,
			      $this->_text_angle,
			      $this->_text_font,
			      $this->_text);

      $width = abs($this->t_wmsize[0])+abs($this->t_wmsize[2]);
      $height = abs($this->t_wmsize[1])+abs($this->t_wmsize[5]);

      $image = imagecreatetruecolor($width+$this->_hmargin,
				    $height+$this->_vmargin);
      
      $this->h_bgcolor = imagecolorallocate($image,
					    $this->_bg_color[0],
					    $this->_bg_color[1],
					    $this->_bg_color[2]);

      // background
      imagefilledrectangle($image,0,0,$width-1+$this->_hmargin,$height-1+$this->_vmargin,$this->h_bgcolor);

      if( $this->_transparent )
	{
	  // make the background transparent.
	  echo "DEBUG: setting color transparent<br/>";
	  imagecolortransparent($image,$this->h_bgcolor);
	}


      // draw the forgeround text
      $this->h_textcolor = imagecolorallocate($image,
					      $this->_text_color[0],
					      $this->_text_color[1],
					      $this->_text_color[2]);
      $res = imageTTFText($image,
		   $this->_text_size,
		   $this->_text_angle,
		   (int)($this->_hmargin/2)+1,
		   $height+(int)($this->_vmargin/2),
		   $this->h_textcolor,
		   $this->_text_font,
		   $this->_text);

      $width += $this->_hmargin;
      $height += $this->_vmargin;

      // should have a nice image now.
      return $image;
    }


  function _loadFile($filename,&$sizeinfo,$istransparent = false)
    {
      $tmp = getimagesize($filename);
      if( $tmp === FALSE ) 
	{
	  $this->t_error = CGWATERMARK_ERROR_BADFILE;
	  return FALSE;
	}

      $image = '';
      switch($tmp[2])
	{
	case IMAGETYPE_GIF:
	  $image = imagecreatefromgif($filename);
	  break;
	case IMAGETYPE_JPEG:
	  $image = imagecreatefromjpeg($filename);
	  break;
	case IMAGETYPE_PNG:
	  $image = imagecreatefrompng($filename);
	  break;
        default:
	  $this->t_error = CGWATERMARK_ERROR_BADFILETYPE;
          return FALSE;
	}

      if( $istransparent )
	{
	  $c = imagecolorat($image,1,1);
	  imagecolortransparent($image,$c);
	}
      $sizeinfo = $tmp;
      return $image;
    }


  function CreateWatermarkedImage($srcfile,$destfile)
    {
      if( empty($srcfile) || empty($destfile) )
	return FALSE;

      if( !file_exists($srcfile) ) 
	{
	  $this->t_error = CGWATERMARK_ERROR_NOFILE;
	  return FALSE;
	}
      
      // check if we're ready
      if( FALSE === $this->CheckReady() ) return FALSE;

      // load or create our watermark image
      $res = FALSE;
      $wminfo = '';
      $srcinfo = '';
      if( !empty($this->_text) )
	{
	  // generate text watermark image
	  // dynamically
	  $width = '';
	  $height = '';
	  $res = $this->_generateImageFromText($width,$height);
	  if( $res !== FALSE )
	    {
	      $wminfo = array($width,$height,IMAGETYPE_PNG);
	    }
	}
      else
	{
	  // load image from file
	  $res = $this->_loadFile($this->_wmimg_file,$wminfo,true);
	}
      if( FALSE === $res ) 
	{
	  if( $this->t_error == 0 )
	    {
	      $this->t_error = CGWATERMARK_ERROR_CREATEWM;
	    }
	  $this->_cleanup();
	  return FALSE;
	}
      $this->h_wmimage = $res;

      // should be able to now load the primary image
      $res = $this->_loadFile($srcfile,$srcinfo);
      if( FALSE === $res )
	{
	  if( $this->t_error == 0 )
	    {
	      $this->t_error = CGWATERMARK_ERROR_LOADIMG;
	    }
	  $this->_cleanup();
	  return FALSE;
	}
      $this->h_resultimg = $res;
      
      // Check to make sure that the source
      // Image isn't smaller than our watermark image
      if( ($srcinfo[0] < $wminfo[0]) ||
	  ($srcinfo[1] < $wminfo[1]) )
	{
	  $this->t_error = CGWATERMARK_ERROR_BADFILE;
	  $this->_cleanup();
	  return FALSE;
	}

      // Find out the placement of the watermark
      // on the result image
      $posx = '';
      $posy = '';
      $cx = ($srcinfo[0] - $wminfo[0])/2;
      $cy = ($srcinfo[1] - $wminfo[1])/2;
      switch( $this->_alignment )
	{
	case CGWATERMARK_ALIGN_UL:
	  $posx = $this->_padding_x;
	  $posy = $this->_padding_y;
	  break;

	case CGWATERMARK_ALIGN_UC:
  	  $posx = $cx;
	  $posy = $this->_padding_y;
	  break;

	case CGWATERMARK_ALIGN_UR:
	  $posx = $srcinfo[0] - $this->_padding_x - $wminfo[0];
	  $posy = $this->_padding_y;
	  break;

	case CGWATERMARK_ALIGN_ML:
	  $posx = $this->_padding_x;
	  $posy = $cy;
	  break;

	case CGWATERMARK_ALIGN_MC:
	  $posx = $cx;
	  $posy = $cy;
	  break;

	case CGWATERMARK_ALIGN_MR:
	  $posx = $srcinfo[0] - $this->_padding_x - $wminfo[0];
	  $posy = $cy;
	  break;

	case CGWATERMARK_ALIGN_LL:
	  $posx = $this->_padding_x;
	  $posy = $srcinfo[1] - $this->_padding_y - $wminfo[1];
	  break;

	case CGWATERMARK_ALIGN_LC:
	  $posx = $cx;
	  break;

	case CGWATERMARK_ALIGN_LR:
	default:
	  $posx = $srcinfo[0] - $this->_padding_x - $wminfo[0];
	  $posy = $srcinfo[1] - $this->_padding_y - $wminfo[1];
	  break;
	}
      if( empty($posx) || empty($posy) )
	{
	  $this->t_error = CGWATERMARK_ERROR_OTHER;
	  $this->_cleanup();
	  return FALSE;
	}

      // Now we're set to merge the two images together
      $res = '';
      if( !empty($this->_text) )
	{
	  // use this for watermark images we generated
	  // from text.
	  echo "DEBUG: imagecopymerge with translucency of ".$this->_translucency."<br/>";
	  imagealphablending($this->h_wmimage,FALSE);
	  $res = imagecopymerge($this->h_resultimg,
				$this->h_wmimage,
				$posx, $posy,
				0,0,
				$wminfo[0],$wminfo[1],
				$this->_translucency);
	}
      else
	{
	  imagealphablending($this->h_wmimage,FALSE);
	  imagesavealpha($this->h_wmimage,TRUE);
	  $res = imagecopyresampled($this->h_resultimg,
				    $this->h_wmimage,
				    $posx, $posy,
				    0,0,
				    $wminfo[0],$wminfo[1],
				    $wminfo[0],$wminfo[1]);
	}
      if( $res === FALSE )
	{
	  die('copy failed');
	}

      // and save the destination
      if($srcinfo[2] == IMAGETYPE_PNG)
	{
	  imagepng($this->h_resultimg,$destfile,9);
	}
      else
	{
	  imagejpeg($this->h_resultimg,$destfile,100);
	}

      // and we're done.
      $this->_cleanup();
      return TRUE;
    }
}

?>
