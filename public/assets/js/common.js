
$(function (e) {
	$width = $(window).innerWidth(),
    wWidth = windowWidth();

	$(document).ready(function (e) {
		scrollFixed();
		scrollSticky(); // 2024-08-22 추가
        leftMenu();		
		innerTable();
        toolTip();
		subConHeight();

		if(wWidth < 1025){		
		}else{		
		}
		
		resEvt();
	});

	// resize
	function resEvt() {	
		if (wWidth < 1025) {
			
		} else {	
            
		}

		if(wWidth < 769){
			touchHelp();
		}
	}

	$(window).resize(function (e) {
		$width = $(window).innerWidth(),
		wWidth = windowWidth();
		resEvt();
	});

	$(window).scroll(function(e){
		if($(this).scrollTop() > 200){
			$('.js-btn-top').addClass('on');
		}else{
			$('.js-btn-top').removeClass('on');
		}
	});
});

function Mobile() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

function windowWidth() {
	if ($(document).innerHeight() > $(window).innerHeight()) {
		if (Mobile()) {
			return $(window).innerWidth();
		} else {
			return $(window).innerWidth() + 17;
		}
	} else {
		return $(window).innerWidth();
	}
}

function scrollFixed(){
	$('.js-scroll-fixed').each(function(e){
		var fixedPosition = $('.js-scroll-fixed').offset().top;

		$(window).scroll(function(e){
			if(fixedPosition < $(window).scrollTop()){
				$('.js-scroll-fixed').addClass('fixed');
			}else{
				$('.js-scroll-fixed').removeClass('fixed').removeAttr('style');
			}            
		});
        
        // 1400px 이하
        /*if(windowWidth() < 1400){
            $(window).scroll(function(e){
                if(fixedPosition < $(window).scrollTop()){
                    let $scrollY = $(window).scrollLeft() * -1;
                    $('.js-scroll-fixed').css({
                        'left': $scrollY,
                        'margin-left': '5%'
                    });
                }else{
                    $('.js-scroll-fixed').removeAttr('style');
                }
            });                
        }*/
	});	
}

// 2024-08-22 sub-tab-menu 스크롤 시 상단 고정
function scrollSticky(){
	$('.js-scroll-sub-sticky').each(function(e){
		var stickyPosition = $('.js-scroll-sub-sticky').offset().top;

		$(window).scroll(function(e){
			if(stickyPosition < $(window).scrollTop()){
				$('.js-scroll-sub-sticky').addClass('sticky');
			}else{
				$('.js-scroll-sub-sticky').removeClass('sticky').removeAttr('style');
			}
		});
	});	
}

function leftMenu(){
	$('.js-left-menu > li > a').on('click',function(e){
		if($(this).parent('li').hasClass('on')){
			return false;
		}
		$(this).parent('li').toggleClass('active');
		$('.js-left-menu > li > a').not(this).parent('li').removeClass('active on');
		$(this).next('ul').stop().slideToggle();
		$('.js-left-menu > li > a').not(this).next('ul').stop().slideUp();
    });
}

function innerTable(){
	$('td.wide').each(function(e){
		var height = $(this).prev('th').outerHeight();
		$(this).height('').height(height);
	});	
}

function subConHeight(){
    $(document).ready(function(e){
        var subConHeight = $(window).outerHeight() - $('#header').outerHeight() - $('#footer').outerHeight();
        setTimeout(function(e){
            $('#container').css('min-height',subConHeight);
        },100);
    });	
}


function btnTop(){
	$('.js-btn-top').on('click',function(e){
	  $('html, body').stop().animate({'scrollTop':0},400);
		return false;
	});
}

function touchHelp(){
	$('.scroll-x').each(function(e){
		if($(this).height() < 180){
			$(this).addClass('small');
		}
		$(this).scroll(function(e){
			$(this).removeClass('touch-help');
		});
	});
}

function toolTip(){
    if($('.tooltip').length){
        $('.tooltip').each(function(e){
            $(this).off().mouseenter(function(e){
                $(this).children('.tooltip-con').stop().fadeIn(100); 
            });
            $('.tooltip').mouseleave(function(e){
                $('.tooltip-con').hide().stop().fadeOut(100);
            });
        });
    }
}



