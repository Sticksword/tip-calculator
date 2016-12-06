<?php
  // * Note: Don't need to use isset to error check for post params because the ajax request always passes these 2.
  // There is possiblity of sending empty strings, which is checked for later in `is_numeric()` call.

  include('class.formValidator.php');

  $fv = new formValidator();
  // Although it would be nice to separate validation and processing, I feel like for this project, it is also unnecessary
  // I leave this here as a potential future todo if the project/calculator gets more advanced

  /*
  * Bill related validation
  */

  if (!is_numeric($_POST['bill-subtotal'])) {
    die ("ERROR: Bill subtotal isn't a number!");
  }

  $billSubtotal = floatval($_POST["bill-subtotal"]);
  if ($billSubtotal < 0) {
    die ("ERROR: Why is the bill subtotal less than 0?!");
  }

  /*
  * Tip related validation
  */

  $tipPercentage = $_POST["tip-percentage"];
  if (!is_numeric($tipPercentage)) {
    die ("ERROR: Tip percent isn't a number!");
  }

  if (!($tipPercentage >= 1 && $tipPercentage <= 99)) {
    die ("ERROR: Tip percentage has to be a number between 1 and 99.");
  }

  /*
  * Number of people related validation
  */

  $numPersons = $_POST["num-persons"];
  if (!is_numeric($numPersons)) {
    die ("ERROR: Number of people percent isn't a number!");
  }

  if (!ctype_digit($numPersons)) {
    die ("ERROR: Please enter a positive whole number of people...");
  }

  if (!($numPersons >= 1 && $numPersons <= 99)) {
    die ("ERROR: Number of people to split with has to be a number between 1 and 99. (if you input 0, nice try)");
  }

  /*
  * Calculation
  */

  $tipPercentage /= 100;
  $tip = $billSubtotal * $tipPercentage;
  $total = $billSubtotal + $tip;

  $individualTip = round($tip / $numPersons, 2);
  $individualTotal = round($total / $numPersons, 2);

  $data = [ 'success' => true,
            'tip' => $tip,
            'total' => $total,
            'split' => $numPersons > 1,
            'ind-tip' => $individualTip,
            'ind-total' => $individualTotal
          ];
  header('Content-Type: application/json');
  echo json_encode($data);

?>
