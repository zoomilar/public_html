{*------------------------------------------------------------------------------

Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
         a content management tool for CMS Made Simple
         The projects homepage is http://dev.cmsmadesimple.org/projects/content2
         CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
         The projects homepage is: http://www.cmsmadesimple.org
Version: 0.9.4
File   : editcontent.tpl
License: GPL

------------------------------------------------------------------------------*}

<!-- START PAGE_TAB {$tab.tab_id} -->

{if $tab.block_tabs|@count > 0}

<!-- start block_tabs in page_tab {$tab.tab_id} -->
<!-- start block_tabs tabheaders in page_tab {$tab.tab_id} -->
<div class="ac_block_tabs">
	<ul>
	{foreach from=$tab.block_tabs item=block_tab name=block_tabs}
		<li onclick="return false;">
			<a href="#ac_block_tab_{$block_tab.tab_id}">{$block_tab.tab_name}</a>
		</li>
	{/foreach}
	</ul>
	
	{foreach from=$tab.block_tabs item=block_tab name=block_tabs}
	
	<!-- start block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
	<div id="ac_block_tab_{$block_tab.tab_id}">
		
		{if $block_tab.block_groups|@count > 0}
		<!-- start block_groups in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
			{foreach from=$block_tab.block_groups item=block_group}
		
		<!-- start block_group {$block_group.group_id} in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
		<div class="pageoverflow">
			<fieldset class="ac_fieldset{if $block_group.collapsible && !$block_group.display} ac_no-border{/if}" id="{$block_group.group_id}_container">
				<legend class="ac_block_group">
					
				{if $block_group.collapsible}
					
					<a href="{$block_group.pref_url}" class="{if $block_group.display == 0}ac_expand{else}ac_contract{/if}" id="toggle-{$block_group.group_id}">
						
				{/if}
				{$block_group.group_name}:
				{if $block_group.collapsible}
						
					</a/>
					
				{/if}
				
				</legend>
				
				<!-- start blocks in block_group {$block_group.group_id} in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
				<div id="{$block_group.group_id}_wrapper" class="ac_no-overflow" style="display:{if $block_group.display == 0}none{else}block{/if}">
					
				{foreach from=$block_group.content_blocks item=content_block_id}
					{assign var="content_block" value=$content_obj->GetContentBlock($content_block_id)}
					<!-- start block {$content_block->GetProperty('id')} in block_group {$block_group.group_id} in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
					
					<div class="pageoverflow ac_content_block_id">
						<div class="pageoverflow">
							<strong>{$content_block->GetProperty('label')}:</strong>
						</div>
						
						{if $content_block->GetProperty('error_message')}
							
							<div class="pageoverflow ac_block_errormessage pageerrorcontainer" id="{$content_block->GetProperty('id')}_error_message">
								
							<p>{$content_block->GetProperty('error_message')}</p>
								
							</div>
							
						{/if}
						{if $content_block->GetProperty('message')}
							
							<div class="pageoverflow ac_block_message pagemcontainer" id="{$content_block->GetProperty('id')}_message">
								
							{$content_block->GetProperty('message')}
								
							</div>
							
						{/if}
						{if $content_block->GetProperty('description')}
						
						<div class="pageoverflow">
							
							{$content_block->GetProperty('description')}
							
						</div>
						
						{/if}
						
						<div style="padding: 5px 0 0 0;">
							<p>{$content_block->GetInput()}</p>
						</div>
					</div>
					<!-- end block {$content_block->GetProperty('id')} in block_group {$block_group.group_id} in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
				
				{/foreach}
				
				</div>
				<!-- end blocks in block_group {$block_group.group_id} in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
			</fieldset>
		</div>
		<!-- end block_group {$block_group.group_id} in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
		
			{/foreach}
		<!-- end block_groups in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
		{/if}
		
		{if $block_tab.content_blocks|@count > 0}
		<!-- start blocks in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
			{foreach from=$block_tab.content_blocks item=content_block_id}
				{assign var="content_block" value=$content_obj->GetContentBlock($content_block_id)}
		<!-- start block {$content_block->GetProperty('id')} in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
		
		<div class="pageoverflow">
			<fieldset class="ac_fieldset{if $content_block->GetProperty('collapsible') && $content_block->GetProperty('display') == 0} ac_no-border{/if}" id="{$content_block->GetProperty('id')}_container">
				<legend class="ac_content_block_id">
					
				{if $content_block->GetProperty('collapsible')}
					
					<a href="{$content_block->GetProperty('pref_url')}" class="{if $content_block->GetProperty('display') == 0}ac_expand{else}ac_contract{/if}" id="toggle-{$content_block->GetProperty('id')}">
					
				{/if}
				{$content_block->GetProperty('label')}:
				{if $content_block->GetProperty('collapsible')}
				
					</a>
					
				{/if}
				
				</legend>
				
				<div id="{$content_block->GetProperty('id')}_wrapper" class="ac_no-overflow" style="display:{if $content_block->GetProperty('display') == 0 && !$content_block->GetProperty('no_collapse')}none{else}block{/if}">
				
				{if $content_block->GetProperty('error_message')}
					
					<div class="pageoverflow ac_block_errormessage pageerrorcontainer" id="{$content_block->GetProperty('id')}_error_message">
						
					<p>{$content_block->GetProperty('error_message')}</p>
						
					</div>
					
				{/if}
				{if $content_block->GetProperty('message')}
					
					<div class="pageoverflow ac_block_message pagemcontainer" id="{$content_block->GetProperty('id')}_message">
						
					{$content_block->GetProperty('message')}
						
					</div>
					
				{/if}
				{if $content_block->GetProperty('description')}
					
					<div class="pageoverflow ac_block_description">
						
					{$content_block->GetProperty('description')}
						
					</div>
					
				{/if}
					
					<div style="padding: 5px 0 0 0;">
						<p>{$content_block->GetInput()}</p>
					</div>
				</div>
			</fieldset>
		</div>
		<!-- end block {$content_block->GetProperty('id')} in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
		
			{/foreach}
		<!-- end blocks in block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
		{/if}
		
	</div>
	<!-- end block_tab {$block_tab.tab_id} in page_tab {$tab.tab_id} -->
	
	{/foreach}
	
