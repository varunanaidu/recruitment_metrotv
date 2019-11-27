if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

(function ( $ ) {
    $.fn.Recruitment = function( options ) {
		var defaults = {
			url			: null,
			bootstrap	: false,
		};
        var settings = $.extend({}, defaults, options );
		return this.each(function(){
			if ( settings.url ){
				var me = $(this);
				$.ajax({
					url : settings.url,
					dataType : "json",
					success : function(data){
						if ( data.type === 'done' ){
							var html = "";
							if ( settings.bootstrap )
								html = "<div class=\"row\">";
							else
								html = "<div>";
							for(var i = 0; i < data.msg.length; i++){
								if ( settings.bootstrap )
									html += "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\"><label>" + data.msg[i].B + "</label></div>";
								else
									html += "<div style=\"background-color:#3F51B5 !important;line-height:30px;color:white !important;\"><span style=\"margin-left:10px;\">" + data.msg[i].B + "</span></div>";
								if ( settings.bootstrap )
									html += "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">" + data.msg[i].D + "</div>";
								else
									html += "<div>" + data.msg[i].D + "</div>";
								if ( settings.bootstrap )
									html += "<div><a href=\"http://career.metrotvnews.com/vacancy/apply/" + data.msg[i].A + "\" class=\"btn btn-primary pull-right\">APPLY</button></div>";
								else
									html += "<div style=\"text-align:right;\"><a href=\"http://career.metrotvnews.com/vacancy/apply/" + data.msg[i].A + "\" style=\"padding:5px;text-decoration:none;background-color:#3F51B5 !important;line-height:30px;color:white !important;\">APPLY</a></div>";
							}
							html += "</div>";
							me.html ( html );
						}
						else{
							throw new Error(data.msg);
						}
					}
				});
			}
			else{
				throw new Error( "You haven't describe your link" );
			}
		});
    };
 
}( jQuery ));