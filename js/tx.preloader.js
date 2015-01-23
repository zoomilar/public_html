/*
	Author Texus, UAB "Sales Partners".  www.texus.lt
	Platinti draudziama.
	
*/


(function(jQuery) {
    var methods = {
        show: function(params) { 						
			showPreloader();							
        },
		hide: function(params){
			hidePreloader();
		}		
    }

    jQuery.preloader = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        }else{
		
        }
    };
	
	var showPreloader = function(){
	
		jQuery('<div id="pre_inn"></div>').prependTo('body');
		jQuery('<div id="pre_out"></div>').prependTo("body");
		jQuery('#pre_inn').css({height: '100%', width: '100%', background: 'url(../img/ax.gif) no-repeat center center', position: 'fixed', zIndex: '9999'});
		jQuery('#pre_out').css({height: '100%', width: '100%', backgroundColor: '#fff', opacity: '0.6', filter: 'alpha(opacity=60)', position: 'fixed', zIndex: '9998'});
		
	}
	var hidePreloader = function(){
		jQuery('#pre_inn, #pre_out').remove();
	}
	


})(jQuery);