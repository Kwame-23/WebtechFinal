<?php
  require_once "../functions/get_price.php";

  if (isset($_GET['id'])) {
    $dogID = $_GET['id'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/pay.css">
    <title>Document</title>
</head>
<body>
<form id="paymentForm">
  <div class="form-group">
    <label for="email">Email Address</label>
    <input type="email" id="email-address" required />
  </div>
  <div class="form-group">
    <label for="amount">Amount</label>
    <input type="number" id="amount" name="amount" value="<?= getPrice($dogID)?>" min="0" step="0.01" required readonly><br><br>
  </div>
  <div class="form-group">
    <label for="first-name">First Name</label>
    <input type="text" id="first-name" />
  </div>
  <div class="form-group">
    <label for="last-name">Last Name</label>
    <input type="text" id="last-name" />
  </div>
  <div class="form-submit">
    <button type="button" id="payButton">Pay</button>
  </div>
</form>

<script src="https://js.paystack.co/v1/inline.js"></script>
      
<script>
document.getElementById('payButton').addEventListener('click', payWithPaystack);

function payWithPaystack() {
  var handler = PaystackPop.setup({
    key: 'pk_test_9d671936a848ef3f08f439a186af60d1b69a266d', 
    email: document.getElementById('email-address').value,
    amount: document.getElementById('amount').value * 100, 
    currency: 'GHS', 
    ref: '', 
    callback: function(response) {
      var reference = response.reference;
      window.location.href = '../views/dashboard.php';
      // Make an AJAX call to your server with the reference to verify the transaction
    },
    onClose: function() {
      alert('Transaction was not completed, window closed.');
    },
  });
  handler.openIframe();
}
</script>
</body>
</html>