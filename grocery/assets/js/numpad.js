$.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
$.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
$.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control" />';
$.fn.numpad.defaults.buttonNumberTpl =  '<button type="button" class="btn btn-default"  style="width: 100%;"></button>';
$.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn" style="width: 100%;"></button>';
$.fn.numpad.defaults.onKeypadCreate = function(){$(this).find('.done').addClass('btn-primary');};

// Instantiate NumPad once the page is ready to be shown
$(document).ready(function(){
    $('#discount').numpad();
    $('#paid').numpad();
    //$('#remainder').numpad();


});