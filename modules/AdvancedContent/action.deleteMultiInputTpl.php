<?php
#-------------------------------------------------------------------------------
#
# Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
#          a content management tool for CMS Made Simple
#          The projects homepage is http://dev.cmsmadesimple.org/projects/content2/
#          CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
#          The projects homepage is: http://www.cmsmadesimple.org
# Version: 0.9.4
# File   : action.deleteMultiInputTpl.php
# License: GPL
#
#-------------------------------------------------------------------------------

if(!is_object(cmsms())) exit;

if(!$this->CheckPermission('Manage AdvancedContent MultiInput Templates'))
{
	return $this->DisplayErrorPage($id,$returnid, $this->Lang('error_permissions'));
}
$_params = array();
$message      = '';
$errormessage = '';
if(isset($params['tpl_id']))
{
	$this->DeleteTemplate($params['tpl_id']);
	$_params['message'] = 'multi_input_tpl_deleted';
	$message .= $this->lang('multi_input_tpl_deleted') . "<br />";
}
else if(isset($params['submit_bulkaction']))
{
	foreach($params as $param_name => $param_value)
	{
		if(startswith($param_name,'multi_input_tpl-'))
		{
			$this->DeleteTemplate($param_value);
			$_params['message'] = 'multi_input_tpl_deleted';
			$message .= $this->lang('multi_input_tpl_deleted') . "<br />";
		}
	}
}
$_params['active_tab'] = 'multi_input_tpl';
if(isset($params['ajax']))
{
	@ob_end_clean();
	@ob_start();
	if($errormessage)
	{
		echo '<div class="pageerrorcontainer"><ul class="pageerror"><li>'. $errormessage . '</li></ul></div>';
	}
	if($message)
	{
		echo '<div class="pagemcontainer"><p class="pagemessage">'.$message.'</p></div>';
	}
	ob_end_flush();
	exit;
}
$this->Redirect($id, 'defaultadmin', $returnid, $_params);

?>