var pageUrl = window.location.pathname; 
var pageChk = pageUrl.split("/")[2]; 
$(window).on('load', function () 
{

	$('.datepickerY, .datepickerM, .datepickerD, .datepickerH, .datepickerI, .birthY, .birthM, birthD, .datepicker').on('blur', function() {
		if($(this).hasClass('datepickerY') || $(this).hasClass('birthY')){
			var _name = $(this).attr('name').replace('_date_y','');
		}
		if($(this).hasClass('datepickerM') || $(this).hasClass('birthM')){
			var _name = $(this).attr('name').replace('_date_m','');
		}
		if($(this).hasClass('datepickerD')){
			var _name = $(this).attr('name').replace('_date_d','');
		}
		if($(this).hasClass('datepickerH')){
			var _name = $(this).attr('name').replace('_date_h','');
			if ($(this).val()) {
				var chkNum = parseInt($(this).val());
				if (chkNum < 0 || chkNum > 23) {
					alert("유효한 시간이 아닙니다.");
					$(this).val('');
					$(this).focus();
					return false;
				} else {
					$(this).val(numberPad(chkNum,2));
				}
			}
		}
		if($(this).hasClass('datepickerI')){
			var _name = $(this).attr('name').replace('_date_i','');
			if ($(this).val()) {
				var chkNum = parseInt($(this).val());
				if (chkNum < 0 || chkNum > 59) {
					alert("유효한 시간이 아닙니다.");
					$(this).val('');
					$(this).focus();
					return false;
				} else {
					$(this).val(numberPad(chkNum,2));
				}
			}
		}
		if($(this).hasClass('datepicker')){
			if($(this).val() && !isValidDate($(this).val())){
				alert("유효한 날짜가 아닙니다. (ex:2014-4-5 경우 2014-04-05로 입력)");
			//	$(this).val('');
				$(this).focus();
			}
			return false;
		}

		var _year = $('input[name='+_name+'_date_y]').val();
		var _month = $('input[name='+_name+'_date_m]').val();
		if (_month.length == 1) {
			_month = '0'+_month;
			$('input[name='+_name+'_date_m]').val(_month);
		}
		var _day = $('input[name='+_name+'_date_d]').val();
		if (_day.length == 1) {
			_day = '0'+_day;
			$('input[name='+_name+'_date_d]').val(_day);
		}
		var _input_date = "";

		if(_year && _month && _day){
			_input_date = _year+"-"+_month+"-"+_day;
			if(!isValidDate(_input_date)){
				alert("유효한 날짜가 아닙니다. (ex:2022-4-5 경우 2022-04-05로 입력)");
				$('input[name='+_name+'_date_y]').val('');
				$('input[name='+_name+'_date_m]').val('');
				$('input[name='+_name+'_date_d]').val('');
			}
			var inputday = new Date(_input_date);
			var today = new Date();
			var today_year = today.getFullYear();
			var today_month = today.getMonth()+1;
			var today_date = today.getDate();

			if (today_month.toString().length == 1) {
				today_month = '0'+today_month;
			}
			if (today_date.toString().length == 1) {
				today_date = '0'+today_date;
			}
			if (today < inputday) {
				alert("오늘 이후의 날짜는 선택할 수 없습니다.");
				$('input[name='+_name+'_date_y]').val('');
				$('input[name='+_name+'_date_m]').val('');
				$('input[name='+_name+'_date_d]').val('');
				return false;
			}
			if ($('input[name='+_name+'_date_h]').length > 0) {
			//	if ($('input[name='+_name+'_date_h]').val() && $('input[name='+_name+'_date_i]').val()) checked_db_fun (_name);
			} else {
			//	checked_db_fun (_name);
			}
		}

		var date_arr_chk = ( $("#DateArr") ) ? $("#DateArr").val() : "";
		if (date_arr_chk) {
			let chk_name_arr = ["consf_d", "gsf_d", "ttf_d", "vmf_d", "omf_d"];
			var dateArr = $("#DateArr").val().split('|;|');

			if(chk_name_arr.indexOf(_name) !== -1){
				$(dateArr).each(function(dt) {
					if (_input_date == dateArr[dt]) {
						alert("이미 등록된 날짜 입니다.");
						$('input[name='+_name+'_date_y]').val('');
						$('input[name='+_name+'_date_m]').val('');
						$('input[name='+_name+'_date_d]').val('');
						return false;
					}
				});
			}
		}
		
		//나이(소수점 처리) 계산 [공통]
		if (_input_date && $(this).attr('data-ageFcal') ) {
			var ageFcalArr = $(this).attr('data-ageFcal').split('|;|');
			var birth_d = '', ageFloat = '', birthMonths = '', diffDNum = 0;
			var objName_ageFcal = ( ageFcalArr[0] && ageFcalArr[1] ) ? ageFcalArr[1] : '' ;
			var ageMonth, birthWeek = "";


			if(ageFcalArr[2] && ageFcalArr[3]){
				if(ageFcalArr[4]){
					var birth_d = $("#"+ageFcalArr[4]).val();
				}else{
					var birth_d = $("#"+ageFcalArr[2]+"_date_y").val() + "-" + $("#"+ageFcalArr[2]+"_date_m").val() + "-" + $("#"+ageFcalArr[2]+"_date_d").val();	
				}

				if(_name == 'birth'){
					birth_d = _year + "-" + _month + "-" + _day;
					chk_d = $("#Dx_d1_date_y").val() + "-" + $("#Dx_d1_date_m").val() + "-" + $("#Dx_d1_date_d").val();
				}else{
					chk_d = _year + "-" + _month + "-" + _day;	
				}
				
				
				if($(this).attr('name').match(/^f[2-9]\d*_last_opd_d$/)){
					chk_d = $("#DBf1_opd_d").val();
				}
			}else{
				if(_name == 'birth'){
					birth_d = _year + "-" + _month + "-" + _day;
					// enter-k만 있는 진단 일자 선택때문에 이 부분이 수정됨
					// var chk_d = today_year + "-" + today_month + "-" + today_date;
					var chk_d = "";
					var check_radio = $('input[name=Dx]:checked').val();
					chk_d = $("#Dx_d"+check_radio+"_date_y").val() + "-" + $("#Dx_d"+check_radio+"_date_m").val() + "-" + $("#Dx_d"+check_radio+"_date_d").val();
					console.log('dddddddddddd');
					console.log(chk_d);
				}else{
					var chk_d =  _year + "-" + _month + "-" + _day;
					birth_d = $("#DBbirth").val();
				}
			}

			console.log ( "1._name: " + _name + " / objName_ageFcal: " + objName_ageFcal + " / birth_d: " + birth_d + " / chk_d: " + chk_d );
			if (isValidDate(chk_d) && isValidDate(birth_d)) {
			//	console.log ( age_FloatCal_fun (birth_d, chk_d, 'Y') + '(연 기준) / ' + age_FloatCal_fun (birth_d, chk_d, 'M') + '(월 기준) / ' + age_FloatCal_fun (birth_d, chk_d, 'D') + '(일 기준)' );
				ageFloat = age_FloatCal_fun (birth_d, chk_d, ageFcalArr[0]);
				diffDNum = datetime_diff_fun (birth_d, chk_d);
				birthMonths = parseInt(diffDNum / 30.417);
				birthWeek = parseInt(diffDNum/7);

				console.log("birth_d = "+birth_d);
				console.log("chk_d = "+chk_d);
				console.log("ageFcalArr = "+ageFcalArr[0]);
			//	console.log ( '출생개월수 : ' + birthMonths + '(diffDNum='+diffDNum+')' );
			}

			console.log(ageFcalArr);
			console.log(ageFloat);
			if(ageFcalArr[3]){
				$("#"+ageFcalArr[3]).val(ageFloat);
			}else{
				$("#"+objName_ageFcal+"age").val(ageFloat);	
			}
			

			
			
		}
		
		var diffSD, diffED, diffDays_ObjName, calMDnum, diffDays;
		//기간(days - diffSDcal) 계산 [공통]
		if ( _input_date && $(this).attr('data-diffSDcal') ) {
			var diffSDcalArr = $(this).attr('data-diffSDcal').split('|;|');
			console.log ( "_name: " + _name + " / diffSDcalArr: " + diffSDcalArr );
			diffSD = ( $("#DB"+diffSDcalArr[0]).val() ) ? $("#DB"+diffSDcalArr[0]).val() : $("#"+diffSDcalArr[0]+"_date_y").val() + "-" + $("#"+diffSDcalArr[0]+"_date_m").val() + "-" + $("#"+diffSDcalArr[0]+"_date_d").val();
			diffED = _year + "-" + _month + "-" + _day;
			diffDays_Type = diffSDcalArr[1];
			diffDays_ObjName = diffSDcalArr[2];
			diffDays_Change = diffSDcalArr[3];
			console.log ( "diffSD: " + diffSD + " / diffED: " + diffED + " / diffDays_Type: " + diffDays_Type + " / diffDays_ObjName: " + diffDays_ObjName );
			diffDays = '';
			if (diffSD.replace('--','') && diffED.replace('--','')) {
				if(diffDays_Change == "Y"){
					diffDays = datetime_diff_fun (diffED, diffSD);
				}else{
					diffDays = datetime_diff_fun (diffSD, diffED);	
				}
				
			}
			if (diffDays_Type == 'D') {
				$("#"+diffDays_ObjName).val(diffDays);
				choose_day();
			} else {
				if (diffDays) {
					calMDnum = diffDays_Type.replace(/[^0-9]/g,"");
				console.log ( "diffDays: " + diffDays + " / calMDnum: " + calMDnum + " / 나누기: " + parseInt(diffDays / calMDnum) + " / 몫: " + (diffDays % calMDnum) );
					$("#"+diffDays_ObjName+"m").val( parseInt(diffDays / calMDnum) );
					$("#"+diffDays_ObjName+"d").val( (diffDays % calMDnum) );
				} else {
					$("#"+diffDays_ObjName+"m").val("");
					$("#"+diffDays_ObjName+"d").val("");
				}
			}
		}

		//기간(days - diffEDcal) 계산 [공통]
	/*	if ( _input_date && ($(this).attr('data-diffEDcal')) ) {
			var diffEDcalArr = ($(this).attr('data-diffEDcal')) ? $(this).attr('data-diffEDcal').split('|;|') : '';
			console.log ( "_name: " + _name + " / diffEDcalArr: " + diffEDcalArr );
			if (diffEDcalArr[0].indexOf('||') != -1) {
				var diffEDcalArr_arr = diffEDcalArr[0].split('||');
				$( diffEDcalArr_arr ).each(function(i) {
					diffSD = _year + "-" + _month + "-" + _day;
					diffED = ( $("#DB"+diffEDcalArr_arr[i]).val() ) ? $("#DB"+diffEDcalArr_arr[i]).val() : $("#"+diffEDcalArr_arr[i]+"_date_y").val() + "-" + $("#"+diffEDcalArr_arr[i]+"_date_m").val() + "-" + $("#"+diffEDcalArr_arr[i]+"_date_d").val();
					diffDays_ObjName = diffEDcalArr[1].split('||')[i];
					console.log ( "diffSD"+i+": " + diffSD + " / diffED"+i+": " + diffED + " / diffDays_ObjName"+i+": " + diffDays_ObjName );
					diffDays = '';
					if (diffSD.replace('--','') && diffED.replace('--','')) diffDays = datetime_diff_fun (diffSD, diffED);
					$("#"+diffDays_ObjName).val(diffDays);
				});
			} else {
				diffSD = _year + "-" + _month + "-" + _day;
				diffED = ( $("#DB"+diffEDcalArr[0]).val() ) ? $("#DB"+diffEDcalArr[0]).val() : $("#"+diffEDcalArr[0]+"_date_y").val() + "-" + $("#"+diffEDcalArr[0]+"_date_m").val() + "-" + $("#"+diffEDcalArr[0]+"_date_d").val();
				diffDays_ObjName = diffEDcalArr[1];
				console.log ( "diffSD: " + diffSD + " / diffED: " + diffED + " / diffDays_ObjName: " + diffDays_ObjName );
				diffDays = '';
				if (diffSD.replace('--','') && diffED.replace('--','')) diffDays = datetime_diff_fun (diffSD, diffED);
				$("#"+diffDays_ObjName).val(diffDays);
			}
		}
		
		if (_input_date && _name == 'birth') {
			var birthday = new Date(_input_date);
			var today = new Date();
			var years = today.getFullYear() - birthday.getFullYear();

			birthday.setFullYear(today.getFullYear());
			if (today < birthday) years--;

			$("#age").val(years);
		}*/

	});

		
	//나이(소수점 처리) 계산 [공통]
	$('.datepickerY').each(function() {
		var _name = $(this).attr('name').replace('_date_y','');
		var _year = $('input[name='+_name+'_date_y]').val();
		var _month = $('input[name='+_name+'_date_m]').val();
		var today = new Date();
		var today_year = today.getFullYear();
		var today_month = today.getMonth()+1;
		var today_date = today.getDate();
		if (today_month.toString().length == 1) {
			today_month = '0'+today_month;
		}
		if (today_date.toString().length == 1) {
			today_date = '0'+today_date;
		}
		if (_month.length == 1) {
			_month = '0'+_month;
			$('input[name='+_name+'_date_m]').val(_month);
		}
		var _day = $('input[name='+_name+'_date_d]').val();
		if (_day.length == 1) {
			_day = '0'+_day;
			$('input[name='+_name+'_date_d]').val(_day);
		}
		var _input_date = _year+"-"+_month+"-"+_day;
		if (_input_date && $(this).attr('data-ageFcal') ) {
			var ageFcalArr = $(this).attr('data-ageFcal').split('|;|');
			var birth_d = '', ageFloat = '', birthMonths = '', diffDNum = 0;
			var objName_ageFcal = ( ageFcalArr[0] && ageFcalArr[1] ) ? ageFcalArr[1] : '' ;
			var ageMonth, birthWeek = "";

			if(ageFcalArr[2] && ageFcalArr[3]){
				if(ageFcalArr[4]){
					var birth_d = $("#"+ageFcalArr[4]).val();
				}else{
					var birth_d = $("#"+ageFcalArr[2]+"_date_y").val() + "-" + $("#"+ageFcalArr[2]+"_date_m").val() + "-" + $("#"+ageFcalArr[2]+"_date_d").val();	
				}
				chk_d = _year + "-" + _month + "-" + _day;
			}else{
				if(_name == 'birth'){
					birth_d = _year + "-" + _month + "-" + _day;
					// enter-k만 있는 진단 일자 선택때문에 이 부분이 수정됨
					// var chk_d = today_year + "-" + today_month + "-" + today_date;
					var chk_d = "";
					var check_radio = $('input[name=Dx]:checked').val();
					chk_d = $("#Dx_d"+check_radio+"_date_y").val()+"-"+$("#Dx_d"+check_radio+"_date_m").val()+"-"+$("#Dx_d"+check_radio+"_date_d").val();
				}else{
					var chk_d =  _year + "-" + _month + "-" + _day;
					birth_d = $("#DBbirth").val();
				}

			}

			console.log ( "2._name: " + _name + " / objName_ageFcal: " + objName_ageFcal + " / birth_d: " + birth_d + " / chk_d: " + chk_d );
			if (isValidDate(chk_d) && isValidDate(birth_d)) {
			//	console.log ( age_FloatCal_fun (birth_d, chk_d, 'Y') + '(연 기준) / ' + age_FloatCal_fun (birth_d, chk_d, 'M') + '(월 기준) / ' + age_FloatCal_fun (birth_d, chk_d, 'D') + '(일 기준)' );
				ageFloat = age_FloatCal_fun (birth_d, chk_d, ageFcalArr[0]);
				diffDNum = datetime_diff_fun (birth_d, chk_d);
				birthMonths = parseInt(diffDNum / 30.417);
				birthWeek = parseInt(diffDNum/7);
			//	console.log ( '출생개월수 : ' + birthMonths + '(diffDNum='+diffDNum+')' );
			}

			if(ageFcalArr[3]){
				if($("#"+ageFcalArr[3]).val() == ""){
					$("#"+ageFcalArr[3]).val(ageFloat);	
				}
			}else{
				$("#"+objName_ageFcal+"age").val(ageFloat);	
			}
			
			
				
			
			
		}
		
		var diffSD, diffED, diffDays_ObjName, calMDnum, diffDays;
		//기간(days - diffSDcal) 계산 [공통]
		if ( _input_date && $(this).attr('data-diffSDcal') ) {
			var diffSDcalArr = $(this).attr('data-diffSDcal').split('|;|');
			console.log ( "_name: " + _name + " / diffSDcalArr: " + diffSDcalArr );
			diffSD = ( $("#DB"+diffSDcalArr[0]).val() ) ? $("#DB"+diffSDcalArr[0]).val() : $("#"+diffSDcalArr[0]+"_date_y").val() + "-" + $("#"+diffSDcalArr[0]+"_date_m").val() + "-" + $("#"+diffSDcalArr[0]+"_date_d").val();
			diffED = _year + "-" + _month + "-" + _day;
			diffDays_Type = diffSDcalArr[1];
			diffDays_ObjName = diffSDcalArr[2];
			diffDays_Change = diffSDcalArr[3];
			console.log ( "diffSD: " + diffSD + " / diffED: " + diffED + " / diffDays_Type: " + diffDays_Type + " / diffDays_ObjName: " + diffDays_ObjName );
			diffDays = '';
			if (diffSD.replace('--','') && diffED.replace('--','')) {
				if(diffDays_Change == "Y"){
					diffDays = datetime_diff_fun (diffED, diffSD);
				}else{
					diffDays = datetime_diff_fun (diffSD, diffED);	
				}
				
			}
			if (diffDays_Type == 'D') {
				$("#"+diffDays_ObjName).val(diffDays);
				choose_day();
			} else {
				if (diffDays) {
					calMDnum = diffDays_Type.replace(/[^0-9]/g,"");
				console.log ( "diffDays: " + diffDays + " / calMDnum: " + calMDnum + " / 나누기: " + parseInt(diffDays / calMDnum) + " / 몫: " + (diffDays % calMDnum) );
					$("#"+diffDays_ObjName+"m").val( parseInt(diffDays / calMDnum) );
					$("#"+diffDays_ObjName+"d").val( (diffDays % calMDnum) );
				} else {
					$("#"+diffDays_ObjName+"m").val("");
					$("#"+diffDays_ObjName+"d").val("");
				}
			}
		}
	});

	$('.datepickerY, .datepickerM, .datepickerD, .datepickerH').on('keyup', function() {
		var text = $(this).val();
		if($(this).hasClass('datepickerY')){
			var _name = $(this).attr('name').replace('_date_y','');
			if (text.length == 4) {
				$('input[name='+_name+'_date_m]').focus();
			}
		}
		if($(this).hasClass('datepickerM')){
			var _name = $(this).attr('name').replace('_date_m','');
			if (text.length == 2) {
				$('input[name='+_name+'_date_d]').focus();
			}
		}
		if($(this).hasClass('datepickerD')){
			var _name = $(this).attr('name').replace('_date_d','');
			if ($('input[name='+_name+'_date_h]') && text.length == 2) {
				$('input[name='+_name+'_date_h]').focus();
			}
		}
		if($(this).hasClass('datepickerH')){
			var _name = $(this).attr('name').replace('_date_h','');
			if (text.length == 2) {
				$('input[name='+_name+'_date_i]').focus();
			}
		}
	});

	$('.chkTimeH, .chkTimeMI').on('blur', function() {
		if($(this).hasClass('chkTimeH')){
			if ($(this).val()) {
				var chkNum = parseInt($(this).val());
				if (chkNum < 0 || chkNum > 23) {
					alert("유효한 시간이 아닙니다.");
					$(this).val('');
					$(this).focus();
					return false;
				} else {
					$(this).val(numberPad(chkNum,2));
				}
			}
		}
		if($(this).hasClass('chkTimeMI')){
			if ($(this).val()) {
				var chkNum = parseInt($(this).val());
				if (chkNum < 0 || chkNum > 59) {
					alert("유효한 시간이 아닙니다.");
					$(this).val('');
					$(this).focus();
					return false;
				} else {
					$(this).val(numberPad(chkNum,2));
				}
			}
		}
	});

	$('.chkTimeH, .chkTimeMI').on('keyup', function() {
		var text = $(this).val();
		if($(this).hasClass('chkTimeH')){
			var _name = $(this).attr('name').replace('_t_h','_t');
			if (text.length == 2) {
				$('input[name='+_name+'_t_mi]').focus();
			}
		}
	});

	$( "#member_frm" ).submit(function( event ) {
		if (!$('#org').val()) {
			alert("기관을 선택하여주세요.");
			$('#org').focus();
			return false;
		}
		if ($('#passwd').val()) {
			if (!$('#passwd_re').val()) {
				alert("Password 확인을 입력하여주세요.");
				$('#passwd_re').focus();
				return false;
			}
			if ($('#passwd').val() != $('#passwd_re').val()) {
				alert("Password와 Password 확인이 동일하지 않습니다.\n다시 입력하여주세요.");
				$('#passwd_re').focus();
				return false;
			}
		}
		if (!$('#id').val()) {
			alert("아이디를 입력하여주세요.");
			$('#id').focus();
			return false;
		}
		if (!$('#tel').val() && !$('#mobile').val()) {
			alert("전화번호 또는 휴대번호를 입력하여주세요.");
			$('#tel').focus();
			return false;
		}
		if (!$('#email').val()) {
			alert("이메일을 입력하여주세요.");
			$('#email').focus();
			return false;
		}
		if (!$('input[name=email_yn]:checked').val()) {
			alert("이메일 수신여부를 선택하여주세요.");
			$('input[name=email_yn]').focus();
			return false;
		}
		if ($('#adminChk').val() == 'Y') {
			if (!$('input[name=member_level]:checked').val()) {
				alert("등급을 선택하여주세요.");
				$('input[name=member_level]').focus();
				return false;
			}
		}
	});

	$("form:not('#searchform, #bbs_searchF, #login_form')").find('input, select').keydown(function (event) {
		// if (event.keyCode == '13') {
		// 	console.log('dddddddddddddd');
		// 	if (window.event) {
		// 		event.preventDefault();
		// 		return;
		// 	}
		// }
	});
});