</div>
<!-- end block_tabs tabcontent in page_tab {$tab.tab_id} -->
<!-- end block_tabs in page_tab {$tab.tab_id} -->

{/if}

{if $tab.block_groups|@count > 0}

<!-- start block_groups in page_tab {$tab.tab_id} -->

	{foreach from=$tab.block_groups item=block_group}
	
<!-- start block_group {$block_group.group_id} in page_tab {$tab.tab_id} -->
<div class="pageoverflow">
	<fieldset class="ac_fieldset{if $block_group.collapsible && !$block_group.display} ac_no-border{/if}" id="{$block_group.group_id}_container">
		<legend class="ac_block_group">
			
		{if $block_group.collapsible}
			
			<a href="{$block_group.pref_url}" class="{if $block_group.display == 0}ac_expand{else}ac_contract{/if}" id="toggle-{$block_group.group_id}">
			
		{/if}
		{$block_group.group_name}:
		{if $block_group.collapsible}
		
			</a>
			
		{/if}
		
		</legend>
		
		<!-- start blocks in block_group {$block_group.group_id} in page_tab {$tab.tab_id} -->
		<div id="{$block_group.group_id}_wrapper" class="ac_no-overflow" style="display:{if $block_group.display == 0}none{else}block{/if}">
			
		{foreach from=$block_group.content_blocks item=content_block_id}
			{assign var="content_block" value=$content_obj->GetContentBlock($content_block_id)}
			<!-- start block {$content_block->GetProperty('id')} in block_group {$block_group.group_id} in page_tab {$tab.tab_id} -->
			
			<div class="pageoverflow ac_content_block_id">
				
				<div class="pageoverflow">
					<strong>{$content_block->GetProperty('label')}:</strong>
				</div>
			
			{if $content_block->GetProperty('error_message')}
				
				<div class="pageoverflow ac_block_errormessage pageerrorcontainer" id="{$content_block->GetProperty('id')}_error_message">
					
				<p>{$content_block->GetProperty('error_message')}</p>
					
				</div>
				
			{/if}
			{if $content_block->GetProperty('message')}
				
				<div class="pageoverflow ac_block_message pagemcontainer" id="{$content_block->GetProperty('id')}_message">
					
				{$content_block->GetProperty('message')}
					
				</div>
				
			{/if}
			{if $content_block->GetProperty('description')}
				
				<div class="pageoverflow ac_block_description">
					
				{$content_block->GetProperty('description')}
					
				</div>
				
				{/if}
				
				<div style="padding: 5px 0 0 0;">
					<p>{$content_block->GetInput()}</p>
				</div>
					
			</div>
			<!-- end block {$content_block->GetProperty('id')} in block_group {$block_group.group_id} in page_tab {$tab.tab_id} -->
		
		{/foreach}
		
		</div>
		<!-- end blocks in block_group {$block_group.group_id} in page_tab {$tab.tab_id} -->
	</fieldset>
