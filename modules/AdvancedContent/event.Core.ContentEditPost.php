<?php
#-------------------------------------------------------------------------------
#
# Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
#          a content management tool for CMS Made Simple
#          The projects homepage is dev.cmsmadesimple.org/projects/content2/
#          CMS Made Simple is (c) 2004-2013 by Ted Kulp
#          The projects homepage is: cmsmadesimple.org
# Version: 0.9.4
# File   : event.Core.ContentEditPost.php
# Purpose: copys the expand/collapse status of blocks when page is copied
# License: GPL
#
#-------------------------------------------------------------------------------

if(!function_exists('cmsms') || !is_object(cmsms())) exit;

if(basename($_SERVER['PHP_SELF']) == 'copycontent.php' 
	&& isset($params['content']) 
	&& is_object($params['content']) 
	&& $params['content']->Type() == 'advanced_content')
{
	if(isset($_GET['content_id']))
		$old_content_id = $_GET['content_id'];
	else
		$old_content_id = $params['content']->Id();
	
	foreach($params['content']->GetContentBlocks() as $contentBlock)
	{
		ac_admin_ops::SetVisibility(
			'block', 
			$contentBlock->GetProperty('id'), 
			$params['content']->Id(), 
			$params['content']->TemplateId(),
			ac_admin_ops::GetVisibility(
				'block', 
				$contentBlock->GetProperty('id'), 
				$old_content_id, 
				$params['content']->TemplateId(), 
				!$contentBlock->GetProperty('collapse')
			)
		);
	}
	
	foreach(acTabManager::GetTabs() as $tab)
	{
		foreach($tab['block_groups'] as $groupInfo)
		{
			ac_admin_ops::SetVisibility(
				'group', 
				$groupInfo['group_id'], 
				$params['content']->Id(), 
				$params['content']->TemplateId(),
				ac_admin_ops::GetVisibility(
					'group', 
					$groupInfo['group_id'], 
					$old_content_id, 
					$params['content']->TemplateId(), 
					!$this->GetPreference('collapse_group_default',1)
				)
			);
		}
		foreach($tab['block_tabs'] as $block_tab)
		{
			foreach($block_tab['block_groups'] as $groupInfo)
			{
				ac_admin_ops::SetVisibility(
					'group', 
					$groupInfo['group_id'], 
					$params['content']->Id(), 
					$params['content']->TemplateId(),
					ac_admin_ops::GetVisibility(
						'group', 
						$groupInfo['group_id'], 
						$old_content_id, 
						$params['content']->TemplateId(), 
						!$this->GetPreference('collapse_group_default',1)
					)
				);
			}
		}
	}
}

?>
