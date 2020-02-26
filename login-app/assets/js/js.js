"use strict";
///<reference path="../../node_modules/@types/jquery/index.d.ts"/>
var Test = (function () {
    function Test() {
    }
    Test.prototype.draw = function () {
        var x = $('.testSpan');
        x.css('color', 'blue');
    };
    return Test;
}());
var test = new Test();
$(document).ready(function () {
    $("#sub").click(function () {
        setInterval(test.draw, 2000);
    });
});
