if(typeof GBFP_fileTreeBrowser_onload == 'undefined')
	GBFP_fileTreeBrowser_onload = [];

GBFP_fileTreeBrowser_onload.push(function(){
	// check for jq ui css
	var css = {
		'.ui-helper-hidden': GBFP_rootUrl + '/css/jquery-ui/base/jquery.ui.core.css',
		'.ui-resizable': GBFP_rootUrl + '/css/jquery-ui/base/jquery.ui.resizable.css',
		'.ui-dialog': GBFP_rootUrl + '/css/jquery-ui/base/jquery.ui.dialog.css',
		'.ui-button': GBFP_rootUrl + '/css/jquery-ui/base/jquery.ui.button.css',
		'.ui-selectable-helper': GBFP_rootUrl + '/css/jquery-ui/base/jquery.ui.selectable.css',
		'.ui-widget': GBFP_rootUrl + '/css/jquery-ui/base/jquery.ui.theme.css'
	};
	for(var i in document.styleSheets) {
		try {
			if(!document.styleSheets[i].href)
				continue;
			for(var j in document.styleSheets[i].cssRules) {
				if(typeof css[document.styleSheets[i].cssRules[j].selectorText] != "undefined") {
					css[document.styleSheets[i].cssRules[j].selectorText] = null;
					delete css[document.styleSheets[i].cssRules[j].selectorText];
				}
			}
		} catch(e) {/* silently fail */}
	}
	for(var i in css) {
		var headNode = document.getElementsByTagName("head")[0],
			cssNode  = document.createElement('link');
		cssNode.type  = 'text/css';
		cssNode.rel   = 'stylesheet';
		cssNode.href  = css[i];
		cssNode.media = 'screen';
		headNode.appendChild(cssNode);
	}
});

function versionCompare(a, b) {
	var v1 = a.split('.');
	var v2 = b.split('.');
	for(var i = 0; i < Math.min(v1.length, v2.length); i++) {
		var res = eval(v1[i] - v2[i]);
		if (res != 0)
		return res;
	}
	return 0;
}

