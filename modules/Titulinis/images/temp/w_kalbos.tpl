        	<div class="flags_place">
        		<ul class="flags">
							{foreach from=$irasai item=ii}
								{capture assign="image_url"}{root_url}/uploads/images/titulinis/{$ii.paveiksliukas}{/capture}				
							
								<li>
									<a href="#">
										<img src="{CGSmartImage src=$image_url filter_resizetofit='20,15,#ffffff' noautoscale='false' notag=1}" width="20" height="15"  alt=""/>
										<span>{$ii.antraste}</span>
									</a>
								</li>							
							{/foreach}					
                </ul>
            </div>
