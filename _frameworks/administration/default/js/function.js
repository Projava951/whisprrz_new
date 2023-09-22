var gFn = function() {
	return {
		showFade: function(isShow) {
			var backdrop = $('.backdrop');
			if(!isShow) {
				if(!backdrop.hasClass('hidden')) backdrop.addClass('hidden');
			} else {
				backdrop.removeClass('hidden');
			}
			
		},
		//alert
		showAlert : function(mode, msg, fn) {
			var modal = $('#mdlInfo');
			if(mode=='warning') modal = $('#mdlWarning');
			modal.find('.modal-body').find('p').html(msg);
			modal.modal('show');
			if(fn !== undefined) { 
				modal.on('hidden.bs.modal', function() {
					if(fn !== undefined)fn();
					fn = undefined;
				});
			}
		},
		
		//confirm
		showConfirm: function(msg, fnYes, fnNo) {
			var modal = $('#mdlConfirm');
			modal.find('.modal-body').find('p').html(msg);
			modal.modal('show');
			modal.find('.btn-yes').click(function() {
				var fn = fnYes;
				modal.modal('hide');
				if(fn !== undefined) fnYes();	
				fnYes = undefined;
				fn = undefined;
			});
			modal.find('.btn-no').click(function() {
				var fn = fnNo;				
				if(fn !== undefined) fnNo();	
				fnNo = undefined;
				fn = undefined;
				modal.modal('hide');
			});
			modal.on('hidden.bs.modal', function() {
				fnYes = undefined;
				fnNo = undefined;
			});
		},		
		
		showRequireSpan: function(span, text, isShow) {
			span.html(text);
			if(isShow) {
				span.removeClass('hidden');
			} else {
				if(!span.hasClass('hidden'))span.addClass('hidden');
			}
		},
		
		initEditor: function(id, height) {
			if(height == undefined) height = 400;
            $('#' + id).summernote({height: height});            
            //API:
            //var sHTML = $('#summernote_1').code(); // get code
            //$('#summernote_1').destroy(); // destroy
        },		
		
		
		isMedia : function(filename) {
			var result = false,
				media_types = ["wav", "mp3", "mp4", "avi", "swf"],
				marks = filename.lastIndexOf("."),
				extension = filename.substr(marks + 1);
			for(var i=0; i<media_types.length; i++) {
				if(extension == media_types[i]) {
					result = true;
					break;
				}
			}
			return result;
		},
		
		//get attached html file
		getAttachFilesHtml : function(attach_files) {
			var html = ""; var blog_mode = ['news', 'committee', 'organ', 'mail', 'program', 'data', 'bbs', 'mail_content', 'bbs_content'];
			for(var i=0;i<attach_files.length;i++) {
				var attach = attach_files[i];
				if(html != '') html += ' | ';
				if(attach.mode == 5) {
					var blogMode = blog_mode[attach.mode];
					if(gFn.isMedia(attach.filename)) {
						blogMode = media_folder;
						html += "<a href='" + "download/show_media/?filename=" + attach.filename + "' target='_blank'>" 
							+ attach.origin_filename + "(" + attach.filesize + ")" + "</a>";
					} else {
						html += "<a href='" + "assets/" + blogMode + "/" + attach.filename + "' target='_blank'>" 
							+ attach.origin_filename + "(" + attach.filesize + ")" + "</a>";
					}					
				} else {
					html += "<a href='" + "download/" + blog_mode[attach.mode] + "?filename=" + attach.filename + "'>" 
						+ attach.origin_filename + "(" + attach.filesize + ")" + "</a>";
				}
			}	
			return html;
		},		
		
		trim : function(str) {
			var re = new RegExp(' ', "g");
			str = str.replace(re, '');
			return str; 
		},
		
		getBreadCrumbHTML : function(subjectClasses) {
			var div = $('<div></div>').addClass('article-class');
			var i = $('<i></i>').addClass('fa fa-bookmark');
			div.append(i);
			var ul = $('<ul></ul>').addClass('breadcrumb'); 
			for(var i=subjectClasses.length-1;i>=0; i--) {
				var li = $('<li></li>');
				if(i==0) li.addClass('active');
				li.html(subjectClasses[i].name);
				ul.append(li);
			}
			div.append(ul);
			return div;
		},		
	    
	    removeScript: function(str) {
	    	if(str != '') {
	    		var div = $('<div></div>');
	    		div.html(str);
	    		var js = div.find('script');
	    		js.each(function() {$(this).remove();});
	    		var str = div.html();
	    		var re = new RegExp('<script>', "g");
				str = str.replace(re, '');
				re = new RegExp('<SCRIPT>', "g");
				str = str.replace(re, '');
				re = new RegExp('</script>', "g");
				str = str.replace(re, '');
				re = new RegExp('</SCRIPT>', "g");
				str = str.replace(re, '');
	    		div.remove();
	    	}
    		return str;
	    }
	};
}();

$(document).ready(function() {
	$('.pre-attach-files input[name="del_attach"]').click(function() {
		var file_input = $(this).parents('.pre-attach-files').siblings('.file-input');
		if($(this).is(':checked')){
			file_input.show();
		} else {
			file_input.hide();
		}
	});
});