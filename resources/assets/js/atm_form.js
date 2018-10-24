$(function () {

  $('.container').on('click', '[data-dispense]', function (e) {
    var $targetElem = $(e.currentTarget);
    var dispenseAmt = $targetElem.data('dispense');

    if (dispenseAmt !== 'custom') {
      dispenseAmt = $('#txtCustomAmt').val();
      $('[name="dispense_amt"]').val(dispenseAmt);
    }


    $('#fmDispense').submit();
  });

});