// DOM 이 모두 로드 되었을 때 실행
jQuery(function($) {
	jQuery(function(a){a.datepicker.regional.ko={closeText:"닫기",prevText:"이전달",nextText:"다음달",currentText:"오늘",monthNames:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],monthNamesShort:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],dayNames:["일","월","화","수","목","금","토"],dayNamesShort:["일","월","화","수","목","금","토"],dayNamesMin:["일","월","화","수","목","금","토"],weekHeader:"Wk",dateFormat:"yy-mm-dd",firstDay:0,isRTL:false,showMonthAfterYear:false,yearSuffix:"년"};a.datepicker.setDefaults(a.datepicker.regional.ko)});
	$('.sp_datepicker').datepicker({
		inline: true,
		dateFormat: "yy-mm-dd",
		prevText: 'prev',
		nextText: 'next',
		showButtonPanel: true,    /* 버튼 패널 사용 */
		changeMonth: true,
		changeYear: true,
		showOtherMonths: true,
		selectOtherMonths: true,
		showOn: "button",
		buttonImage: "/image/icon/ic_cal.png",
		buttonImageOnly: true,
		closeText: '닫기',
		currentText: '오늘',
		showMonthAfterYear: true,
		/* 한글화 */
		monthNames : ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
		monthNamesShort : ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
		dayNames : ['일', '월', '화', '수', '목', '금', '토'],
		dayNamesShort : ['일', '월', '화', '수', '목', '금', '토'],
		dayNamesMin : ['일', '월', '화', '수', '목', '금', '토'],
		showAnim: 'slideDown',
		yearRange: '-99:+5',
		maxDate: 0,
		// 일자 선택되기전 이벤트 발생  
		beforeShow: function (input, inst) {
			idx = $('.sp_datepicker').index($(this));
			if($('.datepickerY').eq(idx).is(':disabled')) return false;
		},
		/* 일자 선택후 이벤트 발생 */
		onSelect: function ( selectedDate ) {
		},
		/* 날짜 유효성 체크 */
		onClose: function( selectedDate ) {
			if(selectedDate != "") {
				selectedDate = selectedDate.split('-');
				idx = $('.sp_datepicker').index($(this));
				if($(this).attr('name') == "Dx_d1") {
					idx++;
				}
				$('.datepickerY').eq(idx).val(selectedDate[0]);
				$('.datepickerM').eq(idx).val(selectedDate[1]);
				$('.datepickerD').eq(idx).val(selectedDate[2]);
				
				if ($('.datepickerY').eq(idx).attr('name')) {
					var _name = $('.datepickerY').eq(idx).attr('name').replace('_date_y','');
				} else {
					var _name = $('.datepickerY').eq(idx).attr('name');
				}

				var _year = selectedDate[0];
				var _month = selectedDate[1];
				var _day = selectedDate[2];
				var checkdate = _year+'-'+_month+'-'+_day;
				var today = new Date();
				var today_year = today.getFullYear();
				var today_month = today.getMonth()+1;
				var today_date = today.getDate();
				// 뭐야 글자 길이 왜 return 안해
				if (today_month.toString().length == 1) {
					today_month = '0'+String(today_month);
				}
				if (today_date.toString().length == 1) {
					today_date = '0'+today_date;
				}
				var ageFcal = $('.datepickerY').eq(idx).attr('data-ageFcal');
				var diffSDcal = $('.datepickerY').eq(idx).attr('data-diffSDcal');
				var diffEDcal = $('.datepickerY').eq(idx).attr('data-diffEDcal');
				var diffDatecal = $('.datepickerY').eq(idx).attr('data-diffDatecal');


				var date_arr_chk = ( $("#DateArr") ) ? $("#DateArr").val() : "";
				if (date_arr_chk) {
					let chk_name_arr = ["consf_d", "gsf_d", "ttf_d", "vmf_d", "omf_d"];
					var dateArr = $("#DateArr").val().split('|;|');

					if(chk_name_arr.indexOf(_name) !== -1){
						$(dateArr).each(function(dt) {
							if (checkdate == dateArr[dt]) {
								alert("이미 등록된 날짜 입니다.");
								$('input[name='+_name+'_date_y]').val('');
								$('input[name='+_name+'_date_m]').val('');
								$('input[name='+_name+'_date_d]').val('');
								return false;
							}
						});
					}
				}

				// console.log('_name = '+_name);

				//나이(소수점 처리) 계산 [공통]
				if ( selectedDate && ageFcal ) {
					var ageFcalArr = ageFcal.split('|;|');
					var ageFloat = '', birthMonths = '', diffDNum = 0;
					var objName_ageFcal = ( ageFcalArr[0] && ageFcalArr[1] ) ? ageFcalArr[1] : '' ;
					var ageMonth, birthWeek = "";

					if(ageFcalArr[2]){
						if(ageFcalArr[4]){
							var chk_d = $("#"+ageFcalArr[4]).val();
						}else{
							var chk_d = $("#"+ageFcalArr[2]+"_date_y").val() + "-" + $("#"+ageFcalArr[2]+"_date_m").val() + "-" + $("#"+ageFcalArr[2]+"_date_d").val();	
						}
						// var chk_d = $("#"+ageFcalArr[2]+"_date_y").val() + "-" + $("#"+ageFcalArr[2]+"_date_m").val() + "-"+ $("#"+ageFcalArr[2]+"_date_d").val();
						birth_d = _year + "-" + _month + "-" + _day;
						console.log("789 789  chk_d = "+chk_d);
						
						console.log('birth_d = '+birth_d);

						if($(this).attr('name').match(/^f[2-9]\d*_last_opd_d$/)){
							chk_d = $("#DBf1_opd_d").val();
						}

						console.log("456 456 chk_d = "+chk_d);
					}else{
						if(_name == 'birth'){
							birth_d = _year + "-" + _month + "-" + _day;
							// enter-k만 있는 진단 일자 선택때문에 이 부분이 수정됨
							// var chk_d = today_year + "-" + today_month + "-" + today_date;
							var chk_d = "";
							var check_radio = $('input[name=Dx]:checked').val();
							chk_d = $("#Dx_d"+check_radio+"_date_y").val()+"-"+$("#Dx_d"+check_radio+"_date_m").val()+"-"+$("#Dx_d"+check_radio+"_date_d").val();
							console.log('222222222222222');
						}else {
							var chk_d = _year + "-" + _month + "-" + _day;
							birth_d = $("#DBbirth").val();
							console.log('33333333333333');
						}	
					}


					console.log('123123 birth_d = '+birth_d);

					console.log ( "3._name: " + _name + " / objName_ageFcal: " + objName_ageFcal + " / birth_d: " + birth_d + " / chk_d: " + chk_d );
					if (isValidDate(chk_d) && isValidDate(birth_d)) {
					//	console.log ( age_FloatCal_fun (birth_d, chk_d, 'Y') + '(연 기준) / ' + age_FloatCal_fun (birth_d, chk_d, 'M') + '(월 기준) / ' + age_FloatCal_fun (birth_d, chk_d, 'D') + '(일 기준)' );
						ageFloat = age_FloatCal_fun (chk_d, birth_d, ageFcalArr[0]);

						diffDNum = datetime_diff_fun (birth_d, chk_d);
						birthMonths = parseInt(diffDNum / 30.417);
						birthWeek = parseInt(diffDNum/7);
					//	console.log ( '출생개월수 : ' + birthMonths + '(diffDNum='+diffDNum+')' );
						console.log("diffDNum = "+diffDNum);
					}

					if(ageFcalArr[3]){
						console.log("ccccccccc");
						console.log(ageFcalArr[3]);
						console.log(ageFloat);
						console.log(chk_d);
						console.log(birth_d);
						
						$("#"+ageFcalArr[3]).val(ageFloat);
					}else{
						$("#"+objName_ageFcal+"age").val(ageFloat);	
					}
					
				}

				var diffSD, diffED, diffDays_ObjName, calMDnum, diffDays;
				//기간(days - diffSDcal) 계산 [공통]
				if ( selectedDate && diffSDcal ) {
					var diffSDcalArr = (diffSDcal) ? diffSDcal.split('|;|') : '';
					console.log ( "_name: " + _name + " / diffSDcalArr: " + diffSDcalArr );
					diffSD = ( $("#DB"+diffSDcalArr[0]).val() ) ? $("#DB"+diffSDcalArr[0]).val() : $("#"+diffSDcalArr[0]+"_date_y").val() + "-" + $("#"+diffSDcalArr[0]+"_date_m").val() + "-" + $("#"+diffSDcalArr[0]+"_date_d").val();
					diffED = _year + "-" + _month + "-" + _day;
					diffDays_Type = diffSDcalArr[1];
					diffDays_ObjName = diffSDcalArr[2];
					diffDays_Change = diffSDcalArr[3];
					console.log ( "diffSD: " + diffSD + " / diffED: " + diffED + " / diffDays_Type: " + diffDays_Type + " / diffDays_ObjName: " + diffDays_ObjName );
					diffDays = '';
					if (diffSD.replace('--','') && diffED.replace('--','')) {
						if(diffDays_Change =="Y"){
							diffDays = datetime_diff_fun (diffED, diffSD);
						}else{
							diffDays = datetime_diff_fun (diffSD, diffED);	
						}
						
					}
					if (diffDays_Type == 'D') {
						$("#"+diffDays_ObjName).val(diffDays);
						choose_day();
					} else {
						if (diffDays) {
							calMDnum = diffDays_Type.replace(/[^0-9]/g,"");
						console.log ( "diffDays: " + diffDays + " / calMDnum: " + calMDnum + " / 나누기: " + parseInt(diffDays / calMDnum) + " / 몫: " + (diffDays % calMDnum) );
							$("#"+diffDays_ObjName+"m").val( parseInt(diffDays / calMDnum) );
							$("#"+diffDays_ObjName+"d").val( (diffDays % calMDnum) );
						} else {
							$("#"+diffDays_ObjName+"m").val("");
							$("#"+diffDays_ObjName+"d").val("");
						}
					}
				}



				//기간(days - diffEDcal) 계산 [공통]
				/*if ( selectedDate && diffEDcal ) {
					var diffEDcalArr = (diffEDcal) ? diffEDcal.split('|;|') : '';
					console.log ( "_name: " + _name + " / diffSDcalArr: " + diffSDcalArr + " / diffEDcalArr: " + diffEDcalArr );
					if (diffEDcalArr[0].indexOf('||') != -1) {	// 다중 계산일 경우
						var diffEDcalArr_arr = diffEDcalArr[0].split('||');
						$( diffEDcalArr_arr ).each(function(i) {
							diffSD = _year + "-" + _month + "-" + _day;
							diffED = ( $("#DB"+diffEDcalArr_arr[i]).val() ) ? $("#DB"+diffEDcalArr_arr[i]).val() : $("#"+diffEDcalArr_arr[i]+"_date_y").val() + "-" + $("#"+diffEDcalArr_arr[i]+"_date_m").val() + "-" + $("#"+diffEDcalArr_arr[i]+"_date_d").val();
							diffDays_ObjName = diffEDcalArr[1].split('||')[i];
							console.log ( "diffSD"+i+": " + diffSD + " / diffED"+i+": " + diffED + " / diffDays_ObjName"+i+": " + diffDays_ObjName );
							diffDays = '';
							if (diffSD.replace('--','') && diffED.replace('--','')) diffDays = datetime_diff_fun (diffSD, diffED);
							$("#"+diffDays_ObjName).val(diffDays);
						});
					} else {
						diffSD = _year + "-" + _month + "-" + _day;
						diffED = ( $("#DB"+diffEDcalArr[0]).val() ) ? $("#DB"+diffEDcalArr[0]).val() : $("#"+diffEDcalArr[0]+"_date_y").val() + "-" + $("#"+diffEDcalArr[0]+"_date_m").val() + "-" + $("#"+diffEDcalArr[0]+"_date_d").val();
						diffDays_ObjName = diffEDcalArr[1];
						console.log ( "diffSD: " + diffSD + " / diffED: " + diffED + " / diffDays_ObjName: " + diffDays_ObjName );
						diffDays = '';
						if (diffSD.replace('--','') && diffED.replace('--','')) diffDays = datetime_diff_fun (diffSD, diffED);
						$("#"+diffDays_ObjName).val(diffDays);
					}
				}

				if (selectedDate && _name == 'birth') {
					var birthday = new Date(checkdate);
					var today = new Date();
					var years = today.getFullYear() - birthday.getFullYear();

					birthday.setFullYear(today.getFullYear());
					if (today < birthday) years--;

					$("#age").val(years);
				}*/

				//checked_db_fun (_name);

				//DB 입력상태 필드 배열 지정 (삭제불가)
				if ($(".ESS_CHK").length > 0) {
					setTimeout("status_obj_naming_fun()", 100); 
					setTimeout("ESS_CHK_fun()", 100); 
				}

			}
		}
	});

	$('.dtPicker').datepicker({
		showMonthAfterYear:true, 
		showOn:"button", 
		buttonImage:"/image/icon/ic_cal.png",
		buttonImageOnly:true, 
		changeMonth: true, 
		changeYear: true, 
		yearRange: "-99:+2", 
		dateFormat: "yy-mm-dd", 
		onSelect:function(dateText) {
		} 
	});


	jQuery(".ui-datepicker-trigger").css('margin-left','10px');
	$.datepicker._gotoToday = function(id) { 
		$(id).datepicker('setDate', new Date()).datepicker('hide').blur(); 
	};


	$(".searchText").each(function(index) {
		var objId = $(this).attr("id");
		var incurable = $("#incurable").val();
		$( "#"+objId ).autocomplete({
			minLength: 1,
			autoFocus : false,
			source : function(request, response) {
					$.ajax({
								url : "/regist/autoSearch.php"
							, type : "POST"
							, data : {search_word : $( "#"+objId ).val(), mode : "1"} // 검색 키워드
							, success : function(data){ // 성공
									response(
											$.map(JSON.parse(data), function(item) {
												if (item.answer) {
													return {
																valAnswer : item.valAnswer
															, answer : item.answer
													};
												}
											})
									);    //response
							}
							,
							error : function(){ //실패
									alert("통신에 실패했습니다.");
							}
					});
			},
			open: function(event, ui) {
					$(this).autocomplete("widget").css({
							"max-width": 750,
							"overflow-x":'hidden',
							"overflow-y":'auto',
							"padding-right":30,
							"max-height":350
					});
			},
			focus: function( event, ui ) {
				// console.log("ui = ");
				// console.log(ui);
				// $( "#"+objId ).val( ui.item.answer );
				return false;
			},
			select: function( event, ui ) {


				var incurable = $("#incurable").val();
				var expl_arr = incurable.split("|;|");
				if(incurable == ""){
					incurable = ui.item.valAnswer;
				}else{
					incurable += "|;|"+ui.item.valAnswer;
				}

				
				console.log("expl_arr = ");
				console.log(expl_arr);
				console.log("valAnswer = ");
				console.log(ui.item.valAnswer);
				if(expl_arr.includes(ui.item.valAnswer) == true){
					alert('이미 추가된 병명 입니다.');
					return false;
				}

				var append_tag = "<p id='del_selector_"+ui.item.valAnswer+"'>- "+ui.item.answer+"<img src=\"/image/icon/ic_del2.png\" class='hand del_assessment' data-name=\""+ui.item.answer+"\" data-valanswer=\""+ui.item.valAnswer+"\"></p>";
				$("#incurable").val(incurable);
				$(".added_area").append(append_tag);

			},
			close : function(event) {
				return false;
			}


		}).autocomplete( "instance" )._renderItem = function( ul, item ) {
			var summaryTxt = ( item.summary ) ? "<br><p class='lm20'>" + item.summary + "</p>" : "";
			return $( "<li class='fwNormal' style='margin:10px;'>" )
				.append( "<span class='fwBold'>" + item.answer + "</span>" )
				.append( summaryTxt )
				.appendTo( ul );

		};


	});






	$(document).on('keyup, blur', '.onlyd2number', function() {
		var inputText = $(this).val();
        var numberOnly = inputText.replace(/\D/g, ''); // 숫자만 추출

        if (numberOnly.length === 1) {
            numberOnly = '0' + numberOnly;
        }

		$(this).val(numberOnly);
	});

	$(document).on('keyup', '.onlynumber', function() {
		if ($(this).attr('name').indexOf('date_') == -1) {
			$(this).val( $(this).val().replace(/[^-.0-9]/g,"") );
		} else {	//일자 항목은 소수점(.) 입력 제한
			$(this).val( $(this).val().replace(/[^0-9]/g,"") );
		}
	});
	$(document).on('blur', '.onlynumber', function() {
		var _id = $(this).attr('id');
		if ($(this).val() == ".") $(this).val('');
		if ($(this).val()) {
			var num = parseFloat( $(this).val() );
			if (_id == 'v1_height' || _id == 'v1_weight') {
				decimal_arr = $(this).val().split('.');
				if (decimal_arr[1].length > 1) {
					alert("소수점 1자리까지만 입력이 가능합니다.");
					$(this).val( decimal_arr[0]+'.'+decimal_arr[1].substring(0,1) );
				}
			} else if ($(this).attr('name').indexOf('date_') == -1) {
				//일자 항목 제외
				$(this).val(num);
			//	checked_db_fun (_id);
			}
		}
	});

	$(document).on('blur', '.bmiCal_h, .bmiCal_w', function() {
		var bmiCal = "";
		var target = $(this).data('tgbmi');

		if(target == undefined){
			var h = $('.bmiCal_h').val();
			var w = $('.bmiCal_w').val();

			var target_tag = ".bmiCal";
		}else{
			var h_tag = $(this).data('tgh');
			var w_tag = $(this).data('tgw');

			var h = $("#"+h_tag).val();
			var w = $("#"+w_tag).val();

			var target_tag = "#"+target;
		}
		if (h && w) {
			bmiCal = bmiCal_fun (h, w);
		}
		$(target_tag).val( bmiCal );
	});

	$(".help_btn").each(function(index) {
		$(this).mouseover(function() {
			$(".help_div:eq(" + index + ")").css("display", "block");
		});
		$(this).mouseout(function() {
			$(".help_div:eq(" + index + ")").css("display", "none");
		});
	});

	$("input[name='subTab']").each(function() {
		if ( $(this).val() == '1' && $(this).is(":checked") ) {
			$("div.formArea").addClass("withMenu");
			$(".btnDel").show();
		} else {
			$("div.formArea").removeClass("withMenu");
			$(".btnDel").hide();
		}
	});

	$("input[name='subTab']").on('click', function() {
		if ( $(this).val() == '1' ) {
			$("div.formArea").addClass("withMenu");
			$(".btnDel").show();
		} else {
			$("div.formArea").removeClass("withMenu");
			$(".btnDel").hide();
		}
		if ( $(this).is(":checked") ) {
			$('.subTab_col').val( $(this).val() );
		} else {
			$('.subTab_col').val('');
		}
	});

});

