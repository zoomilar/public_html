function init_the_uploader() {
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button : document.getElementById('pickfiles'), // you can pass in id...
		container: document.getElementById('container'), // ... or DOM Element itself
		url : root_url+'/ajax.php?action=ForumUpload',
		flash_swf_url : root_url+'/js/uploader/js/Moxie.swf',
		silverlight_xap_url : root_url+'/js/uploader/js/Moxie.xap',
		
		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "Image files", extensions : "jpg,jpeg,gif,png"},
				{title : "Doc files", extensions : "pdf,doc,docx,xls,xlsx"}
			]
		},

		init: {
			PostInit: function() {
				document.getElementById('filelist').innerHTML = '';

				/*document.getElementById('uploadfiles').onclick = function() {
					uploader.start();
					return false;
				};*/
			},

			FilesAdded: function(up, files) {
				
				plupload.each(files, function(file) {
					document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				});
				up.start();
			},

			UploadProgress: function(up, file) {
				document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
			},
			
			UploadComplete: function() {
				get_current_files();
				document.getElementById('filelist').innerHTML = '';
			},
			

			Error: function(up, err) {
				//console.log("\nError #" + err.code + ": " + err.message);
				document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
			}
		}
		
	});
	uploader.init();
}

function get_current_files() {

	$.post(root_url+'/ajax.php', {'action':'GetForumFileList'}, function(data) {
		$('#currentfilelist').html('');
		if (data.status == true) {
			$.each(data.files, function(index, value) {
				var container = $('<div></div>').addClass('file_row');
				
				container.append($('<a></a>').attr('href', value.full).addClass('del_url_t delete-icon'));
				container.append($('<a></a>').attr('href', value.full).addClass('add_url_t').text(value.name));
				//container.append('&nbsp;');
				//$('#currentfilelist').append($('<br/>'));
				
				$('#currentfilelist').append(container);
			});
		}
	
	}, 'json');
}

$(document).ready(function() {
	$('body').on('click', '.add_url_t', function(e) {
		e.preventDefault();
		
		$('input[name="smu_url"]').val($(this).prop('href'));
	});
	$('body').on('click', '.del_url_t', function(e) {
		e.preventDefault();
		
		//
		if (confirm(dell_file) == true) {
			if ($('input[name="smu_url"]').val() == $(this).prop('href')) {
				$('input[name="smu_url"]').val('');
			}
			$.post(root_url+'/ajax.php', {'action':'DellForumFile', 'file': $(this).prop('href')}, function(data) {
				get_current_files();
			});
		}
	});
});