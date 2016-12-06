<html>
  <head>
    <title>Tip Calculator</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <div class="container">
      <h2>Tip Calculator</h2>
      <form method="post" id="calculateTipForm">
        <label for="bill-subtotal">Bill subtotal: $</label>
        <input type="text" id="bill-subtotal" placeholder="eg. 100">
        <br>

        <?php
        $options = [10, 15, 20];
        for ($i = 0; $i < count($options); $i++) { ?>
          <input type="radio" name="tip-percentage" value="<?php echo $options[$i] ?>">
          <label for="tip-percentage"><?php echo $options[$i] + "%"; ?></label>
        <?php } ?>
        <br>

        <input type="radio" name="tip-percentage" value="Custom">
        <label for="tip-percentage">Custom</label>
        <input type="text" id="custom-tip" placeholder="eg. 18.5">%
        <br>

        Split: <input type="text" id="num-persons" placeholder="eg. 2"> person(s)

        <button type="submit" class="" id="form-submit">Calculate Tip</button>
      </form>

      <div id="result">
        <div id="result-tip"></div>
        <div id="result-total"></div>
        <div id="tip-individual"></div>
        <div id="total-individual"></div>
      </div>
      <div id="error-message">

      </div>
    </div>

    <!-- Latest jQuery file taken on 2-13-2016 -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
  </body>
</html>