// 만 나이 계산 (소수점화)
function age_FloatCal_fun (bDT, chkDT, calType) {	//YYYY-MM-DD [calType : Y=(일수 / 365일), M=개월(일수 버림), D=일수]
	var diffNum = 0;	//calType : M = 개월수 / D = 일수
	var ageCal = "";
	console.log("calType = "+calType);
	if (isValidDate(bDT) && isValidDate(chkDT)) {
		if (calType == 'Y') {
			diffNum = datetime_diff_fun (bDT, chkDT);
			ageCal = parseFloat(diffNum / 365).toFixed(1);
		} else if (calType == 'W') {
			diffNum = datetime_diff_fun (bDT, chkDT);
			ageCal = parseFloat(diffNum / 7).toFixed(1);
		} else if (calType == 'M') {
			diffNum = ((parseInt(chkDT.split('-')[0]) - parseInt(bDT.split('-')[0])) * 12) + (parseInt(chkDT.split('-')[1]) - parseInt(bDT.split('-')[1]));
			// console.log("diffNum = "+diffNum);
			// console.log("chkDT = "+chkDT);
			// console.log("bDT = "+bDT);
			// ageCal = parseFloat(diffNum / 12).toFixed(1);
			ageCal = diffNum;
		} else if (calType == 'D') {
			ageCal = parseFloat( datetime_diff_fun (bDT, chkDT) ).toFixed(1);
		}
	}
	return ageCal;
}

