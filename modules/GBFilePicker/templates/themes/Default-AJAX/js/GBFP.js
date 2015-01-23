//------------------------------------------------------------------------------
//
// Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net)
//          a filepicker tool for CMS Made Simple
//          The projects homepage is dev.cmsmadesimple.org/projects/gbfilepicker
//          CMS Made Simple is (c) 2004-2012 by Ted Kulp
//          The projects homepage is: cmsmadesimple.org
// Version: 1.3.3
// File   : GBFP.js
// License: GPL
//
//------------------------------------------------------------------------------

GBFP = {
	options: {
		title:'FilePicker',
		moduleId:'',
		draggable:true,
		dragAxis:'x',
		resizable:true,
		resizableHandles:'e,w',
		closeText:'Close',
		reloadText:'Reload',
		thumbnailWidth:96,
		thumbnailHeight:96,
		rootUrl:'..',
		fadeSpeed:300,
		animateSpeed:300,
		debug:false
	},
	fileBrowser: function(){
		return (document.getElementById('GBFP_header') != null);
	},
	getCurrentPickerId:function(){
		return GBFP.tmp.currentPickerId;
	},
	getCurrentDir:function(){
		return GBFP.tmp.currentDir;
	},
	getCurrentUrl:function(){
		return GBFP.tmp.currentUrl;
	},
	tmp: {
		currentPickerId:'',
		currentDir:'',
		currentUrl:'',
		height:0,
		fileListHeight:0,
		inputs:{},
		template:{}
	},
	inputs: {},
	init: function() {
		if(arguments[0] && GBFP.typeOf(arguments[0]) == 'object') {
			for (var i in arguments[0]) {
				if(typeof GBFP.options[i] != 'undefined') {
					GBFP.options[i] = arguments[0][i];
				}
				else if (i == 'inputs' && typeof arguments[0][i] == 'object') {
					for(var j in arguments[0][i]) {
						GBFP.registerInput(arguments[0][i][j]);
					}
				}
			}
		}
	},
	registerInput: function(obj) {
		var input = {
			id:'',
			moduleId:GBFP.options.moduleId,
			title: GBFP.options.title,
			draggable: GBFP.options.draggable,
			dragAxis: GBFP.options.dragAxis,
			resizable: GBFP.options.resizable,
			resizableHandles: GBFP.options.resizableHandles,
			closeText: GBFP.options.closeText,
			reloadText: GBFP.options.reloadText,
			thumbnailWidth: GBFP.options.thumbnailWidth,
			thumbnailHeight: GBFP.options.thumbnailHeight,
			animateSpeed:GBFP.options.animateSpeed,
			fadeSpeed:GBFP.options.fadeSpeed,
			debug:GBFP.options.debug,
			dir:null,
			mode:null,
			browseUrl:'',
			uploadUrl:''
		};
		if(typeof obj.id != 'undefined' && obj.id != '') {
			for (var i in obj) {
				if(typeof input[i] != 'undefined') {
					input[i] = obj[i];
				}
			}
			GBFP.inputs[input.id] = input;
			GBFP.inputs[input.id].titlebar = function() {
				return '<span id="GBFP_loading_img_wrapper"><img id="GBFP_loading_img" alt="" src="'+ GBFP.options.rootUrl +'/modules/GBFilePicker/templates/themes/Default-AJAX/img/loading.gif" /></span><h3 id="GBFP_title">' + this.title + '</h3><div id="GBFP_menu"><a id="GBFP_reload_dir" title="' + this.reloadText + '" href="#" onclick="GBFP.reloadDir();return false;">'+ this.reloadText +'</a><a id="GBFP_close" title="' + this.closeText + '" href="#" onclick="GBFP.close(GBFP.getCurrentPickerId());return false;">[X]</a><div class="clearb"></div></div><div class="clearb"></div>';
			};
		}
	},
	getTemplate: function(pickerId) {
		
		if(GBFP.inputs[pickerId].debug) {
			alert('creating template ... ');
		}
		
		if(document.getElementById('GBFP_content') != null) {
			GBFP.tmp.template['#GBFP_titlebar'].html(GBFP.inputs[pickerId].titlebar());
			
			if(GBFP.inputs[pickerId].debug) {
				alert('created titlebar');
			}
			
		}
		else {
			jQuery('body').append('<div id="GBFP_wrapper" class="pagecontainer"><div id="GBFP_background" onclick="GBFP.close(GBFP.getCurrentPickerId())"></div><div id="GBFP"><div id="GBFP_titlebar">' + GBFP.inputs[pickerId].titlebar() + '</div><div id="GBFP_content"></div></div></div>');
			
			if(GBFP.inputs[pickerId].debug) {
				alert('appended wrapper to body');
			}
			
			GBFP.tmp.template['#GBFP_wrapper']     = jQuery('#GBFP_wrapper');
			GBFP.tmp.template['#GBFP']             = jQuery("#GBFP");
			GBFP.tmp.template['#GBFP_content']     = jQuery("#GBFP_content");
			GBFP.tmp.template['#GBFP_titlebar']    = jQuery("#GBFP_titlebar");
			GBFP.tmp.template['#GBFP_background']  = jQuery('#GBFP_background');
		}
		
		GBFP.tmp.template['#GBFP_loading_img'] = jQuery("#GBFP_loading_img");
		
		jQuery(window).resize(function() {
			GBFP.resize();
		});
		GBFP.tmp.template['#GBFP_wrapper'].css('display','block').css('z-index',9999).css('opacity',1);
		if(GBFP.inputs[pickerId].draggable) {
			GBFP.tmp.template['#GBFP'].draggable({handle: '#GBFP_titlebar', containment: "parent", cursor: "move", axis:GBFP.inputs[pickerId].dragAxis});
		}
		if(GBFP.inputs[pickerId].resizable) {
			GBFP.tmp.template['#GBFP'].resizable({handles: GBFP.inputs[pickerId].resizableHandles});
		}
		return;
	},
	reloadDir: function() {
		GBFP.loadDir(GBFP.tmp.currentUrl,GBFP.tmp.currentPickerId,GBFP.tmp.currentDir);
	},
	toggleThumbnail: function (pickerId, url, title, alt) {
		if(typeof GBFP.inputs[pickerId] == 'undefined') {
			GBFP.registerInput({id:pickerId});
		}
		var thumbnailWrapper = jQuery('#' + pickerId + '_GBFP_thumbnail_wrapper');
		if(typeof thumbnailWrapper.attr('id') == 'undefined') {
			return;
		}
		thumbnailWrapper.fadeTo(GBFP.inputs[pickerId].fadeSpeed, 0, function () {
			thumbnailWrapper.html('');
			if(url != '') {
				var altTxt    = '',
					titleTxt  = '',
					altAttr   = '',
					titleAttr = '';
				if(typeof(title) != 'undefined') {
					titleTxt = title;
				}
				if(typeof(alt) != 'undefined') {
					altTxt = alt;
				}
				if(titleTxt != '') {
					titleAttr = ' title="' + titleTxt + '"';
				}
				if(altTxt != '') {
					altAttr = ' alt="' + altTxt + '"';
				}
				thumbnailWrapper.html('<img class="GBFP_thumbnail" id="' + pickerId + '_GBFP_thumbnail" src="' + url + '"' + titleAttr + altAttr + ' />').onImagesLoad({
					callbackIfNoImagesExist:true,
					all: function(elm) {
						var thumbnailSize = GBFP.getThumbnailSize(pickerId);
						//jQuery('#' + pickerId + '_GBFP_thumbnail').attr('width',thumbnailSize[0]).attr('height',thumbnailSize[1]);
						var img               = jQuery('#' + thumbnailWrapper.attr('id').replace('_wrapper', '')),
							//thumbHeight       = parseInt(img.height()),
							thumbHeight       = GBFP.inputs[pickerId].thumbnailHeight,
							thumbMarginTop    = parseInt(img.css('margin-top').replace(/[^\d]*/g, '')),
							thumbMarginBottom = parseInt(img.css('margin-bottom').replace(/[^\d]*/g, '')),
							thumbPaddingTop   = parseInt(img.css('padding-top').replace(/[^\d]*/g, '')),
							thumbPaddinBottom = parseInt(img.css('padding-bottom').replace(/[^\d]*/g, '')),
							thumbBorderTop    = parseInt(img.css('border-top-width').replace(/[^\d]*/g, '')),
							thumbBorderBottom = parseInt(img.css('border-bottom-width').replace(/[^\d]*/g, '')),
							newHeight         = eval((isNaN(thumbHeight) || typeof thumbHeight == 'undefined' ? 0 : thumbHeight) + (isNaN(thumbMarginTop) || typeof thumbMarginTop == 'undefined' ? 0 : thumbMarginTop) + (isNaN(thumbMarginBottom) || typeof thumbMarginBottom == 'undefined' ? 0 : thumbMarginBottom) + (isNaN(thumbPaddingTop) || typeof thumbPaddingTop == 'undefined' ? 0 : thumbPaddingTop) + (isNaN(thumbPaddinBottom) || typeof thumbPaddinBottom == 'undefined' ? 0 : thumbPaddinBottom) + (isNaN(thumbBorderTop) || typeof thumbBorderTop == 'undefined' ? 0 : thumbBorderTop) + (isNaN(thumbBorderBottom) || typeof thumbBorderBottom == 'undefined' ? 0 : thumbBorderBottom));
						thumbnailWrapper.animate({height:newHeight+'px'}, GBFP.inputs[pickerId].animateSpeed, 'swing', function() {
							thumbnailWrapper.fadeTo(GBFP.inputs[pickerId].fadeSpeed, 1);
						});
					}
				});
			}
			else {
				thumbnailWrapper.animate({height:'0px'});
			}
		});
	},
	getThumbnailSize: function(pickerId) {
		var thumbImg    = document.getElementById(pickerId + '_GBFP_thumbnail'),
			origWidth   = thumbImg.width,
			origHeight  = thumbImg.height,
			aspectratio = eval(origWidth / origHeight),
			newWidth    = Math.floor(GBFP.inputs[pickerId].thumbnailWidth),
			newHeight   = Math.floor(GBFP.inputs[pickerId].thumbnailHeight);
		
		if(newWidth <= 0) {
			newWidth = 96;
		}
		if(newHeight <= 0) {
			newHeight = 96;
		}
		if(newWidth > origWidth) {
			newWidth = origWidth;
		}
		if(newHeight > origHeight) {
			newHeight = origHeight;
		}
		
		var newAspectratio = eval(newWidth / newHeight);
		
		if(aspectratio > 1 && newAspectratio < 1) { // landscape to portrait
			var _tmp = Math.floor(eval(newWidth / aspectratio));
			if(_tmp > 0 && _tmp <= newHeight) {
				newHeight = _tmp;
			}
		}
		else if(aspectratio < 1 && newAspectratio > 1) { // portrait to landscape
			var _tmp = Math.floor(eval(newHeight * aspectratio));
			if(_tmp > 0 && _tmp <= newWidth) {
				newWidth = _tmp;
			}
		}
		else {
			if(newAspectratio < aspectratio) {
				var _tmp = Math.floor(eval(newWidth / aspectratio));
				if(_tmp > 0 && _tmp <= newHeight) {
					newHeight = _tmp;
				}
			}
			else if(newAspectratio > aspectratio) {
				var _tmp = Math.floor(eval(newHeight * aspectratio));
				if(_tmp > 0 && _tmp <= newWidth) {
					newWidth = _tmp;
				}
			}
		}
		if(newWidth < 1) {
			newWidth = 1;
		}
		if(newHeight < 1) {
			newHeight = 1;
		}
		return new Array(newWidth, newHeight);
	},
	close: function (pickerId) {
		jQuery(window).unbind('resize');
		GBFP.tmp.template['#GBFP_loading_img'].css('display','none');
		GBFP.tmp.template['#GBFP_wrapper'].fadeTo(GBFP.inputs[pickerId].fadeSpeed,0,function(){
			GBFP.tmp.template['#GBFP_wrapper'].css('display','none').css('z-index',-9999);
			if(GBFP.ieVersion() < 8) {
				GBFP.tmp.template['#GBFP_wrapper'].remove();
			}
			else {
				GBFP.tmp.template['#GBFP_background'].css('display','none').css('opacity',0);
				GBFP.tmp.template['#GBFP_content'].html('').css('opacity',0);
				var attribs = {
					titleBarHeight:        GBFP.tmp.template['#GBFP_titlebar'].height(),
					titleBarPaddingTop:    GBFP.tmp.template['#GBFP_titlebar'].css('padding-top').replace(/[^\d]*/g, ''),
					titleBarPaddingBottom: GBFP.tmp.template['#GBFP_titlebar'].css('padding-bottom').replace(/[^\d]*/g, ''),
					titleBarMarginTop:     GBFP.tmp.template['#GBFP_titlebar'].css('margin-top').replace(/[^\d]*/g, ''),
					titleBarMarginBottom:  GBFP.tmp.template['#GBFP_titlebar'].css('margin-bottom').replace(/[^\d]*/g, ''),
					titleBarBorderTop:     GBFP.tmp.template['#GBFP_titlebar'].css('border-top-width').replace(/[^\d]*/g, ''),
					titleBarBorderBottom:  GBFP.tmp.template['#GBFP_titlebar'].css('border-bottom-width').replace(/[^\d]*/g, ''),
					gbfpPaddingTop:    GBFP.tmp.template['#GBFP'].css('padding-top').replace(/[^\d]*/g, ''),
					gbfpPaddingBottom: GBFP.tmp.template['#GBFP'].css('padding-bottom').replace(/[^\d]*/g, ''),
					gbfpMarginTop:     GBFP.tmp.template['#GBFP'].css('margin-top').replace(/[^\d]*/g, ''),
					gbfpMarginBottom:  GBFP.tmp.template['#GBFP'].css('margin-bottom').replace(/[^\d]*/g, ''),
					gbfpBorderTop:     GBFP.tmp.template['#GBFP'].css('border-top-width').replace(/[^\d]*/g, ''),
					gbfpBorderBottom:  GBFP.tmp.template['#GBFP'].css('border-bottom-width').replace(/[^\d]*/g, '')
				}
				
				var gbfpHeight = 0;
				for(var i in attribs) {
					attribs[i] = parseInt(attribs[i]);
					if(typeof attribs[i] == 'undefined' || attribs[i] == 'undefined' || isNaN(attribs[i])) {
						attribs[i] = 0;
					}
					
					gbfpHeight = eval(gbfpHeight + attribs[i]);
				}
				
				GBFP.tmp.template['#GBFP'].css('height', gbfpHeight + 'px').css('display','none').css('opacity',0);
				
			}
			GBFP.tmp.currentUrl      = '';
			GBFP.tmp.currentDir      = '';
			GBFP.tmp.currentPickerId = '';
			GBFP.tmp.height          = 0;
			GBFP.tmp.fileListHeight  = 0;
		});
		return false;
	},
	loadDir: function (url, pickerId) {
		if(typeof GBFP.inputs[pickerId] == 'undefined') {
			GBFP.registerInput({id:pickerId});
		}
		var dir;
		if(typeof arguments[2] != 'undefined') {
			dir = arguments[2];
		}
		if(GBFP.fileBrowser() == false) {
			
			/**
			 * open filepicker
			 */
			
			GBFP.getTemplate(pickerId);
			
			GBFP.tmp.template['#GBFP_background'].css('display','block').fadeTo(GBFP.inputs[pickerId].fadeSpeed, 0.65, function () {
				
				if(GBFP.inputs[pickerId].debug) {
					alert('faded in background');
				}
				
				GBFP.tmp.template['#GBFP'].css('display','block').fadeTo(GBFP.inputs[pickerId].fadeSpeed, 1, function() {
					GBFP.tmp.template['#GBFP_loading_img'].css('display','block');
						
					if(GBFP.inputs[pickerId].debug) {
						alert('loading from server');
					}
					
					jQuery.get(url + '&' + GBFP.inputs[pickerId].moduleId + 'showtemplate=false&'  + GBFP.inputs[pickerId].moduleId + 'disable_theme=1&' + GBFP.inputs[pickerId].moduleId + 'ajax=1', function(data) {
						
						if(GBFP.inputs[pickerId].debug) {
							alert('content loaded');
						}
						
						GBFP.tmp.template['#GBFP'].css('height',GBFP.tmp.template['#GBFP'].height() + 'px');
						GBFP.tmp.template['#GBFP_content'].html(data);
						
						if(GBFP.inputs[pickerId].debug) {
							alert('replaced content with loaded data');
						}
						
						GBFP.tmp.template['#GBFP_header']   = jQuery("#GBFP_header");
						GBFP.ajaxForm();
						GBFP.tmp.template['#GBFP_filelist'] = jQuery("#GBFP_filelist");
						if(typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
							GBFP.tmp.template['#GBFP_fileoperations']        = jQuery('#GBFP_fileoperations');
							GBFP.tmp.template['#GBFP_toggle_fileoperations'] = jQuery('#GBFP_toggle_fileoperations');
							GBFP.tmp.template['#GBFP_filelist'].css('max-height','').css('opacity',1);;
							
							if(GBFP.inputs[pickerId].debug) {
								alert('set max-height to "" + faded in filelist');
							}
						}
						
						if(jQuery('#GBFP_content img').length) {
							GBFP.tmp.template['#GBFP_content'].onImagesLoad({
								callbackIfNoImagesExist:true,
								all: function (elm) {
									
									if(GBFP.inputs[pickerId].debug) {
										alert('images loaded; GBFP.tmp.height:' + GBFP.tmp.height);
									}
									
									GBFP.getHeight();
									if(typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
										GBFP.tmp.template['#GBFP_filelist'].css('max-height', GBFP.tmp.fileListHeight + 'px');
										if(GBFP.inputs[pickerId].debug) {
											alert('set max-height to ' + GBFP.tmp.fileListHeight + '; GBFP.tmp.height:' + GBFP.tmp.height);
										}
									}
									if(GBFP.ieVersion() < 8) {
										GBFP.tmp.template['#GBFP'].css('height','auto');
									}
									GBFP.tmp.template['#GBFP'].animate({height: GBFP.tmp.height + (GBFP.tmp.height != 'auto' ? 'px' : '')}, GBFP.inputs[pickerId].animateSpeed , 'swing', function() {
										
										if(GBFP.inputs[pickerId].debug) {
											alert('animated height; GBFP.tmp.height:' + GBFP.tmp.height);
										}
										
										GBFP.tmp.template['#GBFP_content'].fadeTo(GBFP.inputs[pickerId].fadeSpeed, 1, function() {
											GBFP.tmp.template['#GBFP_loading_img'].css('display','none');
											
											if(GBFP.inputs[pickerId].debug) {
												alert('faded in content');
											}
											
										});
									});
								}
							});
						}
						else {
							GBFP.getHeight();
							if(typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
								GBFP.tmp.template['#GBFP_filelist'].css('max-height', GBFP.tmp.fileListHeight + 'px');
								if(GBFP.inputs[pickerId].debug) {
									alert('set max-height to ' + GBFP.tmp.fileListHeight);
								}
							}
							if(GBFP.ieVersion() < 8) {
								GBFP.tmp.template['#GBFP'].css('height','auto');
							}
							GBFP.tmp.template['#GBFP'].animate({height: GBFP.tmp.height + (GBFP.tmp.height != 'auto' ? 'px' : '')}, GBFP.inputs[pickerId].animateSpeed , 'swing', function() {
								
								if(GBFP.inputs[pickerId].debug) {
									alert('animated height');
								}
								
								GBFP.tmp.template['#GBFP_content'].fadeTo(GBFP.inputs[pickerId].fadeSpeed, 1, function() {
									GBFP.tmp.template['#GBFP_loading_img'].css('display','none');
									
									if(GBFP.inputs[pickerId].debug) {
										alert('faded in content');
									}
									
								});
							});
						}
					});
				});
			});
		}
		else {
			
			/**
			 * loading selected dir
			 */
			
			GBFP.tmp.template['#GBFP_loading_img'].css('display','block');
			if(GBFP.inputs[pickerId].debug) {
				alert('loading from server');
			}
			
			jQuery.get(url + '&' + GBFP.inputs[pickerId].moduleId + 'showtemplate=false&'  + GBFP.inputs[pickerId].moduleId + 'disable_theme=1&' + GBFP.inputs[pickerId].moduleId + 'ajax=1', function(data) {
					
				if(GBFP.inputs[pickerId].debug) {
					alert('content loaded');
				}
				
				if(typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
					var fadeId = '#GBFP_filelist';
				}
				else {
					var fadeId = '#GBFP_content';
				}
				GBFP.tmp.template[fadeId].fadeTo(GBFP.inputs[pickerId].fadeSpeed, 0, function() {
					
					if(GBFP.inputs[pickerId].debug) {
						alert('faded out filelist');
					}
					
					GBFP.tmp.template['#GBFP'].css('height',GBFP.tmp.template['#GBFP'].height() + 'px');
					GBFP.tmp.template['#GBFP_content'].html(data);
					
					if(GBFP.inputs[pickerId].debug) {
						alert('replaced content with loaded data');
					}
					GBFP.tmp.template['#GBFP_header']   = jQuery("#GBFP_header");
					GBFP.ajaxForm();
					GBFP.tmp.template['#GBFP_filelist'] = jQuery("#GBFP_filelist");
					if(typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
						GBFP.tmp.template['#GBFP_fileoperations']        = jQuery('#GBFP_fileoperations');
						GBFP.tmp.template['#GBFP_toggle_fileoperations'] = jQuery('#GBFP_toggle_fileoperations');
						GBFP.tmp.template['#GBFP_filelist'].css('max-height','');
						if(GBFP.inputs[pickerId].debug) {
							alert('set max-height to ""');
						}
					}
					if(jQuery('#GBFP_content img').length) {
						GBFP.tmp.template['#GBFP_content'].onImagesLoad({
							callbackIfNoImagesExist:true,
							all: function (elm) {
								
								if(GBFP.inputs[pickerId].debug) {
									alert('images loaded');
								}
								
								GBFP.getHeight();
								if(typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
									GBFP.tmp.template['#GBFP_filelist'].css('max-height', GBFP.tmp.fileListHeight + 'px');
									
									if(GBFP.inputs[pickerId].debug) {
										alert('set max-height to ' + GBFP.tmp.fileListHeight);
									}
								}
								if(GBFP.ieVersion() < 8) {
									GBFP.tmp.template['#GBFP'].css('height','auto');
								}
								GBFP.tmp.template['#GBFP'].animate({height: GBFP.tmp.height + (GBFP.tmp.height != 'auto' ? 'px' : '')}, GBFP.inputs[pickerId].animateSpeed , 'swing', function() {
										
									if(GBFP.inputs[pickerId].debug) {
										alert('animated height');
									}
									
									if(typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
										var fadeId = '#GBFP_filelist';
									}
									else {
										var fadeId = '#GBFP_content';
									}
									GBFP.tmp.template[fadeId].fadeTo(GBFP.inputs[pickerId].fadeSpeed, 1, function() {
										GBFP.tmp.template['#GBFP_loading_img'].css('display','none');
										
										if(GBFP.inputs[pickerId].debug) {
											alert('faded in filelist');
										}
										
									});
								});
							}
						});
					}
					else {
						GBFP.getHeight();
						if(typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
							GBFP.tmp.template['#GBFP_filelist'].css('max-height', GBFP.tmp.fileListHeight + 'px');
							if(GBFP.inputs[pickerId].debug) {
								alert('set max-height to ' + GBFP.tmp.fileListHeight);
							}
						}
						if(GBFP.ieVersion() < 8) {
							GBFP.tmp.template['#GBFP'].css('height','auto');
						}
						GBFP.tmp.template['#GBFP'].animate({height: GBFP.tmp.height + (GBFP.tmp.height != 'auto' ? 'px' : '')}, GBFP.inputs[pickerId].animateSpeed , 'swing', function() {
								
							if(GBFP.inputs[pickerId].debug) {
								alert('animated height');
							}
							
							if(typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
								var fadeId = '#GBFP_filelist';
							}
							else {
								var fadeId = '#GBFP_content';
							}
							GBFP.tmp.template[fadeId].fadeTo(GBFP.inputs[pickerId].fadeSpeed, 1, function() {
								GBFP.tmp.template['#GBFP_loading_img'].css('display','none');
								
								if(GBFP.inputs[pickerId].debug) {
									alert('faded in filelist');
								}
								
							});
						});
					}
				});
			});
		}
		GBFP.tmp.currentPickerId = pickerId;
		GBFP.tmp.currentDir      = dir;
		GBFP.tmp.currentUrl      = url;
		return false;
	},
	getHeight: function () {
		
		var e = 'all';
		if(arguments[0]) {
			e = arguments[0];
		}
		
		if(e == 'fileoperations' && typeof GBFP.tmp.template['#GBFP_fileoperations'].attr('id') != 'undefined') {
			var headerHeight = GBFP.tmp.template['#GBFP_header'].height();
				attribs = {
					fileOperationsHeight:        GBFP.tmp.template['#GBFP_fileoperations'].height(),
					fileOperationsPaddingTop:    GBFP.tmp.template['#GBFP_fileoperations'].css('padding-top').replace(/[^\d]*/g, ''),
					fileOperationsPaddingBottom: GBFP.tmp.template['#GBFP_fileoperations'].css('padding-bottom').replace(/[^\d]*/g, ''),
					fileOperationsMarginTop:     GBFP.tmp.template['#GBFP_fileoperations'].css('margin-top').replace(/[^\d]*/g, ''),
					fileOperationsMarginBottom:  GBFP.tmp.template['#GBFP_fileoperations'].css('margin-bottom').replace(/[^\d]*/g, ''),
					fileOperationsBorderTop:     GBFP.tmp.template['#GBFP_fileoperations'].css('border-top-width').replace(/[^\d]*/g, ''),
					fileOperationsBorderBottom:  GBFP.tmp.template['#GBFP_fileoperations'].css('border-bottom-width').replace(/[^\d]*/g, '')
				};
			if(GBFP.tmp.template['#GBFP_toggle_fileoperations'].attr('class') == 'notifications-show') {
				for(var i in attribs) {
					attribs[i] = parseInt(attribs[i]);
					if(typeof attribs[i] == 'undefined' || attribs[i] == 'undefined' || isNaN(attribs[i])) {
						attribs[i] = 0;
					}
					headerHeight = eval(headerHeight - attribs[i]);
				}
			}
			else if(GBFP.tmp.template['#GBFP_toggle_fileoperations'].attr('class') == 'notifications-hide') {
				attribs.foo = 0; // dunno why i need to do this
				for(var i in attribs) {
					attribs[i] = parseInt(attribs[i]);
					if(typeof attribs[i] == 'undefined' || attribs[i] == 'undefined' || isNaN(attribs[i])) {
						attribs[i] = 0;
					}
					headerHeight = eval(headerHeight + attribs[i]);
				}
			}
		}
		
		if ((e == 'filelist' || e == 'all' || e == 'fileoperations') && typeof GBFP.tmp.template['#GBFP_filelist'] != 'undefined' && typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
		
			if(typeof headerHeight == 'undefined') {
				var headerHeight = GBFP.tmp.template['#GBFP_header'].height();
			}
			var attribs = {
					headerHeight:        headerHeight,
					headerPaddingTop:    GBFP.tmp.template['#GBFP_header'].css('padding-top').replace(/[^\d]*/g, ''),
					headerPaddingBottom: GBFP.tmp.template['#GBFP_header'].css('padding-bottom').replace(/[^\d]*/g, ''),
					headerMarginTop:     GBFP.tmp.template['#GBFP_header'].css('margin-top').replace(/[^\d]*/g, ''),
					headerMarginBottom:  GBFP.tmp.template['#GBFP_header'].css('margin-bottom').replace(/[^\d]*/g, ''),
					headerBorderTop:     GBFP.tmp.template['#GBFP_header'].css('border-top-width').replace(/[^\d]*/g, ''),
					headerBorderBottom:  GBFP.tmp.template['#GBFP_header'].css('border-bottom-width').replace(/[^\d]*/g, ''),
					filelistPaddingTop:    GBFP.tmp.template['#GBFP_filelist'].css('padding-top').replace(/[^\d]*/g, ''),
					filelistPaddingBottom: GBFP.tmp.template['#GBFP_filelist'].css('padding-bottom').replace(/[^\d]*/g, ''),
					filelistMarginTop:     GBFP.tmp.template['#GBFP_filelist'].css('margin-top').replace(/[^\d]*/g, ''),
					filelistMarginBottom:  GBFP.tmp.template['#GBFP_filelist'].css('margin-bottom').replace(/[^\d]*/g, ''),
					filelistBorderTop:     GBFP.tmp.template['#GBFP_filelist'].css('border-top-width').replace(/[^\d]*/g, ''),
					filelistBorderBottom:  GBFP.tmp.template['#GBFP_filelist'].css('border-bottom-width').replace(/[^\d]*/g, ''),
					contentPaddingTop:    GBFP.tmp.template['#GBFP_content'].css('padding-top').replace(/[^\d]*/g, ''),
					contentPaddingBottom: GBFP.tmp.template['#GBFP_content'].css('padding-bottom').replace(/[^\d]*/g, ''),
					contentMarginTop:     GBFP.tmp.template['#GBFP_content'].css('margin-top').replace(/[^\d]*/g, ''),
					contentMarginBottom:  GBFP.tmp.template['#GBFP_content'].css('margin-bottom').replace(/[^\d]*/g, ''),
					contentBorderTop:     GBFP.tmp.template['#GBFP_content'].css('border-top-width').replace(/[^\d]*/g, ''),
					contentBorderBottom:  GBFP.tmp.template['#GBFP_content'].css('border-bottom-width').replace(/[^\d]*/g, ''),
					titlebarHeight:        GBFP.tmp.template['#GBFP_titlebar'].height(),
					titlebarPaddingTop:    GBFP.tmp.template['#GBFP_titlebar'].css('padding-top').replace(/[^\d]*/g, ''),
					titlebarPaddingBottom: GBFP.tmp.template['#GBFP_titlebar'].css('padding-bottom').replace(/[^\d]*/g, ''),
					titlebarMarginTop:     GBFP.tmp.template['#GBFP_titlebar'].css('margin-top').replace(/[^\d]*/g, ''),
					titlebarMarginBottom:  GBFP.tmp.template['#GBFP_titlebar'].css('margin-bottom').replace(/[^\d]*/g, ''),
					titlebarBorderTop:     GBFP.tmp.template['#GBFP_titlebar'].css('border-top-width').replace(/[^\d]*/g, ''),
					titlebarBorderBottom:  GBFP.tmp.template['#GBFP_titlebar'].css('border-bottom-width').replace(/[^\d]*/g, ''),
					gbfpPaddingTop:    GBFP.tmp.template['#GBFP'].css('padding-top').replace(/[^\d]*/g, ''),
					gbfpPaddingBottom: GBFP.tmp.template['#GBFP'].css('padding-bottom').replace(/[^\d]*/g, ''),
					gbfpMarginTop:     GBFP.tmp.template['#GBFP'].css('margin-top').replace(/[^\d]*/g, ''),
					gbfpMarginBottom:  GBFP.tmp.template['#GBFP'].css('margin-bottom').replace(/[^\d]*/g, ''),
					gbfpBorderTop:     GBFP.tmp.template['#GBFP'].css('border-top-width').replace(/[^\d]*/g, ''),
					gbfpBorderBottom:  GBFP.tmp.template['#GBFP'].css('border-bottom-width').replace(/[^\d]*/g, '')
				},
				minHeight = parseInt(GBFP.tmp.template['#GBFP_filelist'].css('min-height').replace(/[^\d]*/g,''));
			
			minHeight = typeof minHeight == 'undefined' || isNaN(minHeight) ? 0 : minHeight;
			
			GBFP.tmp.fileListHeight = parseInt(jQuery(window).height());
			GBFP.tmp.fileListHeight = typeof GBFP.tmp.fileListHeight == 'undefined' || isNaN(GBFP.tmp.fileListHeight) ? 0 : GBFP.tmp.fileListHeight;
			
			for(var i in attribs) {
				attribs[i] = parseInt(attribs[i]);
				if(typeof attribs[i] == 'undefined' || attribs[i] == 'undefined' || isNaN(attribs[i])) {
					attribs[i] = 0;
				}
				GBFP.tmp.fileListHeight = eval(GBFP.tmp.fileListHeight - attribs[i]);
			}
			
			if(GBFP.tmp.fileListHeight <= minHeight) {
				GBFP.tmp.fileListHeight = minHeight;
			}
		}
		if(e == 'gbfp' || e == 'all' || e == 'fileoperations') {
			if(GBFP.ieVersion() < 8) {
				GBFP.tmp.height = 'auto';
				return;
			}
			var contentHeight  = GBFP.tmp.template['#GBFP_content'].height(),
				fileListHeight = GBFP.tmp.template['#GBFP_filelist'].height();
			
			contentHeight  = typeof contentHeight == 'undefined' || isNaN(contentHeight) ? 0 : contentHeight;
			fileListHeight = typeof fileListHeight == 'undefined' || isNaN(fileListHeight) ? 0 : fileListHeight;
			
			if(fileListHeight > GBFP.tmp.fileListHeight) {
				GBFP.tmp.height = eval(contentHeight - fileListHeight + GBFP.tmp.fileListHeight);
			}
			else {
				GBFP.tmp.height = contentHeight;
			}
			// dunno why i need to do this
			if(!fileListHeight && !GBFP.tmp.fileListHeight) {
				GBFP.tmp.height = eval(GBFP.tmp.height + 5);
			}
			//---
			var attribs = {
				titlebarHeight:        GBFP.tmp.template['#GBFP_titlebar'].height(),
				titlebarPaddingTop:    GBFP.tmp.template['#GBFP_titlebar'].css('padding-top').replace(/[^\d]*/g, ''),
				titlebarPaddingBottom: GBFP.tmp.template['#GBFP_titlebar'].css('padding-bottom').replace(/[^\d]*/g, ''),
				titlebarMarginTop:     GBFP.tmp.template['#GBFP_titlebar'].css('margin-top').replace(/[^\d]*/g, ''),
				titlebarMarginBottom:  GBFP.tmp.template['#GBFP_titlebar'].css('margin-bottom').replace(/[^\d]*/g, ''),
				titlebarBorderTop:     GBFP.tmp.template['#GBFP_titlebar'].css('border-top-width').replace(/[^\d]*/g, ''),
				titlebarBorderBottom:  GBFP.tmp.template['#GBFP_titlebar'].css('border-bottom-width').replace(/[^\d]*/g, ''),
				gbfpContentPaddingTop:    GBFP.tmp.template['#GBFP_content'].css('padding-top').replace(/[^\d]*/g, ''),
				gbfpContentPaddingBottom: GBFP.tmp.template['#GBFP_content'].css('padding-bottom').replace(/[^\d]*/g, ''),
				gbfpContentMarginTop:     GBFP.tmp.template['#GBFP_content'].css('margin-top').replace(/[^\d]*/g, ''),
				gbfpContentMarginBottom:  GBFP.tmp.template['#GBFP_content'].css('margin-bottom').replace(/[^\d]*/g, ''),
				gbfpContentBorderTop:     GBFP.tmp.template['#GBFP_content'].css('border-top-width').replace(/[^\d]*/g, ''),
				gbfpContentBorderBottom:  GBFP.tmp.template['#GBFP_content'].css('border-bottom-width').replace(/[^\d]*/g, ''),
				gbfpPaddingTop:    GBFP.tmp.template['#GBFP'].css('padding-top').replace(/[^\d]*/g, ''),
				gbfpPaddingBottom: GBFP.tmp.template['#GBFP'].css('padding-bottom').replace(/[^\d]*/g, ''),
				foo:10 // dunno why i need to do this
			};
			for(var i in attribs) {
				attribs[i] = parseInt(attribs[i]);
				if(typeof attribs[i] == 'undefined' || attribs[i] == 'undefined' || isNaN(attribs[i])) {
					attribs[i] = 0;
				}
				GBFP.tmp.height = eval(GBFP.tmp.height + attribs[i]);
			}
			
			attribs = {
				gbfpMarginTop:    GBFP.tmp.template['#GBFP'].css('margin-top').replace(/[^\d]*/g, ''),
				gbfpMarginBottom: GBFP.tmp.template['#GBFP'].css('margin-bottom').replace(/[^\d]*/g, ''),
				gbfpBorderTop:    GBFP.tmp.template['#GBFP'].css('border-top-width').replace(/[^\d]*/g, ''),
				gbfpBorderBottom: GBFP.tmp.template['#GBFP'].css('border-bottom-width').replace(/[^\d]*/g, '')
			};
			for(var i in attribs) {
				attribs[i] = parseInt(attribs[i]);
				if(typeof attribs[i] == 'undefined' || attribs[i] == 'undefined' || isNaN(attribs[i])) {
					attribs[i] = 0;
				}
				GBFP.tmp.height = eval(GBFP.tmp.height - attribs[i]);
			}
		}
	},
	resize: function() {
		var e = 'filelist';
		if(typeof arguments[0] != 'undefined') {
			e = arguments[0];
		}
		GBFP.getHeight(e);
		GBFP.tmp.template['#GBFP'].css('height', 'auto');
		if(typeof GBFP.tmp.template['#GBFP_filelist'] != 'undefined') {
			GBFP.tmp.template['#GBFP_filelist'].css('max-height', GBFP.tmp.fileListHeight + 'px');
		}
		return false;
	},
	pickFile: function (url, pickerId) {
		if(typeof GBFP.inputs[pickerId] == 'undefined') {
			GBFP.registerInput({id:pickerId});
		}
		jQuery('#' + pickerId).val(url);
		GBFP.close(pickerId);
		jQuery('#' + pickerId).trigger('change');
		return false;
	},
	reloadDropdown: function (url, targetId) {
		
		if(typeof GBFP.inputs[targetId] == 'undefined') {
			GBFP.registerInput({id:targetId});
		}
		
		var targetWrapper = jQuery('#' + targetId + '_GBFP_dropdown_wrapper'),
			reloadLink    = jQuery('#' + targetId + '_GBFP_reload_dropdown'),
			uploadLink    = jQuery('#' + targetId + '_GBFP_upload'),
			input         = jQuery('#' + targetId);
		
		if(typeof targetWrapper.attr('id') == 'undefined') {
			return;
		}
		var selOpt = jQuery('#' + targetId + ' option:selected:first');
		targetWrapper.closest('.GBFP_input_wrapper').children('img.GBFP_loading_img:first').removeAttr('style');
		targetWrapper.closest('.GBFP_input_wrapper').find('.GBFP_link').addClass('GBFP_disabled').unbind('click').click(function(){return false;});
		input.attr('disabled','disabled').addClass('GBFP_disabled').unbind('change');
		targetWrapper.addClass('GBFP_disabled').fadeTo(GBFP.inputs[targetId].fadeSpeed, 0, function () {
			jQuery.get(url + '&' + GBFP.inputs[targetId].moduleId + 'showtemplate=false&'  + GBFP.inputs[targetId].moduleId + 'disable_theme=1&' + GBFP.inputs[targetId].moduleId + 'ajax=1&' + GBFP.inputs[targetId].moduleId + 'value=' + selOpt.attr('value'), function(data) {
				// replace
				targetWrapper.html(data);
				// toggle thumbnail
				var selOpt = jQuery('#' + targetId + ' option:selected:first');
				GBFP.toggleThumbnail(targetId,selOpt.attr('thumbnail'),selOpt.attr('value'),selOpt.attr('value'));
				// fade in
				targetWrapper.fadeTo(GBFP.inputs[targetId].fadeSpeed, 1, function(){
					reloadLink.removeClass('GBFP_disabled').unbind('click').click(function(){
						var pickerId = this.id.substr(0,this.id.lastIndexOf('_GBFP_reload_dropdown'));
						if(GBFP.inputs[pickerId].browseUrl != '')
							GBFP.reloadDropdown(GBFP.inputs[pickerId].browseUrl, pickerId);
						return false;
					});
					uploadLink.removeClass('GBFP_disabled').unbind('click').click(function(){
						var pickerId = this.id.substr(0,this.id.lastIndexOf('_GBFP_upload'));
						if(GBFP.inputs[pickerId].uploadUrl != '')
							GBFP.loadDir(GBFP.inputs[pickerId].uploadUrl, pickerId);
						return false;
					});
					jQuery('#' + targetId).removeAttr('disabled').removeClass('GBFP_disabled').change(function(){
						GBFP.toggleThumbnail(this.id, jQuery('#'+this.id+' option:selected:first').attr('thumbnail'),this.value,this.value);
					});
					targetWrapper.closest('.GBFP_input_wrapper').children('img.GBFP_loading_img:first').css('display','none');
				});
			});
		});
	},
	selectAll: function (obj) {
		if (obj.value == 1) {
			jQuery('input[name^="'+obj.id+'-"]').attr('checked','checked');
			obj.value = 0;
		}
		else {
			jQuery('input[name^="'+obj.id+'-"]').removeAttr('checked');
			obj.value = 1;
		}
	},
	typeOf: function (value) {
		var type = typeof value;
		if (type === 'object') {
			if (value) {
				if (value instanceof Array) {
					type = 'array';
				}
			} else {
				type = 'null';
			}
		}
		return type;
	},
	ajaxForm: function () {
		var form = jQuery('#GBFP_header form:first');
		if(form.attr('id') != 'undefined') {
			form.append('<input type="hidden" name="'+GBFP.inputs[GBFP.tmp.currentPickerId].moduleId+'disable_theme" value="1" />');
			form.append('<input type="hidden" name="'+GBFP.inputs[GBFP.tmp.currentPickerId].moduleId+'showtemplate" value="false" />');
			form.append('<input type="hidden" name="'+GBFP.inputs[GBFP.tmp.currentPickerId].moduleId+'ajax" value="1" />');
			
			var options = {
				beforeSubmit: function(formData, jqForm, options){
					GBFP.tmp.template['#GBFP_loading_img'].css('display','block');
					jqForm.find('input').addClass('GBFP_disabled');
					return true;
				},
				success: function(responseText) {
					GBFP.tmp.template['#GBFP_content'].fadeTo(GBFP.inputs[GBFP.tmp.currentPickerId].fadeSpeed, 0, function() {
						GBFP.tmp.template['#GBFP_content'].html(responseText);
						
						GBFP.tmp.template['#GBFP_header']   = jQuery("#GBFP_header");
						GBFP.tmp.template['#GBFP_filelist'] = jQuery("#GBFP_filelist");
						if(typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
							GBFP.tmp.template['#GBFP_fileoperations']        = jQuery('#GBFP_fileoperations');
							GBFP.tmp.template['#GBFP_toggle_fileoperations'] = jQuery('#GBFP_toggle_fileoperations');
							GBFP.tmp.template['#GBFP_filelist'].css('max-height', '').css('opacity','1');
						}
						GBFP.tmp.template['#GBFP_content'].onImagesLoad({
							callbackIfNoImagesExist:true,
							all: function() {
								GBFP.getHeight();
								if(typeof GBFP.tmp.template['#GBFP_filelist'].attr('id') != 'undefined') {
									GBFP.tmp.template['#GBFP_filelist'].css('max-height', GBFP.tmp.fileListHeight + 'px');
								}
								if(GBFP.ieVersion() < 8) {
									GBFP.tmp.template['#GBFP'].css('height','auto');
								}
								GBFP.tmp.template['#GBFP'].animate({height: GBFP.tmp.height + (GBFP.tmp.height != 'auto' ? 'px' : '')}, GBFP.inputs[GBFP.tmp.currentPickerId].animateSpeed , 'swing', function() {
									GBFP.tmp.template['#GBFP_content'].fadeTo(GBFP.inputs[GBFP.tmp.currentPickerId].fadeSpeed, 1, function() {
										
										for(var i in GBFP.inputs)
											GBFP.reloadDropdown(GBFP.inputs[i].browseUrl, i);
										
										GBFP.tmp.template['#GBFP_loading_img'].css('display','none');
										GBFP.ajaxForm();
									});
								});
							}
						});
					});
					return false;
				}
			};
			form.ajaxForm(options);
		}
	},
	deleteFile: function (url, confirmMsg, value) {
		var conf = confirm(confirmMsg);
		if(conf) {
			var _url = GBFP.tmp.currentUrl;
			GBFP.loadDir(url + '&' + GBFP.inputs[GBFP.tmp.currentPickerId].moduleId + 'showtemplate=false&'  + GBFP.inputs[GBFP.tmp.currentPickerId].moduleId + 'disable_theme=1&' + GBFP.inputs[GBFP.tmp.currentPickerId].moduleId + 'ajax=1',GBFP.tmp.currentPickerId,GBFP.tmp.currentDir);
			for(var i in GBFP.inputs)
				GBFP.reloadDropdown(GBFP.inputs[i].browseUrl, i);
			GBFP.tmp.currentUrl = _url;
		}
		return false;
	},
	ieVersion: function() {
		var version = 999;
		if (navigator.appVersion.indexOf("MSIE") != -1) {
			version = parseFloat(navigator.appVersion.split("MSIE")[1]);
		}
		return version;
	}
};
gbfp_onload.push(function(){
	jsLoader.load(
		{
			url: GBFP.options.rootUrl + '/modules/GBFilePicker/js/jq.min.js',
			loadType: 'defer',
			ready:function() {
				return (typeof jQuery == 'function');
			},
			callBack: function(ready) {
				if(ready) {
					jQuery(document).ready(function() {
						jQuery('.GBFP_input').attr('disabled','disabled').addClass('GBFP_disabled').click(function() {return false;});
						jQuery('.GBFP_link').click(function() {return false;}).addClass('GBFP_disabled');
					});
					jsLoader.load([{
						url: GBFP.options.rootUrl + '/modules/GBFilePicker/js/jq.ui.core.min.js',
						loadType: 'defer',
						ready: function() {
							return (typeof jQuery == 'function' && typeof jQuery.ui != 'undefined')
						},
						callBack: function (ready) {
							if(ready) {
								jsLoader.load(
									{
										url: GBFP.options.rootUrl + '/modules/GBFilePicker/js/jq.ui.widget.min.js',
										loadType: 'defer',
										ready: function() {
											return (typeof jQuery == 'function' && typeof jQuery.ui != 'undefined' && typeof jQuery.widget != 'undefined')
										},
										callBack: function(ready) {
											if(ready) {
												jsLoader.load(
													{
														url: GBFP.options.rootUrl + '/modules/GBFilePicker/js/jq.ui.mouse.min.js',
														loadType: 'defer',
														ready: function() {
															return (typeof jQuery != 'undefined' && typeof jQuery.ui != 'undefined' && typeof jQuery.ui.mouse != 'undefined' && typeof jQuery.widget != 'undefined')
														}
													},
													function (ready) {
														jsLoader.load([
															{
																url: GBFP.options.rootUrl + '/modules/GBFilePicker/js/jq.ui.draggable.min.js',
																loadType: 'defer',
																ready: function() {
																	return (typeof jQuery != 'undefined' && typeof jQuery.ui != 'undefined' && typeof jQuery().draggable != 'undefined')
																}
															},
															{
																url: GBFP.options.rootUrl + '/modules/GBFilePicker/js/jq.ui.resizable.min.js',
																loadType: 'defer',
																ready: function() {
																	return (typeof jQuery != 'undefined' && typeof jQuery.ui != 'undefined' && typeof jQuery().resizable != 'undefined' && typeof jQuery.widget != 'undefined')
																}
															}
														]);
													}
												);
											}
										}
									}
								);
							}
						}
					},
					{
						url: GBFP.options.rootUrl + '/modules/GBFilePicker/js/jq.onImgLoad.min.js',
						loadType: 'defer',
						ready: function() {
							return (typeof jQuery != 'undefined' && typeof jQuery().onImagesLoad != 'undefined')
						},
						callBack: function(ready){
							if(ready) {
								$.fn.onImagesLoad.defaults.onError = function(obj) {
									jQuery(obj).attr('src', GBFP.options.rootUrl + '/modules/GBFilePicker/images/imagecorrupt.gif');
								}
							}
						}
					},
					{
						url: GBFP.options.rootUrl + '/modules/GBFilePicker/js/jq.form.min.js',
						loadType: 'defer',
						ready: function() {
							return (typeof jQuery != 'undefined' && typeof jQuery().ajaxSubmit != 'undefined')
						}
					}
					]);
				}
			}
		},
		function (ready) {
			if(ready) {
				jQuery(document).ready(function(){
					jQuery('.gbfp_contract, .gbfp_expand').live('click', function() {
						GBFP.tmp.template['#GBFP'].css('height','auto');
						if(this.className == 'gbfp_expand')
							jQuery('#GBFP_fileoperations_wrapper').removeClass('gbfp_no-border');
						GBFP.tmp.template['#GBFP_fileoperations']
							.slideToggle(function(){
								GBFP.resize();
								if(GBFP.tmp.template['#GBFP_fileoperations'].css('display') == 'none')
									jQuery('#GBFP_fileoperations_wrapper').addClass('gbfp_no-border');
							})
						;
						
						this.className = (this.className == 'gbfp_contract' ? 'gbfp_expand' : 'gbfp_contract');
						jQuery.get(this.href + GBFP.options.moduleId + 'display=' + (this.className == 'gbfp_contract' ? 1 : 0) + '&' + GBFP.options.moduleId + 'disable_theme=1&' + GBFP.options.moduleId + 'showtemplate=false&' + GBFP.options.moduleId + 'ajax=1');
						return false;
					});
					
					jQuery('.GBFP_loading_img').css('display','none');
					jQuery('.GBFP_input').removeAttr('disabled').removeClass('GBFP_disabled').unbind('click');
					jQuery('.GBFP_link').removeClass('GBFP_disabled').unbind('click');
					jQuery('.GBFP_browse').live('click', function() {
						var pickerId = this.id.substr(0,this.id.lastIndexOf('_GBFP_browse'));
						if(GBFP.inputs[pickerId].browseUrl != '')
							GBFP.loadDir(GBFP.inputs[pickerId].browseUrl, pickerId);
						return false;
					});
					jQuery('.GBFP_upload').live('click', function() {
						var pickerId = this.id.substr(0,this.id.lastIndexOf('_GBFP_upload'));
						if(GBFP.inputs[pickerId].uploadUrl != '')
							GBFP.loadDir(GBFP.inputs[pickerId].uploadUrl, pickerId);
						return false;
					});
					jQuery('.GBFP_reload_dropdown').live('click', function(){
						var pickerId = this.id.substr(0,this.id.lastIndexOf('_GBFP_reload_dropdown'));
						if(GBFP.inputs[pickerId].browseUrl != '')
							GBFP.reloadDropdown(GBFP.inputs[pickerId].browseUrl, pickerId);
						return false;
					});
					jQuery().ajaxError(function(event, request, settings){
						alert('Error: requesting page ' + settings.url);
						return false;
					});
					jQuery('.GBFP_clear').live('click', function(){
						var id = this.id.substr(0,this.id.lastIndexOf('_GBFP_clear'));
						jQuery('#'+id).val('');
						GBFP.toggleThumbnail(id,'');
						return false;
					});
					jQuery('select.GBFP_dropdown.GBFP_image').unbind('change').live('change', function(){
						GBFP.toggleThumbnail(this.id, jQuery('#'+this.id+' option:selected:first').attr('thumbnail'),this.value,this.value);
					});
				});
			}
		},
		'','','',GBFP.options.debug
	);
});
if (document.readyState == "complete") {
	for(var i = 0; i<gbfp_onload.length; i++) {
		gbfp_onload[i]();
		gbfp_onload[i] = null;
		delete gbfp_onload[i];
	}
	gbfp_onload = null;
	delete window['gbfp_onload'];
} else {
	if (attachEvent) {
		attachEvent('onload', function(e){
			for(var i = 0; i<gbfp_onload.length; i++) {
				gbfp_onload[i]();
				gbfp_onload[i] = null;
				delete gbfp_onload[i];
			}
			gbfp_onload = null;
			delete window['gbfp_onload'];
		});
	} else if (addEventListener) {
		addEventListener('load', function(e){
			for(var i = 0; i<gbfp_onload.length; i++) {
				gbfp_onload[i]();
				gbfp_onload[i] = null;
				delete gbfp_onload[i];
			}
			gbfp_onload = null;
			delete window['gbfp_onload'];
		}, false);
	}
}