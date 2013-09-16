/**
 * Get language
 * @param {Object} key
 */
function l(key){
	if(lang[key]){
		return lang[key];
	}
	return key;
}
/**
 * init Spnix style input
 * @param iptCls
 * @return
 */
function initHodingInput(iptCls){
	$(iptCls).each(function() {
			if ($(this).val() != "") {
				$(this).siblings(".holder").css("text-indent", "-999em");
				$(this).siblings(".holder").hide();
			}
			$(this).blur(function(){
				if($(this).val()==""){
					$(this).siblings(".holder").css({"opacity" : 1, "text-indent" : "0"});
				}
			})
			.bind("propertychange keyup input paste focus load", function(event){
				if($(this).val()==""){
					$(this).siblings(".holder").show();
					$(this).siblings(".holder").css({"opacity" : 1, "text-indent" : "0"});
				}else{
					$(this).removeClass("error");
					$(this).siblings(".holder").css("text-indent", "-999em");
					$(this).siblings(".holder").hide();
				}
			});
			$(this).siblings(".holder").bind("click focus", function(event){
				
				$(this).siblings(iptCls).focus();
			});
		});
}
/**
 * Show a ipad style popoverview in page
 * @param origin: parent div
 * @param header: title
 * @param block_id
 * @return
 */
function showPopover(origin,header,block_id){
	var popoverWidth = 338;
	var popoverHeight = 447;
	
	if($('.popover').size() > 0 ){
		removePopover();
	}
	var winHeight = $(window).height();
	var eleX = $(origin).offset().top;
	var eleY = $(origin).offset().left;
	var originX;
	var originY = eleY - popoverWidth - 2;
	var posCls = 'pop-middle';
	if((winHeight - eleX) > 480){
		posCls = 'pop-top';
		originX = eleX + 10;
	}else if(eleX > 640){
		posCls = 'pop-bottom';
		originX = eleX - popoverHeight + 10;
	}else{
		originX = eleX - popoverHeight / 2 + 20;
	}
	var popoverHtml = '<div class="popover ' + posCls + '" id="popover-view"><div class="popover-content"><div class="popover-body"><form id="popover-form">';
		popoverHtml += '<input type="hidden" class="block-used-count" value="'+block_id+'" /><input type="hidden" name="block_id" value="'+block_id+'" />';
		popoverHtml += '<input type="hidden" class="popover-origin-x" value="'+originX+'" /><input type="hidden" class="popover-origin-y" value="'+originY+'" />';	
		popoverHtml += '<div class="head"><a href="javascript:setPopoverFullScreen();" id="popover-fullscreen-btn-open" class="top-tip right" title="フルスクリーンで編集">';
		popoverHtml += '<img src="' + $('#ci_baseurl').val() + 'images/fullscreen.png" /></a>';
		popoverHtml += '<a href="javascript:cancelPopoverFullScreen();" id="popover-fullscreen-btn-close" style="display:none;" class="top-tip right" title="フルスクリーンを閉じる">';
		popoverHtml += '<img src="' + $('#ci_baseurl').val() + 'images/fullscreen-exit.png" /></a><p>' + header + '</p></div>';
		popoverHtml += '<div class="body"><div class="loading"></div>'
		popoverHtml += '<textarea id="popover-block-editor" class="textarea" name="content"></textarea>'
		popoverHtml += '<div class="btn"><a href="javascript:cancelLayoutBlockSource();" id="block-edit-btn-close" class="ui-btn ui-btn-gray"><span class="ui-btn-inner">キャンセル</span></a>';
		popoverHtml += '<a href="javascript:saveLayoutBlockSource();" id="block-edit-btn-open" class="ui-btn ui-btn-blue"><span class="ui-btn-inner">保存</span></a></div>';
		popoverHtml += '</div></form></div></div></div>';
	$('#page-mask').before(popoverHtml);
	$('#popover-view').offset({top : originX, left : originY});
	$(".top-tip").tipTip({maxWidth: "auto", edgeOffset: 2 , defaultPosition : 'top' , delay : 200});
	
	loadPopoverContent(block_id); /** Ajax get block html */
}
function removePopover(){
	$('.popover').removeAttr('id').fadeOut('fast', function() {
	    $(this).remove();
	});
}
/**
 * 
 * @param block_id
 * @return
 */
function loadPopoverContent(block_id){
	var reqUrl = $('#ci_baseurl').val() + 'block/ajax';
	$.get(reqUrl, { type: "block_html", block_id: block_id },
		function(data){
			if(data['error']){
				alert(data['error']); /** It need be improved */
				return;
			}
			$('#popover-view .loading').fadeOut('fast');
			$('#popover-view .block-used-count').val(data['result']['used_count']);
			$('#popover-view #popover-block-editor').val(data['result']['block_html']);
		}
	);
}
/**
 * FullScreen mode
 * @return
 */
