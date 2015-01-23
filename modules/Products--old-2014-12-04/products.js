$(document).ready(function() {
	$("#m1_moduleform_1").delegate('#addmore', 'click', function(){
		$("#optionlist").append($("#optiondef").html());		
	});
	
	$("#m1_moduleform_1").delegate('#deleteselected', 'click', function(){		
		var par ='';
		$.each($("input.deletethis:checked"), function(num, laukas) {
			par =  $(this).parent();
			if (!par.attr('class'))
				par = par.parent().parent();
		
			par.remove();
		});
	});
	
	$(".komm").click(function(){
	
		var kla = $(this).attr('alt');
		
		$(".komm").removeClass('active');
		$(this).addClass('active');
		var lang = $(this).attr("alt");
		$(".komm[alt='"+lang+"']").addClass('active');
		$(".hddi").hide();
		$("."+kla).show();
	});
	
	/*if ($('.fld_67').length > 0) {
		$('.fld_67 input').datepick({dateFormat: 'yyyy-mm-dd'});
	}	*/
	
	$( ".file_block" ).each(function() {
		
		$(this).sortable({
			items: "div.image_container",
			update: function( event, ui ) {
				var ser = $(this).sortable('serialize');
				
				var el_id = $(this).attr('id');
				el_id = el_id.replace('currentfilelist_', '');
				el_id = parseInt(el_id, 10);
				$.preloader('show');
				var t = new Date().getTime();
				
				//console.log(ser);
				
				$.get(root_url + '/ajax.php?'+ser, {'action': 'ProductSortImages', 'product_id': product_id, 'field_id': el_id, 't': t}, function(data) {
					get_current_files(el_id, product_id);
				});
			}
		});
	});
	
	$('body').on('click', '.del_url_t', function(e) {
		e.preventDefault();
		var file = $(this).attr('href');
		
		
		var el_id = $(this).parents('.file_block:first').attr('id');
		el_id = el_id.replace('currentfilelist_', '');
		el_id = parseInt(el_id, 10);
		
		
		var t = new Date().getTime();
		
		if (confirm(delete_image)) {
			$.preloader('show');
			$.post(root_url+'/ajax.php', {'action':'DellProductsFile', 'field_id': el_id, 'product_id': product_id, 'file': file, 't': t}, function(data) {
				get_current_files(el_id, product_id);
			});
		}
	});
	
	
	$('.hierarchy_select select').change(function() {
		$.preloader('show');
		$.post(root_url+'/ajax.php', {'action': 'GetHierFields', 'hier_id': $(this).val()}, function (data) {
			if (data.status == true) {
				$('.pageinput.Filter').find('select').each(function() {
					$(this).parents('.pageoverflow:first').hide();
				});
				$.each(data.field_id, function(index, value) {
					$('select[name="m1_customfield[field-'+value+']"]').parents('.pageoverflow:first').show();
				});
				/*$('.pageinput.Filter').find('select').each(function() {
					if ($(this).parents('.pageoverflow:first').css('display') == 'none') {
						$(this).val($('option:first', this).val());
					}
				});*/
			} else {
				$('.pageinput.Filter').find('select').each(function() {
					$(this).parents('.pageoverflow').hide();
					//$(this).val($('option:first', this).val());
				});
				//hide
			}
			$.preloader('hide');
		}, 'json');
	});
	
	
	$('.hierarchy_select select').trigger('change');
	
	
	
	$('body').on('click', '.textarea_multi_add',function() {
		var elem_name = $(this).attr('data-element');
		var elem = $('.'+elem_name).clone();
		var elem_id = elem_name.replace('temp_block_', '');
		
		elem.removeClass(elem_name).show();
		$('.multi_holder_'+elem_id).append(elem);
		
		recalculate_multi(elem_id);
	});
	
	$('body').on('click', '.block_up, .block_down', function(e) {
		e.preventDefault();
		var block_id = $(this).attr('href');
		block_id = block_id.replace('#', '');
		block_id = parseInt(block_id, 10);
		
		var prev = $(this).parents('.multi_block:first').prev('.multi_block');
		var next = $(this).parents('.multi_block:first').next('.multi_block');
		
		if ($(this).parents('.multi_block:first').find('textarea').length > 0) {
			$(this).parents('.multi_block:first').find('textarea').each(function() {
				var attr = $(this).attr('id');
				
				if (typeof attr !== typeof undefined && attr !== false) {
					
					tinyMCE.execCommand('mceRemoveControl', false, attr);
					
					
				}
			});
			
		}
		
		if ($(this).hasClass('block_up') && prev.length > 0) {
			prev.before($(this).parents('.multi_block:first'));
		} else if ($(this).hasClass('block_down') && next.length > 0) {
			next.after($(this).parents('.multi_block:first'));
		}
		
		
		if ($(this).parents('.multi_block:first').find('textarea').length > 0) {
			$(this).parents('.multi_block:first').find('textarea').each(function() {
				var attr = $(this).attr('id');
				if (typeof attr !== typeof undefined && attr !== false) {
					
					tinyMCE.execCommand('mceAddControl', false, attr);
					
					
				}
			});
			
		}
		
		/*var ordering = [];
		var ccx = 0;
		$('.multi_holder_'+block_id+' .multi_block').each(function() {
			var name_tmp = $(this).find('input[type="text"][name*="[field-'+block_id+']"]:first').attr('name');
			var name_tmp_a = name_tmp.split('[');
			name_tmp = name_tmp_a[name_tmp_a.length-1]
			name_tmp = name_tmp.replace(']', '');
			name_tmp = parseInt(name_tmp);
			if (!isNaN(name_tmp)) {
				ordering[ccx] = name_tmp;
				ccx++;
			}
		});
		
		if (ordering.length > 0) {
			$('#ordering_'+block_id).val(ordering.join('|'));
		} else {
			$('#ordering_'+block_id).val('');
		}*/
	
	});
	
	
	
	$('body').on('click', '.delete_this_block', function (e) {
		e.preventDefault();
		if (confirm(textarea_multi_delete)) {
			
			if ($(this).parents('.multi_block:first').find('textarea').length > 0) {
				$(this).parents('.multi_block:first').find('textarea').each(function() {
					var attr = $(this).attr('id');
					if (typeof attr !== typeof undefined && attr !== false) {
						if (attr.indexOf("test_w_") != -1) {
							tinyMCE.execCommand('mceRemoveControl', false, attr);
							return false;
						}
					}
				});
			}
			$(this).parents('.multi_block:first').remove();
		}
	});
	
	$('#m1_moduleform_1').on('click', 'button[name="m1_submit"]', function(e) {
		if ($('input[name="'+name_field+'"]').val() == '') {
			e.preventDefault();
			$('input[name="'+name_field+'"]').focus();
			$('html, body').animate({
				scrollTop: $('input[name="'+name_field+'"]').offset().top
			}, 50);
			alert(nonamegiven);
		}
	});
});


