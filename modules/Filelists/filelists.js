function init_the_uploader(filelist_id) {
	var t = new Date().getTime();
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button : document.getElementById('pickfiles'), // you can pass in id...
		container: document.getElementById('container'), // ... or DOM Element itself
		url : root_url+'/ajax.php?action=FilelistUpload&filelist_id='+filelist_id+'&t='+t,
		flash_swf_url : root_url+'/modules/Filelists/lib/uploader/Moxie.swf',
		silverlight_xap_url : root_url+'/modules/Filelists/lib/uploader/Moxie.xap',
		
		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "Image files", extensions : "jpg,jpeg,gif,png"}
			]
		},

		init: {
			PostInit: function() {
				document.getElementById('filelist').innerHTML = '';
			},

			FilesAdded: function(up, files) {
				
				/*plupload.each(files, function(file) {
					document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				});*/
				$.preloader('show');
				up.start();
			},

			UploadProgress: function(up, file) {
				//document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},
			
			UploadComplete: function() {
				get_current_files(filelist_id);
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



function get_current_files(filelist_id) {
	var t = new Date().getTime();
	$.preloader('show');
	$.post(root_url+'/ajax.php', {'action':'GetFilelistFileList', 'filelist_id': filelist_id, 't': t}, function(data) {
		$('#currentfilelist').html('');
		if (data.status == true) {
			$.each(data.files, function(index, value) {
				
				var container = $('<div></div>').attr('id', 'ser_'+value.ordering).addClass('image_container');
				container.append(value.img);
				container.append($('<a></a>').attr('href', value.full).addClass('del_url_t delete-icon'));
				$('#currentfilelist').append(container);
				
			});
		}
		
		$.preloader('hide');
	
	}, 'json');
}


function init_the_uploader2(filelist_id) {
	var t = new Date().getTime();
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button : document.getElementById('pickfiles2'), // you can pass in id...
		container: document.getElementById('container2'), // ... or DOM Element itself
		url : root_url+'/ajax.php?action=FilelistUpload2&filelist_id='+filelist_id+'&t='+t,
		flash_swf_url : root_url+'/modules/Filelists/lib/uploader/Moxie.swf',
		silverlight_xap_url : root_url+'/modules/Filelists/lib/uploader/Moxie.xap',
		
		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "Image files", extensions : "jpg,jpeg,gif,png"},
				{title : "Zip files", extensions : "zip,rar,7z,gz" },
				{title : "Document file", extensions : "doc,docx,xls,xlsx,pdf" }
			]
		},

		init: {
			PostInit: function() {
				document.getElementById('filelist2').innerHTML = '';
			},

			FilesAdded: function(up, files) {
				
				/*plupload.each(files, function(file) {
					document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				});*/
				$.preloader('show');
				up.start();
			},

			UploadProgress: function(up, file) {
				//document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},
			
			UploadComplete: function() {
				get_current_files2(filelist_id);
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



function get_current_files2(filelist_id) {
	var t = new Date().getTime();
	$.preloader('show');
	$.post(root_url+'/ajax.php', {'action':'GetFilelistFileList2', 'filelist_id': filelist_id, 't': t}, function(data) {
		$('#currentfilelist2').html('');
		if (data.status == true) {
			$.each(data.files, function(index, value) {
				
				var container = $('<div></div>').attr('id', 'ser_'+value.ordering).addClass('image_container2');
				container.append(value.img);
				container.append($('<a></a>').attr('href', value.full).addClass('del_url_t2 delete-icon'));
				$('#currentfilelist2').append(container);
				
			});
		}
		
		$.preloader('hide');
	
	}, 'json');
}

$(document).ready(function() {
	$( "#currentfilelist" ).each(function() {
		
		$(this).sortable({
			items: "div.image_container",
			update: function( event, ui ) {
				var ser = $(this).sortable('serialize');
				
				$.preloader('show');
				var t = new Date().getTime();
				
				
				
				$.get(root_url + '/ajax.php?'+ser, {'action': 'FilelistSortImages', 'filelist_id': filelist_id, 't': t}, function(data) {
					get_current_files(filelist_id);
				});
			}
		});
	});
	
	$('body').on('click', '.del_url_t', function(e) {
		e.preventDefault();
		var file = $(this).attr('href');
		
		
		var t = new Date().getTime();
		
		if (confirm(delete_image)) {
			$.preloader('show');
			$.post(root_url+'/ajax.php', {'action':'DellFilelistFile', 'filelist_id': filelist_id, 'file': file, 't': t}, function(data) {
				get_current_files(filelist_id);
			});
		}
	});
	
	$( "#currentfilelist2" ).each(function() {
		
		$(this).sortable({
			items: "div.image_container2",
			update: function( event, ui ) {
				var ser = $(this).sortable('serialize');
				
				$.preloader('show');
				var t = new Date().getTime();
				
				
				
				$.get(root_url + '/ajax.php?'+ser, {'action': 'FilelistSortImages2', 'filelist_id': filelist_id, 't': t}, function(data) {
					get_current_files2(filelist_id);
				});
			}
		});
	});
	
	$('body').on('click', '.del_url_t2', function(e) {
		e.preventDefault();
		var file = $(this).attr('href');
		
		
		var t = new Date().getTime();
		
		if (confirm(delete_image2)) {
			$.preloader('show');
			$.post(root_url+'/ajax.php', {'action':'DellFilelistFile2', 'filelist_id': filelist_id, 'file': file, 't': t}, function(data) {
				get_current_files2(filelist_id);
			});
		}
	});
});