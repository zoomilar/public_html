                    <script type="text/javascript">
                        $(document).ready(function(){
							init_vertcal_logoz_wall = function(){
								get_content = $('#vertcal_logoz_wall').html();
								$('#vertcal_logoz_wall').append(get_content);
								var _scroll = {
									delay: 10,
									easing: 'linear',
									items: 2,
									duration: 150000,
									timeoutDuration: 0,
									pauseOnHover: 'immediate'
								};
								$('#vertcal_logoz_wall').carouFredSel({
									responsive: false,
									height:350,
									direction: 'up',
									width: 553,
									items: {
										visible: {
											min: 1,
											max: 1
										}
									},

									scroll: _scroll
	
								});
							};
							
							init_vertcal_logoz_wall();
                        })
                    </script>
                    <div id="vertcal_logoz_wall">
                        <div>					


							{foreach from=$irasai item=ii}
						  
							   <p>{$ii.tekstas}</p>
							   <table>
							    <tr>
									<td>{if $ii.paveiksliukas}<img src="/uploads/images/titulinis/thumb2_{$ii.paveiksliukas}" width="100" alt="" style="float: left; margin-right: 10px"/>{/if}</td>
									<td><h3>{$ii.antraste}</h3></td>
								</tr>
							   </table>
							   <br/>
							

							{/foreach}	
					</DIV></DIV>