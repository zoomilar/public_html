                    	<ul class="bubbles">
						{assign var="kiek" value=0}
						{foreach from=$irasai item=ii}
						{assign var="kiek" value=$kiek+1}
						  {if $kiek <= 4}
                        	<li>
                            	<a href="#">
                                	<span class="hover_content">
                                    	<span class="easy_content" style="padding-top:0">
                                        	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td height="100%">{$ii.antraste2}</td>
                                              </tr>
                                            </table>

                                            
                                        </span>
                                    </span>
                                    <span class="easy_content" style="padding-top:0">
                                    	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td height="100%">{$ii.antraste}</td>
                                          </tr>
                                        </table>
                                    </span>
                                    <img src="images/icons/ico_4.png" alt="" class="arrow" />
                                </a>
                                <img class="sh" src="images/misc/sh1.png" alt=""/>
                            </li>
						  {/if}	
						{/foreach}	
                        </ul>
                        <div class="big_bubble">
                           <div style="padding:56px 40px 0" align="center">
                            	<div class="font_opensans-light-webfont">
                            		{$irasai.5.tekstas}
                                </div>
                                 <a class="ext_button st_blue responsive f_17 uppercase" href="{$irasai.5.nuoroda}" style="width:150px"><span>{$irasai.5.nuorodatxt}</span></a>
                            </div>						
                        </div>
                        <div style="position: relative; left:30px; padding-top:398px; padding-left:26px; width:777px;" class="bubbles_slides">
  							<div data-cycle-auto-height="container" data-cycle-pager-template="" data-cycle-pager=".bubbles" data-cycle-slides="&gt; div" data-cycle-timeout="0" data-cycle-pager-event="mouseover" data-cycle-fx="fade" class="cycle-slideshow" style="position: relative; height: 27px;">
								{assign var="kiek" value=0}
								{foreach from=$irasai item=ii}
									{assign var="kiek" value=$kiek+1}
								{if $kiek <= 4}
                                <div>
                                	{$ii.tekstas}
                                </div>
								{/if}
								{/foreach}
                        	</div>
                        </div> 