"use strict";

let loginHoldingTime = moment().add(30, 'minutes').format('YYYY-MM-DD HH:mm:ss'); // 로그인 유지시간
let timerInterval;

$(function () {
    if ($('form').length > 0) {
        $('form[method=post]').attr('onsubmit', 'return false;');
    }

    if ($('input:text[datepicker]').length > 0) {
        callDatePicker();
    }

    if ($('input:text[datetimepicker]').length > 0) {
        callDateTimePicker();
    }

    if ($('.target-datepicker').length > 0) {
        callTargetDatePicker();
    }

    if ($('.target-datetimepicker').length > 0) {
        callTargetDateTimePicker();
    }

    if ($('.target-replace-datepicker').length > 0) {
        callTargetReplaceDatePicker();
    }
});

// ajax Setup
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// window popup
$(document).on('click', '.call-popup', function (e) {
    e.preventDefault();

    const popupHeight = isEmpty($(this).data('height')) ? 700 : $(this).data('height');
    const popupWidth = isEmpty($(this).data('width')) ? 500 : $(this).data('width');
    const popName = isEmpty($(this).data('name')) ? 'popup' : $(this).data('name');
    const popupY = (window.screen.height / 2) - (popupHeight / 2);
    const popupX = (window.screen.width / 2) - (popupWidth / 2);

    window.open($(this).attr('href'), popName, 'status=no, height=' + popupHeight + ', width=' + popupWidth + ', left=' + popupX + ', top=' + popupY);
});

// popup cancel btn
$(document).on('click', '#popup_cancel_btn', function () {
    if (confirm('취소 하시겠습니까?')) {
        window.close();
    }
});

const callDatePicker = () => {
    let datepicker = {};

    $('input:text[datepicker]').each(function (k, v) {
        const $el = $(v);

        // data 값 읽기
        let minDate = $el.data('mindate');
        let maxDate = $el.data('maxdate');

        // 옵션 구성
        const options = {
            locale: "ko",
            enableTime: false,
            enableSeconds: false,
            altFormat: 'Y-m-d',
            dateFormat: "Y-m-d"
        };

        // 🔥 min/max 적용
        if (minDate) {
            options.minDate = minDate === 'today'
                ? 'today'
                : moment(minDate).format('YYYY-MM-DD');
        }

        if (maxDate) {
            options.maxDate = maxDate === 'today'
                ? 'today'
                : moment(maxDate).format('YYYY-MM-DD');
        }

        // id 없을 때 대비
        const id = $el.attr('id') || `datepicker_${k}`;

        datepicker[id] = $el.flatpickr(options);
    });

    return datepicker;
};

const callDateTimePicker = () => {
    let datetimepicker = {};

    $('input:text[datetimepicker]').each(function (k, v) {
        const $el = $(v);

        // data 값 읽기
        let minDate = $el.data('mindate');
        let maxDate = $el.data('maxdate');

        // 옵션 구성
        const options = {
            locale: "ko",
            time_24hr: true,
            enableTime: true,
            enableSeconds: true,
            altInput: true,
            altFormat: 'Y-m-d H:i:S', // 🔥 수정
            dateFormat: "Y-m-d H:i:S"
        };

        // 🔥 min/max 적용
        if (minDate) {
            options.minDate = minDate === 'today'
                ? 'today'
                : moment(minDate).format('YYYY-MM-DD HH:mm:ss');
        }

        if (maxDate) {
            options.maxDate = maxDate === 'today'
                ? 'today'
                : moment(maxDate).format('YYYY-MM-DD HH:mm:ss');
        }

        // id 없을 때 대비
        const id = $el.attr('id') || `datetimepicker_${k}`;

        datetimepicker[id] = $el.flatpickr(options);
    });

    return datetimepicker;
};

// input 아닌 다른 태그 클릭시 datepicker 활성화 후 대상에 데이터 삽입 대상은 data-target 에 id 값 설정
const callTargetDatePicker = () => {
    let datepicker = {};

    $('.target-datepicker').each(function (k, v) {
        const $el = $(v);

        // data 값 읽기
        let minDate = $el.data('mindate');
        let maxDate = $el.data('maxdate');

        // 기본 옵션
        const options = {
            locale: "ko",
            enableTime: false,
            enableSeconds: false,
            altFormat: 'Y-m-d',
            dateFormat: "Y-m-d",

            onChange: function(selectedDates, dateStr, instance) {
                if (!selectedDates.length) return;

                const target = $(instance.element).data('target');
                $(`#${target}`).val(dateStr);
            }
        };

        // 🔥 min/max 적용
        if (minDate) {
            options.minDate = minDate === 'today'
                ? 'today'
                : moment(minDate).format('YYYY-MM-DD');
        }

        if (maxDate) {
            options.maxDate = maxDate === 'today'
                ? 'today'
                : moment(maxDate).format('YYYY-MM-DD');
        }

        // id 없을 때 대비
        const id = $el.attr('id') || `datepicker_${k}`;

        datepicker[id] = $el.flatpickr(options);
    });

    return datepicker;
};

