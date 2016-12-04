"use strict";
$("#calculateTipForm").submit(function(event) {
  event.preventDefault();
  calculateTipForm();
});

/*
 * Form submission logic
 */

function calculateTipForm() {
  console.log("calculating tip");
  var billSubtotal = $("#bill-subtotal").val();
  var tipPercentage = $("input[name=tip-percentage]:checked").val();
  console.log(billSubtotal);
  console.log(tipPercentage);
  submitTipCalculationRequest(billSubtotal, tipPercentage)
    .fail(calculateRequestFailure)
    .done(calculateRequestSuccess);
}

/*
 * Calculate Tip Request ajax function call and callbacks
 */

function submitTipCalculationRequest(billSubtotal, tipPercentage) {
  return $.ajax({
    type: "POST",
    url: "processTipRequest.php",
    data: "bill-subtotal=" + billSubtotal + "&tip-percentage=" + tipPercentage,
  });
}

function calculateRequestFailure(data) {
  alert('Something bad happened to your connection. Your calculation request was not made.');
}

function calculateRequestSuccess(data) {
  console.log(data);
  if (data["success"]) {
    $("#error-message").html("");
    $("#result-tip").html("Tip: $" + data["tip"]);
    $("#result-total").html("Total: $" + data["total"]);
  } else {
    $("#error-message").html(data);
    $("#result-tip").html("");
    $("#result-total").html("");
  }
}