function setPopoverFullScreen(){
	$('#popover-view #popover-fullscreen-btn-open').hide();
	$('#popover-view #popover-fullscreen-btn-close').show();
	$('#popover-view').addClass('fullscreen');
	
	$('#popover-view').offset({ top: ($(window).height()-$('#popover-view').height())/2, left: ($(window).width()-$('#popover-view').width())/2 });
}
function cancelPopoverFullScreen(){
	$('#popover-view #popover-fullscreen-btn-open').show();
	$('#popover-view #popover-fullscreen-btn-close').hide();
	$('#popover-view').removeClass('fullscreen');
	//$('.popover').removeAttr('style');
	$('#popover-view').offset({top : $('#popover-view').find('.popover-origin-x').val(), left : $('#popover-view').find('.popover-origin-y').val()});
}
/**
 * Save/Cancel Popover view
 */

function cancelLayoutBlockSource(){
	removePopover();
}

function saveLayoutBlockSource(){
	var reqUrl = $('#ci_baseurl').val() + 'block/ajax?type=update_block_html';
	var param = $('#popover-view #popover-form').serialize();
	$.post(reqUrl , param , 
		function(data){
			if(data['result'] == true){
				removePopover();
			}else{
				alert('Update block data failed');
			}
		}
	);
	
	
}
/**
 * Botton loading
 */
function setBtnLoading(sender){
	$(sender).find('.ui-btn-inner').addClass('loading');
}
function removeBtnLoading(sender){
	$(sender).find('.ui-btn-inner').removeClass('loading');
}


/**
 * Add a mask layout
 */
function addMaskView(type){
	if( $('#page-mask').size() > 0 ){
		return;
	}
    var mask = '<div id="page-mask"></div>';
    $('#main').before(mask);
	if(type == 'light'){
		$('#page-mask').css('opacity','0.2');
	}
    $('#page-mask').fadeIn().height($(document).height());
	
}
/**
 * Remove the mask layout
 */
function removeMaskView(){
    $('#page-mask').remove();
    $('#page-mask').fadeOut();
}
/**
 * openMessageBox
 */
function openMessageBox(type , reqUrl , param){
	addMaskView('light');
	var content;
	var saveBtn;
	switch (type){
		case 'create_layout_cate' :
			var bodyInput = '<form id="message-box-form" action="'+reqUrl+'"><p class="placeholding h2-holding"><input type="text" name="cate_name" class="input h2-title" value="">';
			bodyInput += '<label for="layout-name" class="holder">カテゴリ名</label></p></form>';
			saveBtn = '<a href="javascript:void(0);" onclick="createLayoutCategory(this,\'#message-box-form\')"  class="ui-btn ui-btn-blue"><span class="ui-btn-inner">保 存</span></a>';
			content = makeMessageBoxHtml('カテゴリ新規作成' , bodyInput , saveBtn);
			break;
		case 'create_page_cate' :
			var bodyInput = '<form id="message-box-form" action="'+reqUrl+'"><p class="placeholding h2-holding"><input type="text" name="cate_name" class="input h2-title" value="">';
			bodyInput += '<label for="layout-name" class="holder">カテゴリ名</label></p></form>';
			saveBtn = '<a href="javascript:void(0);" onclick="createPageCategory(this,\'#message-box-form\')"  class="ui-btn ui-btn-blue"><span class="ui-btn-inner">保 存</span></a>';
			content = makeMessageBoxHtml('カテゴリ新規作成' , bodyInput , saveBtn);
			break;
		default :
			bodyInput = param[1];
			saveBtn = '<a href="javascript:void(0);" onclick="confirmMessage(this)"  class="ui-btn ui-btn-blue"><span class="ui-btn-inner">'+l('confirm')+'</span></a>';
			content = makeMessageBoxHtml(param[0] , bodyInput , saveBtn);
		 	break;
	}
	$('#page-mask').before(content);
	$('#message-box').css({ top: ($(window).height()-$('#message-box').height())/2, left: ($(window).width()-$('#message-box').width())/2 });
	initHodingInput('.input');
	$('#message-box .input').focus();
}
/**
 * Make massage box html for openMessageBox(Func)
 * @param {Object} title
 * @param {Object} bodyInput
 * @param {Object} saveBtn
 */
function makeMessageBoxHtml(title , bodyInput , saveBtn){
	var html = '<div id="message-box"><div class="message-border"><div class="head"><p>'+title+'</p></div>';
	if(bodyInput != ''){
		html += '<div class="body">' + bodyInput + '</div>';
	}
	html += '<div class="foot-btn bottom-spac">';
	html += '<a href="javascript:cancelMessageBox();" class="ui-btn ui-btn-gray"><span class="ui-btn-inner">'+l('cancel')+'</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
	html += saveBtn + '</div></div></div>';
	return html;
}
/**
 * 
 */
function cancelMessageBox(){
	$('#message-box').remove();
	removeMaskView();
}
/**
 * 
 * @param sender
 * @return
 */
function confirmMessage(sender){
	cancelMessageBox();
}