jsLoader.load({
	url: GBFP_rootUrl + '/js/jq.min.js',
	loadType: 'async',
	ready:function() {
		return (typeof jQuery == 'function' && versionCompare($.fn.jquery, '1.6.2') >= 0);
	},
	callBack: function(ready) {
		if(!ready) return;
		jsLoader.load([{
			url: GBFP_rootUrl + '/templates/themes/FileTreeBrowser/js/jq.layout.min.js',
			loadType: 'async',
			ready: function() {
				return (typeof jQuery().layout != 'undefined');
			}
		},{
			url: GBFP_rootUrl + '/js/jq.ui.core.min.js',
			loadType: 'async',
			ready: function() {
				return (typeof jQuery.ui != 'undefined' && versionCompare(jQuery.ui.version, '1.8.14') >= 0)
			},
			callBack: function (ready) {
				if(!ready) return;
				jsLoader.load(
					[
						{
							url: GBFP_rootUrl + '/js/jq.ui.position.min.js',
							loadType: 'async',
							ready: function() {
								return (typeof jQuery.ui != 'undefined' && typeof jQuery.ui.position != 'undefined')
							}
						},
						{
							url: GBFP_rootUrl + '/js/jq.ui.widget.min.js',
							loadType: 'async',
							ready: function() {
								return (typeof jQuery.ui != 'undefined' && typeof jQuery.widget != 'undefined')
							},
							callBack: function(ready) {
								if(!ready) return;
								jsLoader.load([
									{
										url: GBFP_rootUrl + '/js/jq.ui.button.min.js',
										loadType: 'async',
										ready: function() {
											return (typeof jQuery().button != 'undefined')
										}
									},
									{
										url: GBFP_rootUrl + '/js/jq.ui.mouse.min.js',
										loadType: 'async',
										ready: function() {
											return (typeof jQuery.ui.mouse != 'undefined')
										},
										callBack: function (ready) {
											if(!ready) return;
											jsLoader.load([
												{
													url: GBFP_rootUrl + '/js/jq.ui.draggable.min.js',
													loadType: 'async',
													ready: function() {
														return (typeof jQuery().draggable != 'undefined')
													}
												},
												{
													url: GBFP_rootUrl + '/js/jq.ui.resizable.min.js',
													loadType: 'async',
													ready: function() {
														return (typeof jQuery().resizable != 'undefined')
													}
												},
												{
													url: GBFP_rootUrl + '/js/jq.ui.selectable.min.js',
													loadType: 'async',
													ready: function() {
														return (typeof jQuery().selectable != 'undefined')
													}
												}
											]);
										}
									}
								]);
							}
						}
					], 
					function(ready){
						if(!ready) return;
						jsLoader.load({
							url: GBFP_rootUrl + '/js/jq.ui.dialog.min.js',
							loadType: 'async',
							ready: function() {
								return (typeof jQuery().dialog != 'undefined')
							},
							callBack: function (ready) {
								if(!ready) return;





								(function($){
									
									function buildTree(json) {
										
									}
									
									var filePickers = {
											length: function() {
												var i = 0;
												for(j in this)
													i++;
												return i;
											}
										},
										templates = {};
									
									$.fn.GBFP = function(a) {
										var cfg = $.extend(
											{
												title:'File browser',
												browseText:'Browse...',
												debug:false,
												scriptUrl:false,
												urlParam:'dir',
												requestMethod: 'GET',
												dataType:'html',
												template:'tpl/browser.html',
												loadMessage: 'Loading...',
												callBack: function(file){return file;},
												rootDir:'',
												forceReload:false
											},
											a ? a : {}
										);
										
										return this.each(function() {
											
											var id = !this.id ? 'gbfp_' + filePickers.length() : this.id;
											
											if(typeof filePickers[id] == 'function')
												return;
											
											this.id         = id;
											var $this       = $(this);
											$this.dialogBox = null;
											$this.cfg       = cfg;
											$this.history   = [];
											
											$this.browse = function() {
												
												var p = {},
													t = $this.dialogBox.fileList,
													c = $this.showTree,
													d = $this.cfg.rootDir;
													
												for(var i=0; i<arguments.length; i++) {
													switch(typeof arguments[i]) {
														case 'function':
															c = arguments[i];
															break;
														case 'object':
															t = arguments[i];
															break;
														case 'string':
															d = arguments[i];
															break;
													}
												}
												
												p[$this.cfg.urlParam] = d ? d : $this.cfg.rootDir;
												
												$.ajax({
													url:  $this.cfg.scriptUrl,
													type: $this.cfg.requestMethod,
													data: p,
													success: function(d) {
														c(t, d);
													},
													dataType: $this.cfg.dataType
												});
											};
											
											$this.openDialog = function() {
												if(!$this.dialogBox)
													$this.getTemplate(function() {
														$this.createDialog();
														$this.browse($this.cfg.rootDir, function(t,d) {
															$this.dialogBox.content.dialog('open');
															t.html('');
															$this.showTree(t,d,function(t){
																//var tmp = $this.dialogBox.wrapper.children();
																//$this.dialogBox.wrapperAddHeight = eval(
																//	  $this.dialogBox.wrapper.outerHeight(true)
																//	- $this.dialogBox.wrapper.height()
																//);
																//$this.dialogBox.addHeight = eval(
																//	  $this.dialogBox.content.outerHeight(true)
																//	- $this.dialogBox.content.height()
																//	+ $(tmp[2]).outerHeight(true)
																//	+ $(tmp[4]).outerHeight(true)
																//	+ $(tmp[0]).outerHeight(true)
																//	+ $(tmp[10]).outerHeight(true)
																//);
																//var h = t.children('ul').eq(0).outerHeight(true);
																//$this.dialogBox.content.dialog("option" , "minHeight", eval(h + $this.dialogBox.addHeight));
																//$this.setHeight();
																//$this.dialogBox.layout.resizeAll();
																for(var i in $this.dialogBox.uiLayout) {
																	$this.dialogBox.uiLayout[i][1].resizeAll();
																}
															});
														});
													});
												else
													$this.dialogBox.content.dialog('open');
												return $this;
											};
											
											$this.getTemplate = function(callBack) {
												if(!templates[$this.cfg.template])
													$.get($this.cfg.template, function(tpl) {
														templates[$this.cfg.template] = tpl;
														callBack();
													});
												else
													callBack();
											};
											
											$this.createDialog = function() {
												$this.dialogBox = {
													content: $(document.createElement('div'))
														.addClass('gbfp_dialog_content')
														.html(
															templates[$this.cfg.template]
																.replace(/{id}/g, $this.attr('id'))
																.replace(/{loadMessage}/g, $this.cfg.loadMessage)
														)
												};
												
												$this.dialogBox.uiLayout = {};
												
												$this.dialogBox.content
													.find('.ui-layout-container')
													.each(function(i,e){
														var s = $(this);
														$this.dialogBox.uiLayout[!this.id ? 'gbfp_' + i : this.id] = [
															s, s.layout({
																zIndex: 0,
																resizeWithWindow: false
															})
														];
													})
												;
												
												$this.dialogBox.fileList = $this.dialogBox.content
													.find('#gbfp_file_list_' + $this.attr('id'))
													.selectable({filter: "a"});
												;
												
												$this.dialogBox.fileInfo = $this.dialogBox.content
													.find('#gbfp_file_info_' + $this.attr('id'))
												;
												
												$this.dialogBox.content.dialog({
													title: $this.cfg.title,
													modal: true,
													width: 500,
													minWidth:300,
													autoOpen: false,
													position: ['center','top'],
													resize: function(){ 
														for(var i in $this.dialogBox.uiLayout) {
															$this.dialogBox.uiLayout[i][1].resizeAll();
														}
													},
													open: function() {
														$this.setHeight();
														for(var i in $this.dialogBox.uiLayout) {
															$this.dialogBox.uiLayout[i][1].resizeAll();
														}
														$(window).resize(function(){
															$this.setHeight();
															for(var i in $this.dialogBox.uiLayout) {
																$this.dialogBox.uiLayout[i][1].resizeAll();
															}
														});
														$this.button.removeClass('wait');
													},
													close: function() {
														$(window).unbind('resize');
														$this.button
															.removeAttr('disabled')
															.button("option", "disabled", false)
															.click(function(){
																this.disabled = true;
																$(this).unbind('click')
																	.removeClass('ui-state-hover')
																	.addClass('wait')
																	.button("option", "disabled", true);
																filePickers[id].openDialog();
																return false;
															})
														;
													}
												});
												$this.dialogBox.wrapper = $this.dialogBox.content.parent();
											};
											
											$this.closeDialog = function() {
												console.log($this.dialogBox.uiLayout);
												$this.dialogBox.content.dialog('close');
												return $this;
											};
											
											$this.setHeight = function() {
												$this.dialogBox.wrapperMaxHeight = eval(
													  $(window).height()
													- $this.dialogBox.wrapperAddHeight
												);
												//$this.dialogBox.contentMaxHeight = eval(
												//	  $this.dialogBox.wrapperMaxHeight
												//	- $this.dialogBox.addHeight
												//);
												//$this.dialogBox.content
												//	.css('max-height', $this.dialogBox.contentMaxHeight + 'px');
												$this.dialogBox.wrapper.dialog("option", "maxHeight", $this.dialogBox.wrapperMaxHeight);
												return $this;
											};
											
											$this.buildTree = function() {
												
											};
											
											/* functions showTree(), bindTree() 
											 * and stylesheets forked from 
											 * jQuery File Tree Plugin version 1.01
											 *
											 * Cory S.N. LaViska
											 * A Beautiful Site (http://abeautifulsite.net/)
											 * 24 March 2008
											 *
											 * Visit http://www.abeautifulsite.net/blog/2008/03/jquery-file-tree/ for more information
											 *
											 * (modified by NaN to fit into the GBFP plugin)
											 */
											$this.showTree = function() {
												var t = $this.dialogBox.fileList,
													d = null,
													c = function(){};
												
												for(var i=0; i<arguments.length; i++) {
													switch(typeof arguments[i]) {
														case 'function':
															c = arguments[i];
															break;
														case 'object':
															t = arguments[i];
															break;
														case 'string':
															d = arguments[i];
															break;
													}
												}
												t.removeClass('wait').addClass('expanded');
												if(d)
													t.append(d);
												var tc = t.children('UL');
												if(tc.length > 0)
													t.children('UL')
														.slideDown(150, function() {
															c(t);
														})
													;
												else
													c(t);
												
												$this.bindTree(t);
											};
											
											$this.bindTree = function (t) {
												t.find('LI A').unbind().bind('dblclick', function() {
													var self   = $(this),
														parent = self.parent();
													if( parent.hasClass('directory') ) {
														if( !parent.hasClass('expanded') ) {
															// expand
															var ul = false;
															if($this.cfg.forceReload)
																parent.find('UL').remove();
															else
																ul = parent.children('ul').eq(0);
															if(!ul.length) {
																// reload
																parent.addClass('wait');
																$this.browse(self.attr('rel'), parent);
															} else {
																$this.showTree(parent);
															}
														} else {
															// Collapse
															parent.children('UL').slideUp(
																150, 
																function() {
																	if($this.cfg.forceReload)
																		$(this).remove();
																}
															);
															parent.removeClass('expanded');
														}
													} else {
														alert(self.attr('rel'));
														//cfg.callBack(self.attr('rel'));
													}
													return false;
												});
												// todo: display file info
												t.find('LI A').bind('click', function() {
													return false; 
												});
											};
											/* end jQuery File Tree */
											
											if($this.cfg.scriptUrl && $this.cfg.browseText)
												$this.button = $(document.createElement('button'))
													.button({
														text: $this.cfg.browseText,
														label: $this.cfg.browseText,
														id: $this.attr('id') + '_button'
													})
													.click(function(){
														this.disabled = true;
														$(this).unbind('click')
															.removeClass('ui-state-hover')
															.addClass('wait')
															.button("option", "disabled", true);
														filePickers[id].openDialog();
														return false;
													})
													.insertAfter($this)
												;
											filePickers[id] = $this;
										});
									};
								})(jQuery);






								if (document.readyState == "complete") {
									for(var i = 0; i<GBFP_fileTreeBrowser_onload.length; i++) {
										GBFP_fileTreeBrowser_onload[i]();
										GBFP_fileTreeBrowser_onload[i] = null;
										delete GBFP_fileTreeBrowser_onload[i];
									}
									GBFP_fileTreeBrowser_onload = null;
									delete window['GBFP_fileTreeBrowser_onload'];
								} else {
									if (attachEvent) {
										attachEvent('onload', function(e){
											for(var i = 0; i<GBFP_fileTreeBrowser_onload.length; i++) {
												GBFP_fileTreeBrowser_onload[i]();
												GBFP_fileTreeBrowser_onload[i] = null;
												delete GBFP_fileTreeBrowser_onload[i];
											}
											GBFP_fileTreeBrowser_onload = null;
											delete window['GBFP_fileTreeBrowser_onload'];
										});
									} else if (addEventListener) {
										addEventListener('load', function(e){
											for(var i = 0; i<GBFP_fileTreeBrowser_onload.length; i++) {
												GBFP_fileTreeBrowser_onload[i]();
												GBFP_fileTreeBrowser_onload[i] = null;
												delete GBFP_fileTreeBrowser_onload[i];
											}
											GBFP_fileTreeBrowser_onload = null;
											delete window['GBFP_fileTreeBrowser_onload'];
										}, false);
									}
								}
							}
						});
					}
				);
			}
		}]);
	}
});
