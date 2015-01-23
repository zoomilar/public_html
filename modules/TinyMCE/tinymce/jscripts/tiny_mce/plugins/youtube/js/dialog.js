tinyMCEPopup.requireLangPack();

var YouTubeDialog = {
	init : function() {
	},

	insert : function() {
		// Insert the contents from the input into the document
		var embedCode = '<iframe src="http://www.youtube.com/embed/'+document.forms[0].youtubeID.value+'" frameborder="0" width="'+document.forms[0].youtubeWidth.value+'" height="'+document.forms[0].youtubeHeight.value+'" ></iframe>';
		tinyMCEPopup.editor.execCommand('mceInsertRawHTML', false, embedCode);
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(YouTubeDialog.init, YouTubeDialog);