//BMI 자동계산
function bmiCal_fun (ht, wt) {	//YYYY-MM-DD [calType : D=일수 (365일 기준) / M=개월(일수 버림)]
	var b = "";
	var h, w;
	//console.log(h + " : " + w);
	if (ht && wt) {
		h = parseFloat(ht);
		w = parseFloat(wt);
		b = w / (h * 0.01 * h * 0.01);
	//	console.log(h + " : " + w + " = " + b);
		b = b.toFixed(3);
	}
	return b;
}

//z-Score 출력
function zScore_fun (sexNum, bMonthNum, hNum, wNum, bNum) {	//성별, 개월수, 키, 체중, BMI
	if (sexNum && bMonthNum) {
		$.ajax({
			type: "POST",
			url: "./include.ajax.zScore.php",
			data: "sexNum="+sexNum+"&bMonthNum="+bMonthNum+"&hNum="+hNum+"&wNum="+wNum+"&bNum="+bNum,
			success: function(data){
				console.log( data );
				$.map(data, function(item) {
					$('.zScore_h').val( item.zScore_h );
					$('.zScore_w').val( item.zScore_w );
					$('.zScore_b').val( item.zScore_b );
					if (item.zScore_b) {
						$('.zScore_b').css('background-color','');
					} else {
						$('.zScore_b').css('background-color','#ccc');
					}
				});
			}, 
			error: function(xhr, option, error){
		//	alert(xhr.status); //오류코드
		//	alert(error); //오류내용
			}
		});
	}
}