// input 아닌 다른 태그 클릭시 datetimepicker 활성화 후 대상에 데이터 삽입 대상은 data-target 에 id 값 설정
const callTargetDateTimePicker = () => {
    let datetimepicker = {};

    $('.target-datetimepicker').each(function (k, v) {
        const $el = $(v);

        // data 값 읽기
        let minDate = $el.data('mindate');
        let maxDate = $el.data('maxdate');

        // 기본 옵션
        const options = {
            locale: "ko",
            time_24hr: true,
            enableTime: true,
            enableSeconds: true,
            altInput: true,
            altFormat: 'Y-m-d H:i:S',
            dateFormat: "Y-m-d H:i:S",

            onChange: function(selectedDates, dateStr, instance) {
                if (!selectedDates.length) return;

                const target = $(instance.element).data('target');
                $(`#${target}`).val(dateStr);
                validateEssChk();
            }
        };

        // 🔥 min/max 적용
        if (minDate) {
            options.minDate = minDate === 'today'
                ? 'today'
                : moment(minDate).format('YYYY-MM-DD HH:mm:ss');
        }

        if (maxDate) {
            options.maxDate = maxDate === 'today'
                ? 'today'
                : moment(maxDate).format('YYYY-MM-DD HH:mm:ss');
        }

        // id 없을 때 대비
        const id = $el.attr('id') || `datetimepicker_${k}`;

        datetimepicker[id] = $el.flatpickr(options);
    });

    return datetimepicker;
};

// input 아닌 다른 태그 클릭시 datepicker 활성화 후 대상에 데이터 Y/M/D 각각 삽입 대상은 data-target 에 id 값 설정 (id 규칙 확인 필요)
const callTargetReplaceDatePicker = () => {
    let datepicker = {};

    $('.target-replace-datepicker').each(function (k, v) {
        const $el = $(v);

        // data 값 읽기
        let minDate = $el.data('mindate');
        let maxDate = $el.data('maxdate');

        // 옵션 기본값
        const options = {
            locale: "ko",
            enableTime: false,
            enableSeconds: false,
            altFormat: 'Y-m-d',
            dateFormat: "Y-m-d",

            onChange: function(selectedDates, dateStr, instance) {
                if (!selectedDates.length) return;

                const m = moment(selectedDates[0]);

                const year  = m.format('YYYY');
                const month = m.format('MM');
                const day   = m.format('DD');

                const _this = $(instance.element);
                const target = _this.data('target');

                $(`#${target}_y`).val(year);
                $(`#${target}_m`).val(month);
                $(`#${target}_d`).val(day);

                if (_this.hasClass('date-calc')) {
                    dateCalc();
                }

                validateEssChk();
            }
        };

        // 🔥 min/max 동적 적용
        if (minDate) {
            options.minDate = minDate;
        }

        if (maxDate) {
            options.maxDate = maxDate;
        }

        // 초기화
        datepicker[$el.attr('id')] = $el.flatpickr(options);
    });

    return datepicker;
};

const encryptAction = (data) => {
    const encKey = "secret phrase";

    switch (true) {
        case typeof data === 'boolean':
            // boolean 일경우 string 으로 변환후 암호화
            return encryptAction(data.toString());

        case Array.isArray(data):
            // 배열인 경우 각 요소를 암호화
            return data.map(val => encryptAction(val));

        case typeof data == 'object':
            // 파일 데이터인 경우 암호화하지 않음
            if (data instanceof Blob || data instanceof File) {
                return data;
            } else {
                // 객체의 각 속성 값을 암호화
                const encryptedObj = {};

                for (const key in data) {
                    if (data.hasOwnProperty(key)) {
                        encryptedObj[key] = encryptAction(data[key]);
                    }
                }

                return encryptedObj;
            }

        case typeof data == 'number':
        case typeof data == 'string':
            // 문자열 또는 숫자인 경우 암호화
            const iv = CryptoJS.lib.WordArray.random(16);
            return CryptoJS.AES.encrypt(data.toString(), encKey, {iv: iv}).toString();

        default:
            // 다른 타입의 데이터는 암호화하지 않음
            return data;
    }
}

const encryptMultiData = (obj) => {
    const multiFormData = new FormData();
    const processedKeys = new Set();

    obj.forEach((value, key) => {
        if (processedKeys.has(key)) return;

        const hasIndex = key.includes('[');

        if (hasIndex) {
            const parts = key.split('[');
            const baseKey = parts[0];
            const suffix = key.substring(baseKey.length);
            const encryptedKey = encryptAction(baseKey) + suffix;

            const allValues = obj.getAll(key);

            // 파일 포함 여부 확인
            const hasFile = allValues.some(val => val instanceof Blob || val instanceof File);

            if (hasFile) {
                // 파일이면 키 암호화 없이 그대로
                allValues.forEach(val => {
                    multiFormData.append(key, val);
                });
            } else {
                allValues.forEach(val => {
                    const finalValue = (typeof val === 'string') ? encryptAction(val) : val;
                    multiFormData.append(encryptedKey, finalValue);
                });
            }

            processedKeys.add(key);

        } else {
            if (value instanceof Blob || value instanceof File) {
                multiFormData.append(key, value);
            } else {
                multiFormData.append(encryptAction(key), encryptAction(value));
            }
        }
    });

    return multiFormData;
};

