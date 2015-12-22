(function( $ ) {

    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
    	$('.color-bar').wpColorPicker({
    		palettes: ['#125', '#555', '#5e9b95', '#ab0', '#580066', '#f0f'],
    		change: function(event, ui) {
	       		 $("#sample").css( 'background-color', ui.color.toString());
	   	 	}	
		});
		$('.color-button').wpColorPicker({
    		palettes: ['#0cd66e', '#459', '#e04c0d', '#31bc4a', '#38c0d8', '#cc2c84'],
    		change: function(event, ui) {
	       		 $("#sample span").css( 'background-color', ui.color.toString());
	   	 	}	
		});;
    });

})( jQuery );