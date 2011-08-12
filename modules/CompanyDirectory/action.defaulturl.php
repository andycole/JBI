<?php
if (!isset($gCms)) exit;

if( isset( $params['categoryid'] ) )
  {
    $this->DoAction('default',$id,$params,$returnid);
  }
else
  {
    $this->DoAction('details', $id, $params, $returnid);
  }

# vim:ts=4 sw=4 noet
?>