const encryptData = (obj) => {
    let newObj = {};

    $.each(obj, function (key, value) {
        newObj[encryptAction(key)] = encryptAction(value);
    });

    return newObj;
}

// ajax
const callAjax = (url, obj, isDebug = false) => {
    callbackAjax(url, obj, function (data, error) {
        (data) ? ajaxSuccessData(data) : ajaxErrorData(error);
    }, isDebug);
}

// multi-part ajax (file 전송시 or 배열값 전송시)
const callMultiAjax = (url, obj, isDebug = false) => {
    callbackMultiAjax(url, obj, function (data, error) {
        (data) ? ajaxSuccessData(data) : ajaxErrorData(error);
    }, isDebug);
}

// callback ajax
const callbackAjax = (url, obj, callback, isDebug = false) => {
    const spinnerText = (obj.spinner_text) ? obj.spinner_text : '';

    $.ajax({
        type: "POST",
        url: url,
        data: encryptData(obj),
        beforeSend: function () {
            spinnerShow(obj.spinner_text || '');
        },
        complete: function () {
            spinnerHide(spinnerText);
        },
        success: function (data) {
            if (isDebug) console.log(data);
            callback(data, null);
        },
        error: function (error) {
            if (isDebug) console.log(error);
            callback(null, error);
        }
    });
}

// callback multi-part ajax (file 전송시 or 배열값 전송시)
const callbackMultiAjax = (url, obj, callback, isDebug = false) => {
    // obj(FormData) 안에 spinner_text 필드가 있는지 확인
    const hasSpinnerText = obj instanceof FormData && obj.has('spinner_text');
    const spinnerText = hasSpinnerText ? obj.get('spinner_text') : '';

    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: url,
        data: encryptMultiData(obj),
        beforeSend: function () {
            spinnerShow(spinnerText);
        },
        complete: function () {
            spinnerHide();
        },
        success: function (data) {
            if (isDebug) console.log(data);
            callback(data, null);
        },
        error: function (error) {
            if (isDebug) console.log(error);
            callback(null, error);
        }
    });
}

// ajax none spinner
const callNoneSpinnerAjax = (url, obj, isDebug = false) => {
    $.ajax({
        type: "POST",
        url: url,
        data: encryptData(obj),
        success: function (data) {
            if (isDebug) console.log(data);
            ajaxSuccessData(data);
        },
        error: function (data) {
            if (isDebug) console.log(data);
            ajaxErrorData(data);
        }
    });
}

// ajax Success
const ajaxSuccessData = (obj) => {
    if (obj.log) {
        console.log(obj.log);
    }

    if (obj.alert) {
        actionAlert(obj.alert);
    }

    if (obj.toast) {
        actionToast(obj.toast);
    }

    if (obj.winClose) {
        if (obj.winClose.reload) {
            opener.location.reload();
        }

        window.close();
    }

    if (obj.parentsReload) {
        if (opener) {
            opener.location.reload();
        }
    }

    if (obj.location) {
        locationUrl(obj.location);
    }

    if (obj.removeCss) {
        removeCss(obj.removeCss);
    }

    if (obj.addCss) {
        addCss(obj.addCss);
    }

    if (obj.removeClass) {
        removeClass(obj.removeClass);
    }

    if (obj.addClass) {
        addClass(obj.addClass);
    }

    if (obj.remove) {
        isRemove(obj.remove);
    }

    if (obj.html) {
        addHtml(obj.html);
    }

    if (obj.before) {
        beforeHtml(obj.before);
    }

    if (obj.after) {
        afterHtml(obj.after);
    }

    if (obj.append) {
        appendHtml(obj.append);
    }

    if (obj.prepend) {
        prependHtml(obj.prepend);
    }

    if (obj.openerHtml) {
        openerAddHtml(obj.openerHtml);
    }

    if (obj.openerBefore) {
        openerBeforeHtml(obj.openerBefore);
    }

    if (obj.openerAfter) {
        openerAfterHtml(obj.openerAfter);
    }

    if (obj.openerAppend) {
        openerAppendHtml(obj.openerAppend);
    }

    if (obj.openerPrepend) {
        openerPrependHtml(obj.openerPrepend);
    }

    if (obj.input) {
        addInput(obj.input);
    }

    if (obj.text) {
        addText(obj.text);
    }

    if (obj.attr) {
        addAttr(obj.attr);
    }

    if (obj.removeAttr) {
        removeAttr(obj.attr);
    }

    if (obj.data) {
        addData(obj.data);
    }

    if (obj.removeData) {
        removeData(obj.data);
    }

    if (obj.trigger) {
        isTrigger(obj.trigger);
    }

    if (obj.focus) {
        isFocus(obj.focus);
    }

    if (obj.prop) {
        isProp(obj.prop);
    }
}

