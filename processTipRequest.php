<?php

  // don't need to erro check for these because in ajax request, always have these 2 as post params
  // there is possiblity of sending empty string, which is checked for later in `is_numeric()` call
  // if (!isset($_POST['bill-subtotal'])) {
  //   die ("ERROR: Need bill subtotal!");
  // }
  //
  // if (!isset($_POST['tip-percentage'])) {
  //   die ("ERROR: Need tip percentage!");
  // }

  if (!is_numeric($_POST['bill-subtotal'])) {
    die ("ERROR: Bill subtotal isn't a number!");
  }

  $billSubtotal = floatval($_POST["bill-subtotal"]);
  $tipPercentage = $_POST["tip-percentage"];
  error_log($billSubtotal);
  error_log($tipPercentage);
  $tipPercentage = str_replace('%', '', $tipPercentage) / 100;

  if ($billSubtotal < 0) {
    die ("ERROR: Why is the bill subtotal less than 0?!");
  }

  if (!is_numeric($tipPercentage)) {
    die ("ERROR: Tip percent isn't a number!");
  }

  if ($tipPercentage < 0) {
    die ("ERROR: Why is the tip less than 0?!");
  }

  $tip = $billSubtotal * $tipPercentage;
  $total = $billSubtotal + $tip;

  $data = [ 'success' => true, 'tip' => $tip, 'total' => $total ];
  header('Content-Type: application/json');
  echo json_encode($data);

?>
