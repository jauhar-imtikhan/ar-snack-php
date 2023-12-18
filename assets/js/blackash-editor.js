/**
 * BLACK-ASH - Javascript Frontend Html Editor
 * @author  Jaber Molla
 * @version 1.0
 * Last Edited 14 August, 2017
 */
//
(function() {
	"use strict";
	var editingelemorginaltext = "";
	var shwoinganyeditor = false;
	var editingImageClass = "";
	var editingColor = '';
	var editinfontsizeprevious = '';
	var edtinglinkurl = '';
	var ediboxtopset = 0;
	var iffontfamily = "";
	var editinfontsize  = "";
	var colorCode ="";
    // Load the jquery
    var script = document.createElement("SCRIPT");
    script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js';
    script.type = 'text/javascript';
    script.onload = function() {
		//jquery start
    var $ = window.jQuery;
        $( document ).ready(function() {
			//load color script
			var chkscriptpresent = $( "script[src='getcolor.js']" );
					if(chkscriptpresent.length == 0){
						var colorscript = document.createElement("SCRIPT");
						colorscript.src = 'getcolor.js';
						colorscript.type='text/javascript';
						colorscript.onload = function(){
						}
						document.getElementsByTagName("head")[0].appendChild(colorscript);
					}
			//loading the css file
			var cssId = 'myCssblackashedit';  // you could encode the css path itself to generate id..
			if (!document.getElementById(cssId))
			{
				var head  = document.getElementsByTagName('head')[0];
				var link  = document.createElement('link');
				link.id   = cssId;
				link.rel  = 'stylesheet';
				link.type = 'text/css';
				link.href = 'blackash.css';
				link.media = 'all';
				head.appendChild(link);
			}
			//appending setting nav bar
			var thesettingbox = "<div class='settngholder nav'><div style='' class='moveeditorupnavbox'><strong class='navtext'>&#8593;</strong></div><h4 class='navtext textheading'>BLACK-ASH HTML EDITOR</h4><div class='settingbox'><ul style=''><li class='open_setting'>SETTINGS</li><li class='exporthtmlnow'>Export</li></ul></div></div><div class='moveeditordownnavbox'><strong class='navtext'>&#8595;</strong></div>";
			var chkifalreadyprinted = $(".settingbox").length;
			if(chkifalreadyprinted == 0){
				$('body').prepend(thesettingbox);
			}
			//appending color picker html
			var colorpickerhtml = "<input style=' top: 340px;opacity: 0;border: 5px solid white;box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px inset, rgba(0, 0, 0, 0.1) 0px 0px 16px;padding: 15px;background: none rgb(133, 133, 255);margin: 0px 0px 10px;position: fixed;left: 20px;color: rgb(0, 0, 0);height: 40px;' class='jscolor colorpcikewebjs' value='null'>"
			var chkcolorpicker = $(".colorpcikewebjs").length;
			if(chkcolorpicker == 0){
				$('html').append(colorpickerhtml);
			}
			//get all text elements as a variable
			var jQueryheadingText = $("h1,h2,h3,h4,h5,h6,h7,p,strong,small,pre,b,span,button");
			//get li elements as a variable
			var jQuerylielement = $('li');
			//get image tag
			var jQueryImageTag = $("img");
			//get all links in a variable
			var jQuerylinktexttah = $("a");
			// li element click event function
			jQuerylielement.on( "click", function(){
				if($(this).hasClass("open_setting") || $(this).hasClass("exporthtmlnow") || $(this).hasClass("editing") || $('.editiboxtext').length > 0 ){
					
				}
				else{
					console.log(editingelemorginaltext);
					$(this).editeditor() ;
				}
			});
			// Heading text elements click event function
			jQueryheadingText.on( "click", function(){
				if($(this).hasClass("editing") || $(this).hasClass("navtext") || $('.editiboxtext').length > 0 ){
				}
				else{
				$(this).editeditor() ;
				}
			})
			// a tag element click event function
			jQuerylinktexttah.on( "click", function(){
				event.preventDefault();
				if($(this).hasClass("editing") || $('.editiboxtext').length > 0){
				}
				else{
					$(this).openlinkeditorwebjs();
				}
			});
			// a tag element hover funciton
			jQuerylinktexttah.on("mouseenter",function(){
				if($(this).hasClass("editing") || $('.editiboxtext').length > 0 ){
				}
				else{
				$(this).css("border", "3px").css("borderStyle", "solid").css("cursor","pointer");
				}
			});
			// a tag element hover out function
			jQuerylinktexttah.on("mouseleave",function() {
				if($(this).hasClass("editing") || $('.editiboxtext').length > 0 ){
				}
				else{
				$(this).css("border", "").css("borderStyle", "").css("cursor","");
				}
			});
			//image hover function
			jQueryImageTag.on("mouseenter",function(){
				if($(this).hasClass("editingthisimagenow")){
				}
				else{
				$(this).css("border", "3px").css("borderStyle", "solid").css("cursor","pointer");
				}
			}); 
			//image hover out function
			jQueryImageTag.on("mouseleave",function() {
				if($(this).hasClass("editingthisimagenow")){
				}
				else{
				$(this).css("border", "").css("borderStyle", "").css("cursor","");
				}
			});
			//image click function
			jQueryImageTag.on( "click", function(){
				//alert("clicked");
				if(shwoinganyeditor == false){
					if($(this).hasClass("editingthisimagenow")){
					}
					else{
						$(this).showeditmenuHforImage();
					}
				}
				else{
					alert("One More Editor is Already Executed. Try to edit one by one.");
				}
			});
			//text and heading text hover function
			jQueryheadingText.on("mouseenter",function(){
				if($(this).hasClass("editing") || $(this).hasClass("navtext") || $('.editiboxtext').length > 0){
				}
				else{
				$(this).css("border", "3px").css("borderStyle", "solid");
				}
			}); 
			//text and heading text hover out function
			jQueryheadingText.on("mouseleave",function() {
				if($(this).hasClass("editing") || $(this).hasClass("navtext") || $('.editiboxtext').length > 0){
				}
				else{
				$(this).css("border", "").css("borderStyle", "");
				}
			});
			//li element hover function
			jQuerylielement.on("mouseenter",function(){
				if($(this).hasClass("open_setting") || $(this).hasClass("exporthtmlnow") || $(this).hasClass("editing") || $('.editiboxtext').length > 0){
					
				}
				else{
					$(this).css("border", "3px").css("borderStyle", "solid");
				}
			});
			//li element hover out function
			jQuerylielement.on("mouseleave",function(){
				if($(this).hasClass("open_setting") || $(this).hasClass("exporthtmlnow") || $(this).hasClass("editing") || $('.editiboxtext').length > 0){
					
				}
				else{
				$(this).css("border", "").css("borderStyle", "");
				}
			});
			//editor save button click function
			$( document ).on( "click", ".savebtn", function() {
					$(this).editeditorsavenow() ;
			});
			//export html function
			$( document ).on( "click", ".exporthtmlnow", function() {
					$(this).exporthtmlnow() ;
			});
			//editor cancel button function
			$( document ).on( "click", ".cancelbtn", function() {
					$(this).cancellbtnellemnt() ;
			});
			//editor remove function
			$( document ).on( "click", ".removeelbtn", function() {
					$(this).removeelbtnsaver() ;
			});
			//open setting function
			$( document ).on( "click", ".open_setting", function() {
				if(shwoinganyeditor == false){
					$(this).opensetting_box() ;
				}
				else{
					alert("One More Editor is Already Executed. Try to edit one by one.");
				}
			});
			//setting save function
			$( document ).on( "click", ".settingssavebtn", function() {
					$(this).settingsavebtnmetatittle() ;
			});
			//setting cancel function
			$( document ).on( "click", ".settingscancelbtn", function() {
					$(this).settingcancellbtnaction() ;
			});
			//image editor save function
			$( document ).on( "click", ".imagesettingssavebtn", function() {
					$(this).saveimeinfothisextav() ;
			});
			//image editor cancel function
			$( document ).on( "click", ".imagesettingscancelbtn", function() {
					$(this).imagesettingcancelll() ;
			});
			//image editor remove function
			$( document ).on( "click", ".removeelbtnforimage", function() {
					$(this).removetheimageelement() ;
			});
			//editor font family on change function
			$( document ).on( "change", "#fonr_family_text", function() {
					$(this).previewfonttyextx() ;
			});
			//triggge of color picker
			$( document ).on( "click", ".colorpickerwebjstrigger", function() {
				$('.editing').css("backgroundColor","");
				$(".colorpcikewebjs").animate({
					opacity: 1.0,
					zIndex:9999,
				}, 1000, );
			});
			//color sys helper
			$( document ).on( "change", ".colorpcikewebjs", function() {
				colorCode = "#"+$(this).val();
					$('.selectcolorhiddenin').val(colorCode);
				$('.editing').css("color",colorCode);
			});
			//color sys helper two
			$( document ).on( "click", ".colorpickerwebjstrigger", function() {
				var thepreviouscolor = $('.selectcolorhiddenin').val();
				$('.colorpcikewebjs').val(colorToHex(thepreviouscolor));
			});
			//on chnage of editor fint size function
			$( document ).on( "change", "#textfontsize", function() {
				var chnagedfontsizee = $(this).val();
				$('.editing').css("fontSize",chnagedfontsizee+"px");
			});
			//editor left hiding and get back again function
			$( document ).on( "click", ".moveeditordown", function() {
				if($(this).parent('.editiboxtext').css('left') == '0px'){
					var farway = -500;					
					$(this).parent('.editiboxtext').animate({
						left: farway,
					}, 1000, function() {
						$('.moveeditordown').html("&#8594").css("position","fixed").css("left","0").css("top","8%").css("width","18px");
						if($('save_current').length == 0){
							var savecurrent = "<li class='save_current'>Save Current Element</li>";
							$('.settingbox ul').prepend(savecurrent);
						}
					});
				}
				else{
					$(this).parent('.editiboxtext').animate({
						left: 0,
					}, 1000, function() {
						$('.moveeditordown').html("&#8592").css("position","").css("left","").css("top","").css("width","");
						$('.save_current').remove();
					});
				}
				
			});
			//nav move up function
			$( document ).on( "click", ".moveeditorupnavbox", function() {
					var farway = -200;
					topsetfinal = farway+"%";					
					$('.settngholder.nav').animate({
						top: farway,
					}, 1000, );
				
			});
			//nav bar get it down function
			$( document ).on( "click", ".moveeditordownnavbox", function() {
					var farway = -200;
					topsetfinal = farway+"%";					
					$('.settngholder.nav').animate({
						top: 0,
					}, 1000, );
				
			});
			//save current elment function
			$( document ).on( "click", ".save_current", function() {
					$('.savebtn').click();
					$(this).remove();
				
			});	
		});
		//rgb to hex converter
		function colorToHex(color) {
				if (color.substr(0, 1) === '#') {
					return color;
				}
				var digits = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(color);
				var red = parseInt(digits[2], 10);
				var newred = parseInt(digits[2], 10);
				var green = parseInt(digits[3], 10);
				var blue = parseInt(digits[4], 10);
				var rgb = blue | (green << 8) | (red << 16);
				return digits[1] + rgb.toString(16);
				
		};
		//library Function
		(function($){
			//link editor
			$.fn.openlinkeditorwebjs = function(){
				//check if another editor there
				if(editingelemorginaltext == ""){
					//saving original text to a var
					editingelemorginaltext = $(this).html();
					//saving original url to a var
					edtinglinkurl = $(this).attr("href");
					//editor preview text set to a var
					var previewtext = $(this).text();
					//preview text filtering
					previewtext = previewtext.replace(/[^a-zA-Z ]/g, "");
					//making preview text maximum 30 character
					function ellipsify (previewtext) {
						if (previewtext.length > 30) {
						return (previewtext.substring(0, 30) + "...");
					}
					else {
						return previewtext;
					}
					
					}
					//saving original color
					editingColor = $(this).css("color");
					//saving original font size
					editinfontsize = $(this).css("fontSize");
					//making font size as number removing px
					editinfontsize = editinfontsize.replace("px","");
					editinfontsizeprevious = $(this).css("fontSize");
					//appending editor of link
					var saveorcancelbox = "<div class='editiboxtext' style=''><div style='' class='moveeditordown'>&#8595;</div><div class='editingtexttext' style=''><p>EDITING Link & TEXT: "+ellipsify(previewtext)+"</p></div><div style=''class='textsettingsadvanced'><label for='linkvaueconadad'>Edit link</label><input style='' type='text' id='linkvaueconadad' value='"+edtinglinkurl+"'>Select font family<select style='' id='fonr_family_text'><option>Select an Option</option><option>Georgia, serif</option><option>'Palatino Linotype', 'Book Antiqua', Palatino, serif</option><option>'Times New Roman', Times, serif</option><option>Arial, Helvetica, sans-serif</option><option>'Arial Black', Gadget, sans-serif</option><option>'Comic Sans MS', cursive, sans-serif</option><option>Impact, Charcoal, sans-serif</option><option>'Lucida Sans Unicode', 'Lucida Grande', sans-serif</option><option>Tahoma, Geneva, sans-serif</option><option>'Trebuchet MS', Helvetica, sans-serif</option><option>Verdana, Geneva, sans-serif</option><option>'Courier New', Courier, monospace</option><option>'Lucida Console', Monaco, monospace</option></select><label for='textfontsize'>Font Size</label><input style='' type='number' id='textfontsize' value='"+editinfontsize+"'>Apply Color<input style='' type='button' class='button colorpickerwebjstrigger' value='Select Color'><input type='hidden' class='selectcolorhiddenin' value='"+editingColor+"'></div><div style='margin-top: 40px;'><ul class='save-box' style='height: 70px;margin-left: -50px;' class='savemenu'><li style='' class='savebtn'>SAVE</li><li style='' class='removeelbtn'>REMOVE</li><li style='' class='cancelbtn'>CANCEL</li></ul><div style='' class='moveeditorup'>&#8593;</div></div></div>";
					$(this).attr("contenteditable","true").addClass("editing");
					$(".editing").css("border","2px").css("borderStyle", "double").css("padding","10px").css("backgroundColor","#fbf6e7");
					$('html').append(saveorcancelbox);
					$('.editiboxtext').animate({
						opacity: 1.0,
					}, 3000, );
				}
				else{
					//alert("One more editor is already opened");
					$('.save-box li').css({
						"-ms-transform": "rotate(5deg)", 
						"-webkit-transform": "rotate(5deg)",
						"transform": "rotate(5deg)"
					})
					setTimeout(function(){ 
						$('.save-box li').css({
						"-ms-transform": "rotate(0deg)", 
						"-webkit-transform": "rotate(0deg)",
						"transform": "rotate(0deg)"
						}) }, 
						2000);
					}
			}
			//image remove function
			$.fn.removetheimageelement = function(){
				var mainImageToEdit = $(".editingthisimagenow");
				$(this).parent().remove();
				shwoinganyeditor = false;
				var adadimsgr = confirm("Sure to remove Element?");
				if(adadimsgr == true){
					$(".editingthisimagenow").css("border","").css("borderStyle", "").css("padding","");
					mainImageToEdit.remove();
				}
				else{
					$(".editingthisimagenow").css("border","").css("borderStyle", "").css("padding","");
					mainImageToEdit.removeClass("editingthisimagenow");
				}
			}
			//cancel image editing
			$.fn.imagesettingcancelll = function(){
				var mainImageToEdit = $(".editingthisimagenow");
				$(this).parent().remove();
				shwoinganyeditor = false;
				$(".editingthisimagenow").css("border","").css("borderStyle", "").css("padding","");
				mainImageToEdit.removeClass("editingthisimagenow");
			}
			//save image data
			$.fn.saveimeinfothisextav = function(){
				var mainImageToEdit = $(".editingthisimagenow");
				var imagesrc = $(this).siblings("#imgesrceditor").val();
				var imageatertag = $(this).siblings("#imagealtereditor").val();
				mainImageToEdit.attr("src",imagesrc);
				mainImageToEdit.attr("alt",imageatertag);
				$(this).parent().remove();
				shwoinganyeditor = false;
				$(".editingthisimagenow").css("border","").css("borderStyle", "").css("padding","");
				mainImageToEdit.removeClass("editingthisimagenow");
				$(".exporthtmlnow").animate({
					opacity: 1.0,
				}, 5000, );
			}
			//cancel setting_box
			$.fn.settingcancellbtnaction = function(){
				shwoinganyeditor = false;
				$(this).parent().animate({
					opacity: 0.0,
				}, 3000, ).remove();
			}
			//save settiong
			$.fn.settingsavebtnmetatittle = function(){
				var theEditedTitle = $(this).siblings("#tittleeditewew").val();
				var theeditedmetatext = $(this).siblings("#metaeditingsdsad").val();
				$("title").html(theEditedTitle);
				$('meta[name="description"]').attr("content", theeditedmetatext);
				$(this).parent().animate({
					opacity: 0.0,
				}, 3000, ).remove();
				shwoinganyeditor = false;
				$(".exporthtmlnow").animate({
					opacity: 1.0,
				}, 5000, );
				
			}
			//open settings
			$.fn.opensetting_box = function(){
				var tittletext = $("title").html();
				var metatext = $('meta[name="description"]').attr("content");
				if($("title").length == 0){
					tittletext = "Tittle Tag Not Found";
				}
				if($('meta[name="description"]').length == 0){
					metatext = "Meta Tag Not Found";
				}
				var settingbox = "<div style='opacity:0;position: fixed;top: 20%;right: 0;width: 465px;font-size: 18px;background-color: #07396f;padding: 30px;color: #7d7d7d;' class='setting_box'><label style='display: inline-block;text-transform: uppercase;font-size: 14px;font-family: cursive;color: #ffffff;margin-bottom: 10px;' for='tittleeditewew'>Edit HTML Document Tittle</label><input style='margin-bottom: 10px;height: 50px;padding: 10px;width: 406px;' type='text' id='tittleeditewew' value='"+tittletext+"'/><label style='display: inline-block;text-transform: uppercase;font-size: 14px;font-family: cursive;color: #ffffff;margin-bottom: 10px;'for='metaeditingsdsad'>Edit HTML Document Meta Description</label><input style='margin-bottom: 10px;height: 50px;padding: 10px;width: 406px;' type='text' id='metaeditingsdsad' value='"+metatext+"'/><li style='cursor: pointer;list-style-type: none;background-color:#54da70;padding: 10px;color: white;border-radius: 3px;font-size: 13px;font-weight: 900;text-align: center;opacity: 1;width: 78px;display: inline-block;' class='settingssavebtn'>SAVE</li><li style='cursor: pointer;list-style-type: none;background-color: #2aa5e0;padding: 10px;color: white;border-radius: 3px;font-size: 13px;font-weight: 900;text-align: center;opacity: 1;width: 78px;display: inline-block;margin-left: 12px;' class='settingscancelbtn'>CANCEL</li></div>"
				$('html').append(settingbox); 
				shwoinganyeditor = true;
				$(".setting_box").animate({
					opacity: 1.0,
				}, 3000, );
				
			}
			//remove function
			$.fn.removeelbtnsaver = function(){
				var adad = confirm("Sure to remove Element?");
				if(adad == true){
					$(this).parent().parent().parent().remove();
					editingelemorginaltext = "";
					$('.editing').remove();
					$(".exporthtmlnow").animate({
					opacity: 1.0,
					}, 5000, );
				$(".colorpcikewebjs").animate({
					opacity: 0.0,
				}, 2000, );
				editingColor = '';
				editinfontsizeprevious = '';
				edtinglinkurl = '';
				iffontfamily = "";
				}
				
			}
			//cancel funciton
			$.fn.cancellbtnellemnt = function(){
				$('.editing').css("fontFamily",iffontfamily);
				iffontfamily = "";
				$('.editing').css("color",editingColor)
				.css("fontSize",editinfontsizeprevious);
				var chklinkpresent  = $(this).parent().parent().siblings().children("#linkvaueconadad").length;
				if(chklinkpresent == 1){
						$('.editing').attr("href",edtinglinkurl);
				}
				editingColor = '';
				editinfontsizeprevious = '';
				edtinglinkurl = '';
				$('.editing').html(editingelemorginaltext);
				editingelemorginaltext = "";
				$('.editing').removeAttr("contenteditable");
				$(".editing").css("border","").css("borderStyle", "").css("padding","").css("backgroundColor","");
				$('.editing').removeClass("editing");
				$(this).parent().parent().parent().remove();
				$(".colorpcikewebjs").animate({
					opacity: 0.0,
				}, 2000, );
			}
			//download html
			function downloadInnerHtml(filename, fullmarkup, elId, mimeType) {
				var elHtml = fullmarkup;
				var link = document.createElement('a');
				mimeType = mimeType || 'text/plain';

				link.setAttribute('download', filename);
				link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(elHtml));
				link.click(); 
			}
			//export
			$.fn.exporthtmlnow = function(){
				$(this).parent().parent().remove();
				$('colorpcikewebjs').remove();
				$('.settngholder').remove();
				$('.moveeditordownnavbox').remove();
				$( "script[src='getcolor.js']" ).remove();
				$( "script[src='blackash-editor']" ).remove();
				$('#myCssblackashedit').remove();
				var markup = document.documentElement.innerHTML;
				var fullmarkup = "<html>"+markup+"</html>";
				//$('html').html("");
				var fileName = prompt("Please enter file name to Save(optional)", "index");
				if (fileName != null) {
					fileName =  fileName+'.html';
				}
				else {
					fileName = "EdidtedHtml.html"
				}
				downloadInnerHtml(fileName, fullmarkup, 'main','text/html');
				
			}
			//save function
			$.fn.editeditorsavenow = function(){
				var fontfamily = $("#fonr_family_text").val();
				if(fontfamily != "Select an Option"){
					$('.editing').css("fontFamily",fontfamily);
				}
				var colorget = $('.selectcolorhiddenin').val();
				if(colorget != null){
					$('.editing').css("color",colorget);
				}
				var fontsizedatatext = $('#textfontsize').val();
				if(colorget != null){
					$('.editing').css("fontSize", fontsizedatatext);
				}
				else{
					$('.editing').css("fontSize", editinfontsizeprevious);
				}
				var chklinkpresent  = $(this).parent().parent().siblings().children("#linkvaueconadad").length;
				if(chklinkpresent == 1){
					var liunkvalue = $(this).parent().parent().siblings().children("#linkvaueconadad").val();
					if(liunkvalue != null){
						$('.editing').attr("href",liunkvalue);
					}
				}
				
				editinfontsizeprevious = '';
				var thesavingtext = $('.editing').html();
				var theulelement = $(this).parent();
				iffontfamily = "";
				//var thetextarea = theulelement.siblings(".headingeditor");
				//var themainelelemtntosave = theulelement.parent();
				$('.editing').html(thesavingtext);
				editingelemorginaltext = "";
				$('.editing').removeAttr("contenteditable");
				$(".editing").css("border","").css("borderStyle", "").css("padding","").css("backgroundColor","");
				$('.editing').removeClass("editing");
				$(this).parent().parent().parent().remove();
				$(".exporthtmlnow").animate({
					opacity: 1.0,
				}, 5000, );
				$(".colorpcikewebjs").animate({
					opacity: 0.0,
				}, 2000, );
				editingColor = '';
				
				
			}
			//font-family changing preview
			$.fn.previewfonttyextx = function(){
				var fontfamily = $("#fonr_family_text").val();
				if(fontfamily != "Select an Option"){
					$('.editing').css("fontFamily",fontfamily);
				}
				else{
					$('.editing').css("fontFamily","inherit");
				}
			}
		//open edit editor
			$.fn.editeditor = function(){
				if(editingelemorginaltext == ""){
					editingelemorginaltext = $(this).html();
					var previewtext = $(this).text();
					previewtext = previewtext.replace(/[^a-zA-Z ]/g, "");
					function ellipsify (previewtext) {
						if (previewtext.length > 30) {
						return (previewtext.substring(0, 30) + "...");
					}
					else {
						return previewtext;
					}
					
					}
					editingColor = $(this).css("color");
					editinfontsize = $(this).css("fontSize");
					editinfontsize = editinfontsize.replace("px","");
					editinfontsizeprevious = $(this).css("fontSize");
					iffontfamily = $(this).css("fontFamily");
					var saveorcancelbox = "<div class='editiboxtext' style='' class='editingtextedit'><div style='' class='moveeditordown'>&#8592;</div><div class='editingtexttext' style=''><p>EDITING TEXT: <strong>"+ellipsify(previewtext)+"</strong></p></div><div style=''class='textsettingsadvanced'>Select font family<select style='' id='fonr_family_text'><option>Select an Option</option><option>Georgia, serif</option><option>'Palatino Linotype', 'Book Antiqua', Palatino, serif</option><option>'Times New Roman', Times, serif</option><option>Arial, Helvetica, sans-serif</option><option>'Arial Black', Gadget, sans-serif</option><option>'Comic Sans MS', cursive, sans-serif</option><option>Impact, Charcoal, sans-serif</option><option>'Lucida Sans Unicode', 'Lucida Grande', sans-serif</option><option>Tahoma, Geneva, sans-serif</option><option>'Trebuchet MS', Helvetica, sans-serif</option><option>Verdana, Geneva, sans-serif</option><option>'Courier New', Courier, monospace</option><option>'Lucida Console', Monaco, monospace</option></select><label for='textfontsize'>Font Size</label><input style='' type='number' id='textfontsize' value='"+editinfontsize+"'>Apply Color<input style='' type='button' class='button colorpickerwebjstrigger' value='Select Color'><input type='hidden' class='selectcolorhiddenin' value='"+editingColor+"'></div><div style='margin-top: 40px;'><ul class='save-box' style='height: 70px;margin-left: -50px;' class='savemenu'><li style='' class='savebtn'>SAVE</li><li style='' class='removeelbtn'>REMOVE</li><li style='' class='cancelbtn'>CANCEL</li></ul><div style='' class='moveeditorup'>&#8593;</div></div></div>";
					$(this).attr("contenteditable","true").addClass("editing");
					$(".editing").css("border","2px").css("borderStyle", "double").css("padding","10px").css("backgroundColor","#fbf6e7");
					$('html').append(saveorcancelbox);
					$('.editiboxtext').animate({
						opacity: 1.0,
					}, 3000, );
				}
				else{
					//alert("One more editor is already opened");
					$('.save-box li').css({
						"-ms-transform": "rotate(5deg)", 
						"-webkit-transform": "rotate(5deg)",
						"transform": "rotate(5deg)"
					})
					setTimeout(function(){ 
						$('.save-box li').css({
						"-ms-transform": "rotate(0deg)", 
						"-webkit-transform": "rotate(0deg)",
						"transform": "rotate(0deg)"
						}) }, 
						2000);
					}
				
			
			}
			//image click
			$.fn.showeditmenuHforImage = function(){
				editingImageClass = "editingthisimagenow";
				$(this).addClass(editingImageClass);
				$(".editingthisimagenow").css("border","2px").css("borderStyle", "double").css("padding","10px");
				var imagesrc = $(this).attr("src");
				var imagealterrag = $(this).attr("alt");
				if(imagesrc == null){
					imagesrc = "Image Source Not Found";
				}
				else{
					//
				}
				if(imagealterrag == null){
					imagealterrag = "Alter Attribute Value Not Found";
				}
				else{
					//$('meta[name="description"]').addClass("metaeditingsdsad");
				}
				var settingboximage = "<div style='opacity:0;position: fixed;top: 20%;right: 0;width: 465px;font-size: 18px;background-color: #07396f;padding: 30px;color: #7d7d7d;' id='imageboxdivhere'><label style='display: inline-block;text-transform: uppercase;font-size: 14px;font-family: cursive;color: #ffffff;margin-bottom: 10px;' for='imgesrceditor'>Edit Image Source</label><input style='margin-bottom: 10px;height: 50px;padding: 10px;width: 406px;' type='text' id='imgesrceditor' value='"+imagesrc+"'/><label style='display: inline-block;text-transform: uppercase;font-size: 14px;font-family: cursive;color: #ffffff;margin-bottom: 10px;'for='imagealtereditor'>Edit Image Alter Tag</label><input style='margin-bottom: 10px;height: 50px;padding: 10px;width: 406px;' type='text' id='imagealtereditor' value='"+imagealterrag+"''/><li style='cursor: pointer;list-style-type: none;background-color:#54da70;padding: 10px;color: white;border-radius: 3px;font-size: 13px;font-weight: 900;text-align: center;opacity: 1;width: 78px;display: inline-block;' id='"+editingImageClass+"'' class='imagesettingssavebtn'>SAVE</li><li style='cursor: pointer;list-style-type: none;background-color: #cc4949;padding: 10px;color: white;border-radius: 3px;font-size: 13px;font-weight: 900;text-align: center;opacity: 1;width: 78px;display: inline-block;margin-left:10px' class='removeelbtnforimage'>REMOVE</li><li style='cursor: pointer;list-style-type: none;background-color: #2aa5e0;padding: 10px;color: white;border-radius: 3px;font-size: 13px;font-weight: 900;text-align: center;opacity: 1;width: 78px;display: inline-block;margin-left: 12px;' class='imagesettingscancelbtn'>CANCEL</li></div>"
				$('html').append(settingboximage); 
				shwoinganyeditor = true;
				$("#imageboxdivhere").animate({
					opacity: 1.0,
				}, 3000, );
				
			
			}
			$.fn.getStyleObject = function(){
				var dom = this.get(0);
				var style;
				var returns = {};
					if(window.getComputedStyle){
						var camelize = function(a,b){
						return b.toUpperCase();
					}
					style = window.getComputedStyle(dom, null);
					for(var i=0;i<style.length;i++){
						var prop = style[i];
						var camel = prop.replace(/\-([a-z])/g, camelize);
						var val = style.getPropertyValue(prop);
						returns[camel] = val;
					}
					return returns;
					}
					if(dom.currentStyle){
						style = dom.currentStyle;
						for(var prop in style){
							returns[prop] = style[prop];
						}
						return returns;
					}
					return this.css();
			}
		})(jQuery);
    };
    document.getElementsByTagName("head")[0].appendChild(script);
})();
