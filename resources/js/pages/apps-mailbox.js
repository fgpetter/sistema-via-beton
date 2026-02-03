/*
Template Name: Tailwick - Admin & Dashboard Template
Author: Themesdesign
Version: 2.0.0
Website: https://themesdesign.in/
Contact: themesdesign.in@gmail.com
File: MailBox Js
*/



document.addEventListener("DOMContentLoaded", function () {
    const checkAll = document.getElementById("checkAll");
    const checkboxes = document.querySelectorAll(".mail-list .form-checkbox");

    checkAll.addEventListener("change", function () {
        checkboxes.forEach((cb) => {
            cb.checked = checkAll.checked;
        });
    });
});