function recalculate_multi(elem_id) {
	
	var c = 0;
	
	if ($('.multi_holder_'+elem_id+' .multi_block.has_wsywk').length > 0) {
		$('.multi_holder_'+elem_id+' .multi_block.has_wsywk').each(function() {
			var n = $(this).find('input:first').attr('name');
			var nt = n.split('[');
			n = nt[nt.length-1];
			n = n.replace(']','');
			n = parseInt(n, 10);
			if (!isNaN(n) && n+1 > c) {
				//console.log(n);
				c = n+1;
			}
		});
	}
	
	$('.multi_holder_'+elem_id).find('.multi_block').each(function() {
		if (!$(this).hasClass('has_wsywk')) {
			
			$(this).find('*').each(function() {
				
				change_attr($(this), 'name', c);
				change_attr($(this), 'id', c);
				change_attr($(this), 'onclick', c);
				change_attr($(this), 'for', c);
				change_attr($(this), 'aria-labelledby', c);
				change_attr($(this), 'onfocus', c);
				change_attr($(this), 'class', c);
				
				//console.log('test_w_'+elem_id+'[t]['+c+']');
				if ($(this).hasClass('test_w_'+elem_id+'[t]['+c+']')) {
					var cl_id = $(this).attr('id');
					//console.log(cl_id);
					tinyMCE.execCommand('mceAddControl', false, cl_id);
				}
			});
			
			$(this).addClass('has_wsywk');
			c++;
		}
		
	});
}

function change_attr(elem, name, c) {
	var attr = elem.attr(name);
	if (typeof attr !== typeof undefined && attr !== false) {
		//console.log(attr);
		attr = attr.replace('[v][nm]', '[v]['+c+']');
		attr = attr.replace('[t][nm]', '[t]['+c+']');
		//console.log(attr);
		elem.attr(name, attr);
	}
}

function init_the_uploader(el_id, product_id) {
	var t = new Date().getTime();
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button : document.getElementById('pickfiles_'+el_id), // you can pass in id...
		container: document.getElementById('container_'+el_id), // ... or DOM Element itself
		url : root_url+'/ajax.php?action=ProductsUpload&field_id='+el_id+'&product_id='+product_id+'&t='+t,
		flash_swf_url : root_url+'/modules/Products/lib/uploader/js/Moxie.swf',
		silverlight_xap_url : root_url+'/modules/Products/lib/uploader/js/Moxie.xap',
		
		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "Image files", extensions : "jpg,jpeg,gif,png"}
			]
		},

		init: {
			PostInit: function() {
				document.getElementById('filelist_'+el_id).innerHTML = '';
			},

			FilesAdded: function(up, files) {
				
				/*plupload.each(files, function(file) {
					document.getElementById('filelist_'+el_id).innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				});*/
				$.preloader('show');
				up.start();
			},

			UploadProgress: function(up, file) {
				//document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},
			
			UploadComplete: function() {
				get_current_files(el_id, product_id);
				//document.getElementById('filelist').innerHTML = '';
			},
			

			Error: function(up, err) {
				//console.log("\nError #" + err.code + ": " + err.message);
				//document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
			}
		}
		
	});
	uploader.init();
}

function get_current_files(el_id, product_id) {
	var t = new Date().getTime();
	$.preloader('show');
	$.post(root_url+'/ajax.php', {'action':'GetProductsFileList', 'field_id': el_id, 'product_id': product_id, 't': t}, function(data) {
		$('#currentfilelist_'+el_id).html('');
		if (data.status == true) {
			$.each(data.files, function(index, value) {
				
				var container = $('<div></div>').attr('id', 'ser_'+value.ordering).addClass('image_container');
				container.append(value.img);
				container.append($('<a></a>').attr('href', value.full).addClass('del_url_t delete-icon'));
				$('#currentfilelist_'+el_id).append(container);
				
			});
		}
		
		$.preloader('hide');
	
	}, 'json');
}