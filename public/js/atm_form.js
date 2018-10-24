$(function () {
  
  
  $('.container').on('click', '[data-dispense]', function (e) {
    var $targetElem = $(e.currentTarget);
    var dispenseAmt = $targetElem.data('dispense');
    if (dispenseAmt === 'custom') {
      dispenseAmt = $('#txtCustomAmt').val();
    }
    if (/^\d+$/gi.test(dispenseAmt)) {
      // allow to process
      $('.input-error-label').addClass('d-none');
      $('[name="dispense_amt"]').val(dispenseAmt);
      $('#fmDispense').submit();
    } else {
      // not allow
      $('#txtCustomAmt').val('').focus();
      $('.input-error-label').removeClass('d-none');
    }
  });
});