function isValidDate(param) {
	try
	{
		// --이 없을 경우
		if (param.replace(/[^-]/gi,'') != '--') {
			return false;
		}

		param = param.replace(/-/g,'');

		// 자리수가 맞지않을때
		if( isNaN(param) || param.length!=8 ) {
			return false;
		}

		var year = Number(param.substring(0, 4));
		var month = Number(param.substring(4, 6));
		var day = Number(param.substring(6, 8));

		var dd = day / 0;


		if( month<1 || month>12 ) {
			return false;
		}

		var maxDaysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		var maxDay = maxDaysInMonth[month-1];

		// 윤년 체크
		if( month==2 && ( year%4==0 && year%100!=0 || year%400==0 ) ) {
			maxDay = 29;
		}

		if( day<=0 || day>maxDay ) {
			return false;
		}
		return true;

	} catch (err) {
		return false;
	}
}

function getTodate () {
	var date = new Date();
	return date.getFullYear() + "-" + ("0"+(date.getMonth()+1)).slice(-2) + "-" + ("0"+date.getDate()).slice(-2);
}

function dateAdd(sDate, v, t) {
	var yy = parseInt(sDate.substr(0, 4), 10);
	var mm = parseInt(sDate.substr(5, 2), 10);
	var dd = parseInt(sDate.substr(8), 10);

	if(t == "D"){
		d = new Date(yy, mm - 1, dd + v);
	}else if(t == "M"){
		d = new Date(yy, mm - 1 + v, dd);
	}else if(t == "Y"){
		d = new Date(yy + v, mm - 1, dd);
	}else{
		d = new Date(yy, mm - 1, dd + v);
	}

	yy = d.getFullYear();
	mm = d.getMonth() + 1; mm = (mm < 10) ? '0' + mm : mm;
	dd = d.getDate(); dd = (dd < 10) ? '0' + dd : dd;

	return '' + yy + '-' +  mm  + '-' + dd;
}

