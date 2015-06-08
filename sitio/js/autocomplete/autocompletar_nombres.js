/*jslint  browser: true, white: true, plusplus: true */
/* global $, nombres_js */

$(function () {
    'use strict';

    //var nombres_bd = ['jorge','antonio','pedro','juan','jose'];
  
    // Initialize autocomplete with custom appendTo:
    $('#autocomplete-custom-append').autocomplete({
        lookup: nombres_js,
        appendTo: '#suggestions-container'
    });

});