</div>
<!-- end block_group {$block_group.group_id} in page_tab {$tab.tab_id} -->
{/foreach}
<!-- end block_groups in page_tab {$tab.tab_id} -->
{/if}


{if $tab.content_blocks|@count > 0}

<!-- start blocks in page_tab {$tab.tab_id} -->

	{foreach from=$tab.content_blocks item=content_block_id}
		{assign var="content_block" value=$content_obj->GetContentBlock($content_block_id)}
<!-- start block {$content_block->GetProperty('id')} in page_tab {$tab.tab_id} -->

		{* $content_block->GetHeaderHTML() *}

<div class="pageoverflow">
	<fieldset class="ac_fieldset{if $content_block->GetProperty('collapsible') && $content_block->GetProperty('display') == 0} ac_no-border{/if}" id="{$content_block->GetProperty('id')}_container">
		<legend class="ac_content_block_id">
			
		{if $content_block->GetProperty('collapsible')}
			
			<a href="{$content_block->GetProperty('pref_url')}" class="{if $content_block->GetProperty('display') == 0}ac_expand{else}ac_contract{/if}" id="toggle-{$content_block->GetProperty('id')}">
			
		{/if}
			
			{$content_block->GetProperty('label')}:
			
		{if $content_block->GetProperty('collapsible')}
			
			</a>
		{/if}
			
		</legend>
		
		<div id="{$content_block->GetProperty('id')}_wrapper" class="ac_no-overflow" style="display:{if $content_block->GetProperty('display') == 0 && !$content_block->GetProperty('no_collapse')}none{else}block{/if}">
			
		{if $content_block->GetProperty('error_message')}
			
			<div class="pageoverflow ac_block_errormessage pageerrorcontainer" id="{$content_block->GetProperty('id')}_error_message">
				
			<p>{$content_block->GetProperty('error_message')}</p>
				
			</div>
			
		{/if}
		{if $content_block->GetProperty('message')}
			
			<div class="pageoverflow ac_block_message pagemcontainer" id="{$content_block->GetProperty('id')}_message">
				
			{$content_block->GetProperty('message')}
				
			</div>
			
		{/if}
		{if $content_block->GetProperty('description')}
			
			<div class="pageoverflow ac_block_description">
				
				{$content_block->GetProperty('description')}
				
			</div>
			
		{/if}
			
			<div style="padding: 5px 0 0 0;">
				<p>{$content_block->GetInput()}</p>
			</div>
			
		</div>
	</fieldset>
</div>
<!-- end block {$content_block->GetProperty('id')} in page_tab {$tab.tab_id} -->

	{/foreach}

<!-- start blocks in page_tab {$tab.tab_id} -->

{/if}

<!-- END PAGE_TAB {$tab.tab_id} -->
