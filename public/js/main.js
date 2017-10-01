var App = function() {

    var settings = {
        message: {
            confirm: "ยืนยันการทำรายการต่อไปนี้ !"
        },
        emptySelect: {
            province: "<option value=''> กรุณาเลือกจังหวัด </option>",
            district: "<option value=''> กรุณาเลือกอำเภอ </option>"
        },
        element: {
            province: '.province-dropdown',
            confirmButton: 'body .btn-danger'
        },
        apiUrl: {
            getDistrict: 'dog/district/',
        }
    }

    var init = function () {
        jQuery.extend(jQuery.validator.messages, {
            required: "กรุณากรอกข้อมูลในช่องนี้.",
            remote: "Please fix this field.",
            email: "กรุณากรอกที่อยู่อีเมลให้ถูกต้อง",
            url: "กรุณากรอกที่อยู่ลิ้ง (URL) ให้ถูกต้อง",
            date: "Please enter a valid date.",
            dateISO: "Please enter a valid date (ISO).",
            number: "Please enter a valid number.",
            digits: "Please enter only digits.",
            creditcard: "Please enter a valid credit card number.",
            equalTo: "Please enter the same value again.",
            accept: "Please enter a value with a valid extension.",
            maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
            minlength: jQuery.validator.format("Please enter at least {0} characters."),
            rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
            range: jQuery.validator.format("Please enter a value between {0} and {1}."),
            max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
            min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
        })

        setConfirmButton(settings.element.confirmButton)
        provinceDropDownEvent()
        $('form').validate()
    }

    var provinceDropDownEvent = function(useSettings) {
        var defaultSettings = {
            container: '.province-dropdown',
            province_ele: 'select[name="province_id"]',
            district_ele: 'select[name="district_id"]'
        }

        var config = _.extend(defaultSettings, useSettings);

        $(config.container).on('change', config.province_ele, function(e) {
            var provinceId = $(this).val()
            var elementClosest = $(this)
                .closest('div' + config.container)

            var elementDistrict = elementClosest
                .find(config.district_ele)
            
            elementDistrict.html(settings.emptySelect.district)
            if (provinceId != '') {
                $.getJSON(settings.apiUrl.getDistrict + provinceId, function(res) {
                    $.each(res, function(index, value) {
                        elementDistrict.append($("<option />")
                            .attr("value", value.id)
                            .text(value.name_th))
                    })
                })
            }
        })
    }

    var setConfirmButton = function(element) {
        $(element).on('click', function(e) {
            return confirm(settings.message.confirm)
        })
    }

    var noti = function(message, type, icon = "fa fa-exclamation") {
        type = (type == true) ? 'success' : 'danger'
        $.notify({
            icon: icon,
            message: message
        }, {
            type: type,
            timer: 10000,
            placement: {
                from: 'top',
                align: 'right'
            },
            z_index: 99999
        })
    }

    var getCsrfToken = function() {
        return $('meta[name="csrf-token"]').attr('content');
    }

    var setCsrfToken = function(token) {
        $('meta[name="csrf-token"]').attr('content', token);
        $('input[name="_token"]').attr('value', token);
    }

    return {
        settings: settings,
        init: init,
        noti: noti,
        setConfirmButton: setConfirmButton,
        getCsrfToken: getCsrfToken,
        setCsrfToken: setCsrfToken
    }
}

$(function() {
    var app = new App
    app.init()
})