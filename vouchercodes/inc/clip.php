<?PHP require_once('config.php');?>

function copy(inElement) 
{

  if (inElement.createTextRange) {
    var range = inElement.createTextRange();
    if (range && BodyLoaded==1)
      range.execCommand('Copy');
} 
else 
{
    var flashcopier = 'flashcopier';
    if(!document.getElementById(flashcopier)) {
      var divholder = document.createElement('div');
      divholder.id = flashcopier;
      document.body.appendChild(divholder);
    }
    document.getElementById(flashcopier).innerHTML = '';

var divinfo1 = '<embed src="<?PHP echo $config['thissite'];?>/inc/_clipboard.swf" FlashVars="clipboard=';
var divinfo2 = '" width="0" height="0" type="application/x-shockwave-flash"></embed>';
var divinfo = divinfo1 + inElement + divinfo2;

    document.getElementById(flashcopier).innerHTML = divinfo;
  }

}