// ajax Error
const ajaxErrorData = (obj) => {
    let json = {};

    if (isEmpty(obj.responseJSON)) {
        console.log(obj);
    } else {
        json.case = true;
        json.msg = isEmpty(obj.responseJSON.msg) ? (obj.status + ' ERROR') : obj.responseJSON.msg;

        if (!isEmpty(obj.responseJSON.redirect)) {
            json.location = {
                'case': obj.responseJSON.redirect,
                'url': obj.responseJSON.url,
            }
        }

        actionAlert(json);
    }

    spinnerHide();
}

// ajax loading spinner Show
const spinnerShow = (text = '') => {
    if (!isEmpty(text )) {
        $("#spinner-div .spinner-text").html(text);
    }

    $("#spinner-div").show();
}

// ajax loading spinner Hide
const spinnerHide = () => {
    $("#spinner-div").hide();
    $("#spinner-div .spinner-text").html('');
}

// add html
const addHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).html(data.html);
    });
}

// before html
const beforeHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).before(data.html);
    });
}

// after html
const afterHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).after(data.html);
    });
}

// append html
const appendHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).append(data.html);
    });
}

// prepend html
const prependHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).prepend(data.html);
    });
}

// opener html
const openerAddHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(window.opener.document).find(data.selector).html(data.html);
    });
}

// opener before html
const openerBeforeHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(window.opener.document).find(data.selector).before(data.html);
    });
}

// opener after html
const openerAfterHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(window.opener.document).find(data.selector).after(data.html);
    });
}

// opener append html
const openerAppendHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(window.opener.document).find(data.selector).append(data.html);
    });
}

// opener prepend html
const openerPrependHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(window.opener.document).find(data.selector).prepend(data.html);
    });
}

// add css
const addCss = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).css(data.css, data.val);
    });
}

// remove css
const removeCss = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).css(data.css, '');
    });
}

// add class
const addClass = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).addClass(data.class);
    });
}

// remove class
const removeClass = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).removeClass(data.class);
    });
}

// add input
const addInput = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).val(data.input);
    });
}

// add Text
const addText = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).text(data.text);
    });
}

// add attr
const addAttr = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).attr(data.attr, data.val);
    });
}

// remove attr
const removeAttr = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).removeAttr(data.attr);
    });
}

// add data
const addData = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).data(data.name, data.data);
    });
}

// remove data
const removeData = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).removeData(data.name);
    });
}

// trigger
const isTrigger = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).trigger(data.event);
    });
}

// prop
const isProp = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).prop(data.event, data.val);
    });
}

// remove
const isRemove = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).remove();
    });
}

// focus
const isFocus = (target) => {
    $(target).focus();
}

// location url
const locationUrl = (obj) => {
    switch (obj.case) {
        case 'replace':
            window.location.replace(obj.url);
            break;

        case 'reload':
            window.location.reload();
            break;

        case 'back':
            window.history.back();
            break;

        case 'href':
            location.href = obj.url;
            break;

        case 'blank':
            const openNewWindow = window.open("about:blank");
            openNewWindow.location.href = obj.url;
            break;
    }
}

// alert
const actionAlert = (obj) => {
    alert(obj.msg);

    if (obj.case) {
        delete obj.case;
        delete obj.msg;
        ajaxSuccessData(obj);
    }
}

// toast
const actionToast = (obj) => {
    $.toast({
        heading: '',
        text: obj.msg,
        icon: '',
        position: 'mid-center',
        stack: false,
        hideAfter: 2000, // 3초 후 사라짐
    });;

    if (obj.case) {
        delete obj.case;
        delete obj.msg;
        ajaxSuccessData(obj);
    }
}

