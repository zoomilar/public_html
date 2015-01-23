<script src="{root_url}/js/tx.preloader.js" type="text/javascript"></script>
{literal}
<script type="text/javascript">
var order_hierarchy_id = '{/literal}{$hierarchy_id}{literal}';
var root_url = '{/literal}{root_url}{literal}';
var semo = false;
$(document).ready(function() {
	$('.sortable').sortable({
		items: "li",
		update: function( event, ui ) {
			var ser = $(this).sortable('serialize');
			//console.log(ser);
			$.preloader('show');
			var t = new Date().getTime();
			
			
			
			$.get(root_url + '/ajax.php?'+ser, {'action': 'ProductsSortProd', 'order_hierarchy_id': order_hierarchy_id, 't': t}, function(data) {
				$.preloader('hide');
				
				
				$('.show_on_reorder').css({
					'padding': '10px 10px 10px 45px',
					'position': 'fixed',
					'top': '2px'
				});
				
				var width_s = $('.show_on_reorder').outerWidth();
				var width = $(window).width();
				width = width / 2 - width_s / 2;
				
				if (semo == false) {
					semo = true;
					$('.show_on_reorder').css({
						'left': width + 'px'
					}).slideDown(500, function() {
						$(this).delay(1500).slideUp(500, function() {
							semo = false;
						});
					});
				}
				
			});
		}
	});
});


</script>
{/literal}
<h3>{$mod->Lang('reorder_hierarchy_products')} <strong>{$hierarchy_name}</strong></h3>
{if $product_count > 0}
	{$formstart}
	<div class="pageoverflow">
		<div class="reorder-pages pageinput">
			 <ul class="sortableList sortable">
				{foreach from=$products item="product"}
					<li id="ser_{$product.prod_id}">
						<div class="label"><span>&nbsp;</span>{$product.product_name}</div>
					</li>
				{/foreach}
			 </ul>
		</div>
	</div>
	<div class="pageoverflow">
		<div class="success show_on_reorder" style="display:none;">
			{$mod->Lang('success_reorder')}
		</div>
	</div>
	<div class="pageoverflow">
	  <p class="pagetext"></p>
	  <p class="pageinput">
		<input type="submit" name="{$actionid}cancel" value="{$mod->Lang('return_to_list')}"/>
	  </p>
	</div>
	{$formend}
{/if}