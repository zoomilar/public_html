{if $sekmingai}
	<div style='padding: 20px 0px; color:  #cf0000; font-weight: bold'>{#send_success#}</div>
{else}
  <form method="post" class="cms_form" action="" id="reg2" enctype='multipart/form-data'>
            {field type="hidden" prefix=$prefix name='form_id' value='1'}
            {field type="hidden"  name='test_submit' value='1'}
			
    	<div class="contact_form">
        	<h2 class="contact_form_title">KONTAKTINĖ FORMA</h2>
        	<div title="{#vardas#}">
                {field type="text" name="vardas" defval=#vardas# prefix=$prefix label="0" required=1} 			
            </div>
            <div title="{#el_pastas#}">
                {field type="text" name="el_pastas" defval=#el_pastas# prefix=$prefix label="0" required=1} 			
            </div>
            <div class="full_width" title="{#pastabos#}">
				{field type="textarea" name="pastabos" defval=#pastabos# prefix=$prefix label="0" required=1}
            </div>
            <div>
            	<span class="file_input_imitation">
                	<span class="byla"><span>{#prisegti_byla#}</span></span>
                    <span class="label">{#prisegti#}</span>
                </span>
            	<input type="file" value="" class="filez" />
            </div>
            <div align="right">
            	<a href="#" class="ext_button brown f_13 xsd">
                	<span>{#siusti#}</span>
                </a>
            </div>
        </div>

            </form>
            {literal}
            <script>
                $(document).ready(function() {
                    init_form = function(){
                        $('form#reg2 input[type="text"],form#reg2 textarea').each(function(index, element) {
                            var get_value = $(this).parent('*').attr('title');
                            if($(this).val() == ''){
                                $(this).val(get_value);
                            };
                        });
                        $('form#reg2 input[type="text"], form#reg2 textarea').blur(function(){
                            var get_value2 = $(this).parent('*').attr('title');
                            if($(this).val() == '' || $(this).val() == $(this).parent('*').attr('title')){
                                $(this).val(get_value2);
                            };
                        });
                        
                        $('form#reg2 input[type="text"], form#reg2 textarea').focus(function(){
                            var get_value2 = $(this).parent('*').attr('title');
                            if($(this).val() == $(this).parent('*').attr('title')){
                                $(this).val('');
                                $(this).removeClass('error')
                            }
                        });
                        
                        $('.xsd').click(function(event){

                            event.preventDefault();
                            valid_form = 1;
                            $('form#reg2 input[type="text"],form#reg2 textarea').each(function(index, element) {
                                var get_value = $(this).parent('*').attr('title');
                                if($(this).val() == $(this).parent('*').attr('title') && $(this).attr('required')){
                                    $(this).val('').addClass('error');
                                    valid_form = 0
                                }else{
                                    $(this).removeClass('error')
                                }
                            });
							
                            if(valid_form == 0){
                                $('form#reg2 input[type="text"],form#reg2 textarea').each(function(index, element) {
                                    var get_value = $(this).parent('*').attr('title');
                                    if($(this).val() == ''){
                                        $(this).val(get_value);
                                    };
                                });
                            }else{
								$('.form_list input[type="text"], .form_list textarea').each(function(index, element) {
									var get_value = $(this).parent('*').attr('title');
									$(this).val(get_value);
								});
								/*alert('{/literal}{#issiusta_sekmingai#}{literal}');*/
								//$('.form_list').hide().after('<div style="width:205px; text-align: center; color: white; padding: 70px 20px 0; font-size:18px">{#issiusta_sekmingai#}</div>');
                                $(this).parents('form').submit();
                            }
                            
                        });
                    };
                    init_form();
                });
            </script>
            {/literal}
{/if}