function datetime_diff_fun (S_DT, E_DT) {	//YYYY-MM-DD 또는 YYYY-MM-DD-HH-MI 형으로 입력 받음
	if (!(S_DT && E_DT)) return false;	//시작일과 종료일 없을 경우 함수 중지
	//alert(S_DT+" : " + E_DT + " / " + S_DT.length +" : " + E_DT.length );
	var S_DT_arr	= S_DT.replace(' ','-').replace(':','-').split('-');
	var E_DT_arr	= E_DT.replace(' ','-').replace(':','-').split('-');
	if ((S_DT.length == 10 && E_DT.length == 10) || (S_DT.length == 16 && E_DT.length == 10) || (S_DT.length == 10 && E_DT.length == 16)) {
	//	alert(S_DT.length +" : " + E_DT.length );
	//	alert(S_DT_arr[0]+'-'+S_DT_arr[1]+'-'+S_DT_arr[2]+" : " + E_DT_arr[0]+'-'+E_DT_arr[1]+'-'+E_DT_arr[2]);
		if (!isValidDate(S_DT_arr[0]+'-'+S_DT_arr[1]+'-'+S_DT_arr[2])) return false;
		if (!isValidDate(E_DT_arr[0]+'-'+E_DT_arr[1]+'-'+E_DT_arr[2])) return false;
		var sDate		= new Date(S_DT_arr[0], S_DT_arr[1]-1, S_DT_arr[2]).valueOf();
		var eDate		= new Date(E_DT_arr[0], E_DT_arr[1]-1, E_DT_arr[2]).valueOf();
		//getDate 0~11 배열임 0 / 1월 따라서 5->6월이 나와 오류가 출력 / 월은 -1를 해야 정상적인 값 출력
		var in_date = (eDate - sDate)/1000/60/60/24;	//일 출력
	//	in_date += 1;	//당일일 수 있기에 1일 추가
	} else if (S_DT.length == 16 && E_DT.length == 16) {
	//	alert(S_DT.length +" : " + E_DT.length );
		if (Number(E_DT_arr[3]) < 0 || Number(E_DT_arr[3]) > 23) {
			alert('시간(시)을 올바르게 입력하여주세요.\n(24시의 경우 다음날 00시로 입력)');
			return false
		}
		if (Number(E_DT_arr[4]) < 0 || Number(E_DT_arr[4]) > 59) {
			alert('시간(분)을 올바르게 입력하여주세요.\n(60분의 경우 +1:00로 입력)');
			return false
		}
		sDateTime = new Date(S_DT_arr[0], S_DT_arr[1]-1, S_DT_arr[2], S_DT_arr[3], S_DT_arr[4], 00);
		eDateTime = new Date(E_DT_arr[0], E_DT_arr[1]-1, E_DT_arr[2], E_DT_arr[3], E_DT_arr[4], 00);
		//getDate 0~11 배열임 0 / 1월 따라서 5->6월이 나와 오류가 출력 / 월은 -1를 해야 정상적인 값 출력
		var in_date = (eDateTime - sDateTime)/1000/60;	//분 출력
	} else {
	//	alert('날짜 또는 시간을 확인해주세요.');
		return false;
	}
	//console.log(E_DT + " - " + S_DT + " = " + in_date);

	return in_date;
}