// file input check
const fileCheck = (_this, inputTarget = null) => {
    // plupload 체크 제외
    if ($(_this).closest('#plupload').length > 0) {
        return false;
    }

    const str = $(_this).val();
    const fileName = str.split('\\').pop().toLowerCase();

    // 등록 파일 없으면 체크 안함
    if (isEmpty(str)) {
        return false;
    }

    // 1. 파일명에 특수문자 체크
    const pattern = /[\{\}\/?,;:|*~`!^\+<>@\#$%&\\\=\'\"]/gi;
    if (pattern.test(fileName)) {
        // 파일명에 허용된 특수문자 '-', '_', '(', ')', '[', ']', '.'
        alert('Please remove special characters from the file name.');

        if (!isEmpty(inputTarget)) {
            $(inputTarget).val('');
        }

        return false;
    }

    // 2. 확장자 체크
    const accept = $(_this).data('accept');
    if (!isEmpty(accept)) {
        const extArr = accept.split('|');
        const ext = str.split('.').pop().toLowerCase();

        if ($.inArray(ext, extArr) == -1) {
            alert(`${accept.replace(/\|/g, ', ')}` + ' only');

            if (!isEmpty(inputTarget)) {
                $(inputTarget).val('');
            }

            return false;
        }
    }

    // 3. 파일 크기 체크 (기본 업로드 크기 20MB data 값으로 업로드 크기 개별 조절)
    const size = $(_this)[0].files[0].size;
    const customSize = $(_this).data('size');
    const maxFileSize = isEmpty(customSize) ? 20 : parseInt(customSize);
    if (size > (maxFileSize * 1024 * 1024)) {
        alert(`The attached file size can be registered within ${maxFileSize}MB.`);

        if (!isEmpty(inputTarget)) {
            $(inputTarget).val('');
        }

        return false;
    }

    if (!isEmpty(inputTarget)) {
        $(inputTarget).val(fileName);
    }

    return true;
}

const fileDelCheck = (delTarget) => {
    if (delTarget.length > 0) {
        alert('첨부파일 삭제후 업로드 해주세요.');
        return false;
    }

    return true;
}

// null Check
const isEmpty = (str) => {
    if (typeof str === 'string') {
        str = str.replace(/ /g, ''); // 공백 제거
        str = str.replace(/\n/g, ""); // 줄바꿈 제거
    }

    return (typeof str === "undefined" || str === null || str === "") ? true : false;
}

const emailCheck = (email, is_en = false) => {
    const emailRegExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!emailRegExp.test($.trim(email))) {
        const msg = (is_en)
            ? "Email address seems incorrect. (check @ and .’s)"
            : "올바른 이메일 형식이 아닙니다.";

        alert(msg);
        return false;
    }

    return true;
}

const passwordCheck = (password, is_en = false) => {
    // 비밀번호 REGX (4~14자, 소문자 1개 이상 포함, 또는 특수문자 1개 이상 포함, 소문자 + 숫자 + 특수문자, 대문자 사용물가)
    const pwdRegex = /^(?=.*[a-z])(?=.*[\d\W])[a-z\d\W]{4,14}$/;

    if (!pwdRegex.test(password)) {
        const msg = (is_en)
            ? "Invalid password format."
            : "올바른 비밀번호 형식이 아닙니다.";

        alert(msg);
        return false;
    }

    return true;
}

// form Data serialize convert Json
const serializeConvertJson = (obj) => {
    let jsonData = {};

    $(obj).each(function (k, v) {
        jsonData[v.name] = v.value;
    });

    return jsonData;
}

// form Data serialize
const formSerialize = (target) => {
    let formData = serializeConvertJson($(target).serializeArray());
    const targetData = $(target).data();

    Object.entries(targetData).forEach(([key, value]) => {
        formData[key] = value;
    });

    return formData;
}

// form Data
const newFormData = (target) => {
    let formData = new FormData($(target)[0]);
    const targetData = $(target).data();

    Object.entries(targetData).forEach(([key, value]) => {
        formData.append(key, value);
    });

    return formData;
}

// 다음 우편번호 검색
const callPostCode = (callback) => {
    new daum.Postcode({
        oncomplete: function (data) {
            callback(data);
        }
    }).open();
}

// mobile check
const isMobile = () => {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

// 날짜별 요일
const getYoil = (date) => {
    const week = ['일', '월', '화', '수', '목', '금', '토'];
    return week[new Date(date).getDay()];
}

// add comma
const comma = (str) => {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

// remove comma
const uncomma = (str) => {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

const isMaxLength = (str, size) => {
    if (str.length > size) {
        alert("최대 " + size + "자까지 입력 가능합니다.");
        str = str.substring(0, size);
    }

    return str;
}

const isMaxByte = (str, size) => {
    const str_len = str.length;
    let rbyte = 0;
    let rlen = 0;
    let one_char = "";
    let i = 0;

    for (i; i < str_len; i++) {
        one_char = str.charAt(i);

        if (escape(one_char).length > 4) {
            rbyte += 2; // 한글 2Byte
        } else {
            rbyte++; // 영문 등 1Byte
        }

        if (rbyte <= size) {
            rlen = i + 1; // return 할 문자열 갯수
        }
    }

    if (rbyte > size) {
        alert("최대 " + size + "byte까지 입력 가능합니다.");
        str = str.substr(0, rlen);
    }

    return str;
}

// Refresh captcha
const refreshCaptcha = () => {
    $.ajax({
        type: "POST",
        url: '/common/captcha-make',
        data: {},
        success: function (data) {
            $('#captcha').val('');
            $('#captcha_img').attr('src', data);
        },
        error: function (error) {
            ajaxErrorData(error)
        }
    });
}


// captcha check
const captchaCheck = (is_en = false) => {
    const captcha = $('#captcha');

    if (captcha.length > 0 && isEmpty(captcha.val())) {
        const msg = (is_en)
            ? "Your response to the CAPTCHA appears to be invalid. Please re-verify that you\'re not a robot."
            : "인증 문자가 일치하지 않습니다.";

        alert(msg);
        captcha.focus();
        return false;
    }

    return true;
}

// 로그인 유지시간
const loginTimer = () => {
    const now = moment();
    const end = moment(loginHoldingTime, 'YYYY-MM-DD HH:mm:ss');

    const diff = end.diff(now, 'seconds');

    if (diff <= 0) {
        clearInterval(timerInterval);
        alert('로그인 시간이 만료 되었습니다.');
        callAjax('/logout', {});
        return;
    }

    const duration = moment.duration(diff, 'seconds');

    // const hours = Math.floor(duration.asHours());
    const minutes = duration.minutes();
    const seconds = duration.seconds();

    if ($('#session-timer').length > 0) {
        $('#session-timer').text(
            // hours + '시간 ' + minutes + '분 ' + seconds + '초'
            minutes + '분 ' + seconds + '초'
        );
    }
}

// 로그인 유지 시간 연장
const loginExtension = () => {
    loginHoldingTime = moment().add(30, 'minutes').format('YYYY-MM-DD HH:mm:ss');
    alert('연장 되었습니다.');
}

// .ESS-CHK 필수 값 체크
const validateEssChk = () => {
    let isValid = true;
    let validTarget = null;

    $('.ESS-CHK').css('background-color', '');

    $('.ESS-CHK').each(function () {
        const $td = $(this);

        // tr display:none 이면 제외
        if (!$td.closest('tr').is(':visible')) return true;

        // td display:none 이면 제외
        if (!$td.is(':visible')) return true;

        const $targets = $td.find('input, select, textarea').filter(function () {
            // disabled 아니고 displayn none 아니고 ESS-CHK-NONE 클래스 없는 대상
            return !$(this).is(':disabled') && $(this).is(':visible') && !$(this).hasClass('ESS-CHK-NONE');
        });

        if (!$targets.length) return true;

        // 타입별 존재 여부
        const hasRadio    = $targets.filter('[type=radio]').length > 0;
        const hasCheckbox = $targets.filter('[type=checkbox]').length > 0;
        const hasText     = $targets.filter('input:not([type=radio]):not([type=checkbox]), textarea').length > 0;
        const hasSelect   = $targets.filter('select').length > 0;

        // 타입별 유효 여부
        let radioValid = true;
        let checkboxValid = true;
        let textValid = true;
        let selectValid = true;

        // radio
        if (hasRadio) {
            const radioNames = [];

            // name 목록 수집 (중복 제거)
            $targets.filter('[type=radio]').each(function () {
                const name = $(this).attr('name');
                if (name && radioNames.indexOf(name) === -1) {
                    radioNames.push(name);
                }
            });

            // 모든 radio 그룹 체크 확인
            radioValid = radioNames.every(function (name) {
                return $td.find(`input[name="${name}"]:checked`).length > 0;
            });
        }

        // checkbox
        if (hasCheckbox) {
            checkboxValid = $targets.filter('[type=checkbox]:checked').length > 0;
        }

        // input (radio, checkbox 제외한 나머지) / textarea
        if (hasText) {
            const $textTargets = $targets.filter('input:not([type=radio]):not([type=checkbox]), textarea');

            textValid = true;

            $textTargets.each(function () {
                const $el = $(this);

                // 비활성 / 숨김 skip
                if ($el.is(':disabled') || !$el.is(':visible')) return true;

                // 하나라도 비어있으면 실패
                if (isEmpty($el.val()) || !$el.val().trim()) {
                    textValid = false;
                    return false;
                }
            });
        }

        // select
        if (hasSelect) {
            const $selectTargets = $targets.filter('select');

            selectValid = true;

            $selectTargets.each(function () {
                const value = $(this).val();

                if (isEmpty(value)) {
                    selectValid = false;
                    return false;
                }
            });
        }

        // 존재하는 것만 AND 조건
        const groupValid =
            (!hasRadio    || radioValid) &&
            (!hasCheckbox || checkboxValid) &&
            (!hasText     || textValid) &&
            (!hasSelect   || selectValid);

        if (!groupValid) {
            isValid = false;
            validTarget = $targets.first();
            return false;
        }
    });

    if (!isValid && validTarget) {
        validTarget.closest('.ESS-CHK').css('background-color', '#ffffcc');
    }

    if ($('.status-target').length > 0) {
        $('.status-target').prop('checked', isValid)
    }
}

// dipaly show hide 동작
const visibleAction = (target, is_show) => {
    if (is_show) {
        target.show();
    } else {
        target.hide();
        target.find('select').val('').trigger('change');
        target.find('input[type=radio]').prop('checked', false).trigger('change');
        target.find('input[type=checkbox]').prop('checked', false).trigger('change');
        target.find('input:not([type=radio]):not([type=checkbox]), textarea').val('');
    }

    if ($('.ESS-CHK').length > 0) {
        validateEssChk();
    }
}

$(document).on('blur click', '.ESS-CHK', function () {
    validateEssChk();
});

$(document).on('change', 'input[type=radio]:not(.ESS-CHK), input[type=checkbox]:not(.ESS-CHK)', function () {
    validateEssChk();
});

$(document).on('blur', '.dateY, .dateM, .dateD', function() {
    const _this = $(this);
    let _name = '';

    if(_this.hasClass('dateY')){
        _name = _this.attr('name').replace('_d_y', '');
    }

    if(_this.hasClass('dateM')){
        _name = _this.attr('name').replace('_d_m','');
    }

    if(_this.hasClass('dateD')){
        _name = _this.attr('name').replace('_d_d','');
    }

    if (isEmpty(_name)) {
        return false;
    }

    const _yTarget = $(`input[name=${_name}_d_y]`);
    const _mTarget = $(`input[name=${_name}_d_m]`);
    const _dTarget = $(`input[name=${_name}_d_d]`);

    let _y = _yTarget.val(); // 년
    let _m = _mTarget.val(); // 월
    let _d = _dTarget.val(); // 일

    if (_m.length === 1) {
        _m = `0${_m}`;
        _mTarget.val(_m);
    }

    if (_d.length === 1) {
        _d = `0${_d}`;
        _dTarget.val(_d);
    }

    if(!isEmpty(_y) && !isEmpty(_m) && !isEmpty(_d)){
        const _input_date = `${_y}-${_m}-${_d}`;

        // 날짜 체크 (format 반드시 맞아야 함)
        const inputMoment = moment(_input_date, 'YYYY-MM-DD', true);

        if (!inputMoment.isValid()) {
            alert("유효한 날짜가 아닙니다.");
            _yTarget.val('');
            _mTarget.val('');
            _dTarget.val('');
            return false;
        }

        // 오늘 날짜 (시간 제거)
        const today = moment().startOf('day');

        // 미래 날짜 체크
        if (inputMoment.isAfter(today)) {
            alert("오늘 이후의 날짜는 선택할 수 없습니다.");
            _yTarget.val('');
            _mTarget.val('');
            _dTarget.val('');
            return false;
        }

        // 날짜로 계산 필요시 (함수는 각페이지)
        if (_this.hasClass('date-calc')) {
            dateCalc();
        }
    }
});

// phone only number Auto Hyphen
$(document).on("keyup", "input[phoneHyphen]", function () {
    const phone = $(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})$/, "$1-$2-$3").replace("--", "-");
    $(this).val(phone);
});

// numberFormat add comma
$(document).on("keyup", "input[priceFormat]", function () {
    const num = uncomma($(this).val()).replace(/[^0-9\s+]/g, "")

    // 0으로 시작후 뒤에 숫자 들어오면 앞의 0 제거
    num = num.replace(/^0+(\d)/, "$1");

    $(this).val(comma(isNaN(num) ? '' : num));
});

// onlyNumber
$(document).on("keyup", "input[onlyNumber]", function () {
    let num = $(this).val().replace(/[^0-9]/g, "");

    // 0으로 시작후 뒤에 숫자 들어오면 앞의 0 제거
    num = num.replace(/^0+(\d)/, "$1");

    $(this).val(num);
});

// onlyDecimal
$(document).on("keyup", "input[onlyDecimal]", function () {
    let val = $(this).val();

    // 1. 숫자 + . 만 허용
    val = val.replace(/[^0-9.]/g, "");

    // 2. 소수점 1개만 허용
    val = val.replace(/(\..*?)\./g, "$1");

    // 3. .으로 시작하면 0. 붙이기 (.1 → 0.1)
    if (val.startsWith('.')) {
        val = '0' + val;
    }

    // 4. 0 뒤에 숫자 오면 0 제거 (단, 0.xxx는 유지)
    val = val.replace(/^0+(\d)/, "$1");

    $(this).val(val);
});

// number and hyphen
$(document).on("keyup", "input[numberHyphen]", function () {
    const num = $(this).val().replace(/[^0-9-]/g, "");
    $(this).val(num);
});

// 공백입력 방지
$(document).on("keyup", "input[noneSpace]", function () {
    const val = $(this).val().replace(/ /g, "");
    $(this).val(val);
});

// only Korean (공백허용) 한글만 입력
$(document).on("keyup", "input[onlyKo]", function () {
    const ko = $(this).val().replace(/[^가-힣\s+]/gi, "");
    $(this).val(ko);
});

// None Korean (공백허용) 한글 입력 막기
$(document).on("keyup", "input[noneKo]", function () {
    const nonKo = $(this).val().replace(/[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/g, "");
    $(this).val(nonKo);
});

// only Korean Alert (공백허용)
$(document).on("keyup", "input[onlyKoAlert]", function () {
    const val = $(this).val();
    const isOnlyKorean = /^[ㄱ-ㅎㅏ-ㅣ가-힣\s]+$/.test(val); // 한글 + 공백 허용

    if (!isOnlyKorean && val.length > 0) {
        const lang = $(this).data('lang');
        const msg =(!isEmpty(lang) && lang === 'en')
            ? "Please enter Korean letters and spaces only."
            : "한글만 입력 가능합니다.";

        alert(msg);
        $(this).val('');
    }
});

// only English (공백허용)
$(document).on("keyup", "input[onlyEn]", function () {
    const en = $(this).val().replace(/[^a-z\s+]/gi, "");
    $(this).val(en);
});

// only English Alert (공백허용)
$(document).on("keyup", "input[onlyEnAlert]", function () {
    const val = $(this).val();
    const isOnlyEnglishOrSpace = /^[a-zA-Z\s]*$/.test(val);

    if (!isOnlyEnglishOrSpace && val.length > 0) {
        const lang = $(this).data('lang');
        const msg =(!isEmpty(lang) && lang === 'en')
            ? "Please enter English letters and spaces only."
            : "영문만 입력 가능합니다.";

        alert(msg);
        $(this).val('');
    }
});

// English & number (공백허용)
$(document).on("keyup", "input[onlyEnNum]", function () {
    const en = $(this).val().replace(/[^a-z0-9\s+]/gi, "");
    $(this).val(en);
});

// EnglishName (공백, -, _ 허용)
$(document).on("keyup", "input[enname]", function () {
    const en = $(this).val().replace(/[^a-z\s_\-]/gi, "");
    $(this).val(en);
});

// English 첫글자 대문자
$(document).on("keyup", "input[upperCase]", function () {
    const str = $(this).val();
    $(this).val(str.charAt(0).toUpperCase() + str.slice(1));
});

// 영문만 입력 가능한데 대문자로
$(document).on("keyup", "input[EnUpperCase]", function () {
    const en = $(this).val().replace(/[^a-z\s+]/gi, "");
    $(this).val(en.toUpperCase());
});

// 라디오 버튼 더블클릭 체크 해제
$(document).on('dblclick', 'input[type="radio"], label:has(input[type="radio"])', function (e) {
    let $radio;

    // label 클릭인지 radio 클릭인지 구분
    if ($(this).is('label')) {
        $radio = $(this).find('input[type=radio]');
    } else {
        $radio = $(this);
    }

    if ($radio[0].checked) {
        $radio.prop('checked', false);
    }

    $radio.trigger('change');
});

// 라디오 or 체크박스 선택시 연관 disabled 해제 여부 판단
$(document).on('change', 'input[type=radio], input[type=checkbox]', function () {
    const _this = $(this);
    const name = _this.attr('name');
    const checked = _this.is(':checked');
    const is_ESS_CHK = $('.ESS-CHK').length > 0; // 필수값 체크 클래스 있는지 확인

    // .target-active 변경시 상위태그 td 기준 하위대상 .chk-active disabled 해제 여부 판단
    if (_this.hasClass('target-active')) {
        const is_active = _this.data('active');

        _this.closest('td').find('.chk-active').each(function (index, item) {
            const _item = $(item);
            const _item_tag = _item.prop('tagName').toLowerCase();

            switch (_item_tag) {
                case 'select':
                case 'textarea':
                    _item.val('');
                    break;

                case 'input':
                    const type = _item.attr('type');

                    if (type === 'text') {
                        _item.val('');
                    } else if(type === 'radio' || type === 'checkbox') {
                        _item.prop('checked', false).trigger('change');
                    }
                    break;

                default:
                    break;
            }

            // 이벤트 실행 선택자가 체크시 is_active 값으로 disabled 추가 및 삭제
            if (_this.is(':checked')) {
                _item.attr('disabled', is_active);
            } else {
                _item.attr('disabled', !is_active);
            }
        });
    }

    // .target-box-active 변경시 상위태그 .target-box 기준 하위대상 .chk-active disabled 해제 여부 판단
    if (_this.hasClass('target-box-active')) {
        const is_active = _this.data('active2');

        _this.closest('.target-box').find('.chk-active').each(function (index, item) {
            const _item = $(item);
            const _item_tag = _item.prop('tagName').toLowerCase();

            switch (_item_tag) {
                case 'select':
                case 'textarea':
                    _item.val('');
                    break;

                case 'input':
                    const type = _item.attr('type');

                    if (type === 'text') {
                        _item.val('');
                    } else if(type === 'radio' || type === 'checkbox') {
                        _item.prop('checked', false).trigger('change');
                    }
                    break;

                default:
                    break;
            }

            // 이벤트 실행 선택자가 체크시 is_active 값으로 disabled 추가 및 삭제
            if (_this.is(':checked')) {
                _item.attr('disabled', is_active);
            } else {
                _item.attr('disabled', !is_active);
            }
        });
    }

    if (is_ESS_CHK) {
        validateEssChk();
    }
});

// 라디오 or 체크박스 클릭 막기
$(document).on('click', '.NONE-CLICK', function (e) {
    e.preventDefault();
    e.stopPropagation();
    validateEssChk();
    return false;
});

// 레이어 팝업 닫기
$(document).on('click', '.layer-close', function () {
    $(this).closest('.popup-wrap').remove();
});