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
  if (tipPercentage === "Custom") {
    tipPercentage = $("#custom-tip").val();
  }
  var numPersons = $("#num-persons").val();
  console.log(billSubtotal);
  console.log(tipPercentage);
  submitTipCalculationRequest(billSubtotal, tipPercentage, numPersons)
    .fail(calculateRequestFailure)
    .done(calculateRequestSuccess);
}

/*
 * Calculate Tip Request ajax function call and callbacks
 */

function submitTipCalculationRequest(billSubtotal, tipPercentage, numPersons) {
  return $.ajax({
    type: "POST",
    url: "processTipRequest.php",
    data: "bill-subtotal=" + billSubtotal + "&tip-percentage=" + tipPercentage + "&num-persons=" + numPersons,
  });
}

function calculateRequestFailure(data) {
  alert('Something bad happened to your connection. Your calculation request was not made.');
}

function calculateRequestSuccess(data) {
  console.log(data);
  if (data["success"]) {
    if (data["split"]) {
      $("#error-message").html("");
      $("#result-tip").html("Tip: $" + data["tip"]);
      $("#result-total").html("Total: $" + data["total"]);
      $("#tip-individual").html("Tip each: $" + data["ind-tip"]);
      $("#total-individual").html("Total each: $" + data["ind-total"]);
    } else {
      $("#error-message").html("");
      $("#result-tip").html("Tip: $" + data["tip"]);
      $("#result-total").html("Total: $" + data["total"]);
      $("#tip-individual").html("");
      $("#total-individual").html("");
    }

  } else {
    $("#error-message").html(data);
    $("#result-tip").html("");
    $("#result-total").html("");
    $("#tip-individual").html("");
    $("#total-individual").html("");
  }
}