function ToFloat(number){
	var tmp = number + "";
	if(tmp.indexOf(".") != -1){
		number = number.toFixed(4);
		number = number.replace(/(0+$)/, "");
	}
	return number;
}

function numberPad(n, width) {
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join('0') + n;
}

function pop_audit (regist_num, gubun, tbl, step_num) {
	window.open('/include/pop_audit.asp?regist_num='+regist_num+'&gubun='+gubun+'&tbl='+tbl+'&step_num='+step_num,'Audit','width=1000,height=700,scrollbars=yes');
}

/*function win_open(url,window_name,width,height,scroll){
	var top_center = screen.availHeight/2-300;
	var left_center = screen.availWidth/2-250;
	window.open(url,window_name,"width="+width+",height="+height+",scrollbars="+scroll+",status=no,resizable=no, top="+top_center+", left="+left_center+"");
}*/

function win_open(url,width,height,scroll){
  window.open(url,"","width="+width+",height="+height+",scrollbars="+scroll+",status=no,resizable=no, top=0, left=0");
}

function daumPostcode(postcode, address, address2) {
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
				fullAddr = data.roadAddress;

			} else { // 사용자가 지번 주소를 선택했을 경우(J)
				fullAddr = data.jibunAddress;
			}

			// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			$("#" + postcode).val(data.zonecode);
			$("#" + address).val(fullAddr);

			// 커서를 상세주소 필드로 이동한다.
			$("#" + address2).focus();
		}
	}).open();
}

function popup_getCookie( name )
	{
			var nameOfCookie = name + "=";
			var x = 0;
			while ( x <= document.cookie.length )
			{
							var y = (x+nameOfCookie.length);
							if ( document.cookie.substring( x, y ) == nameOfCookie ) {
											if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
															endOfCookie = document.cookie.length;
											return unescape( document.cookie.substring( y, endOfCookie ) );
							}
							x = document.cookie.indexOf( " ", x ) + 1;
							if ( x == 0 )
											break;
			}
			return "";
}

function mem_delete_fun (sid, page, sfield, search) {
	if(confirm('삭제하시겠습니까?\n\n삭제 후 되돌릴 수 없습니다.')) {
		location.href='/admin/member/mem_proc.asp?mode=del&sid='+sid+'&sfield='+sfield+'&search='+search+'&page='+page;
	}
}

function mem_level_fun (sid, page, sfield, search, check) {
	if(confirm('등급을 수정하시겠습니까?')) {
		location.href='/admin/member/mem_proc.asp?mode=level&check='+check+'&sid='+sid+'&sfield='+sfield+'&search='+search+'&page='+page;
	}
}


function popupOpen(popupID) {
		checkUnload = false;
		$('#'+popupID).show();
}

function popupClose() {
	$('.layerPopup').find('input[type=checkbox], input[type=radio]').prop("checked", false);
	$('.layerPopup').find('input[type=text], textarea, select').val('');
	$('.layerPopup').find('.disabled_IDchk').each(function() {
		var obj_name = $(this).attr("id") + "_view";
		if ($(this).is(':disabled')==false && $(this).is(':visible') == true && $(this).is(":checked") == true) {
			$('.'+obj_name).find('input, textarea, select').attr('disabled',false);
			$('.'+obj_name).find('input[type=text], textarea, select').css('background-color','#fff');
		} else {
			$('.'+obj_name).find('input, textarea, select').attr('disabled',true);
			$('.'+obj_name).find('input[type=text], textarea, select').css('background-color','#ccc');
		}
	});
	$('.layerPopup').hide();
}