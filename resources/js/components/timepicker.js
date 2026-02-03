/*
Template Name: Tailwick - Admin & Dashboard Template
Author: Themesdesign
Version: 2.0.0
Website: https://themesdesign.in/
Contact: themesdesign.in@gmail.com
File: flatpickr Plugins Js File
*/




import flatpickr from "flatpickr";

// flatpickr
var flatpickrExamples = document.querySelectorAll("[data-provider]");
Array.from(flatpickrExamples).forEach(function (item) {
    if (item.getAttribute("data-provider") == "flatpickr") {
        var dateData = {};
        var isFlatpickerVal = item.attributes;
        if (isFlatpickerVal["data-date-format"])
            dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
        if (isFlatpickerVal["data-enable-time"]) {
            (dateData.enableTime = true),
                (dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString() + " H:i");
        }
        if (isFlatpickerVal["data-altFormat"]) {
            (dateData.altInput = true),
                (dateData.altFormat = isFlatpickerVal["data-altFormat"].value.toString());
        }
        if (isFlatpickerVal["data-minDate"]) {
            dateData.minDate = isFlatpickerVal["data-minDate"].value.toString();
            dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
        }
        if (isFlatpickerVal["data-maxDate"]) {
            dateData.maxDate = isFlatpickerVal["data-maxDate"].value.toString();
            dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
        }
        if (isFlatpickerVal["data-default-date"]) {
            dateData.defaultDate = isFlatpickerVal["data-default-date"].value.toString();
            dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
        }
        if (isFlatpickerVal["data-multiple-date"]) {
            dateData.mode = "multiple";
            dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
        }
        if (isFlatpickerVal["data-range-date"]) {
            dateData.mode = "range";
            dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
        }
        if (isFlatpickerVal["data-inline-date"]) {
            (dateData.inline = true),
                (dateData.defaultDate = isFlatpickerVal["data-default-date"].value.toString());
            dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
        }
        if (isFlatpickerVal["data-disable-date"]) {
            var dates = [];
            dates.push(isFlatpickerVal["data-disable-date"].value);
            dateData.disable = dates.toString().split(",");
        }
        if (isFlatpickerVal["data-week-number"]) {
            var dates = [];
            dates.push(isFlatpickerVal["data-week-number"].value);
            dateData.weekNumbers = true
        }
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr(item, dateData);
        });
    } else if (item.getAttribute("data-provider") == "timepickr") {
        var timeData = {};
        var isTimepickerVal = item.attributes;
        if (isTimepickerVal["data-time-basic"]) {
            (timeData.enableTime = true),
                (timeData.noCalendar = true),
                (timeData.dateFormat = "H:i");
        }
        if (isTimepickerVal["data-time-hrs"]) {
            (timeData.enableTime = true),
                (timeData.noCalendar = true),
                (timeData.dateFormat = "H:i"),
                (timeData.time_24hr = true);
        }
        if (isTimepickerVal["data-min-time"]) {
            (timeData.enableTime = true),
                (timeData.noCalendar = true),
                (timeData.dateFormat = "H:i"),
                (timeData.minTime = isTimepickerVal["data-min-time"].value.toString());
        }
        if (isTimepickerVal["data-max-time"]) {
            (timeData.enableTime = true),
                (timeData.noCalendar = true),
                (timeData.dateFormat = "H:i"),
                (timeData.minTime = isTimepickerVal["data-max-time"].value.toString());
        }
        if (isTimepickerVal["data-default-time"]) {
            (timeData.enableTime = true),
                (timeData.noCalendar = true),
                (timeData.dateFormat = "H:i"),
                (timeData.defaultDate = isTimepickerVal["data-default-time"].value.toString());
        }
        if (isTimepickerVal["data-time-inline"]) {
            (timeData.enableTime = true),
                (timeData.noCalendar = true),
                (timeData.defaultDate = isTimepickerVal["data-time-inline"].value.toString());
            timeData.inline = true;
        }
        setTimeout(() => {
            flatpickr(item, timeData);
        }, 750);
    }
});