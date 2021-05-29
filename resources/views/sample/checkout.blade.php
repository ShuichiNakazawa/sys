<html>
  <head>
    <title>Buy cool new product</title>
  </head>
  <body>
    <button id="checkout-button">Checkout</button>
    
    <script type="text/javascript">
      // Create an instance of the Stripe object with your publishable API key
      //var stripe = Stripe('pk_test_51IrwPCIGn1OXhDRnA1FggQtYdT4KUffGN31HTmM6TYvJY1GoBEOZbaB7aUM3Jb7NtzPwg97MmEjUOviW41GtCfF700627z9QoZ');
      var stripe = Stripe('sk_test_51IrwPCIGn1OXhDRnsn4686SYweNTg3dMw91Ul9qcwoBhEsdMILD0rOP3LG5HO3UJcSzLR0g8qnpz2Jp1HPsRzeVg00yN4axhV2');

      var checkoutButton = document.getElementById('checkout-button');

      checkoutButton.addEventListener('click', function() {
        // Create a new Checkout Session using the server-side endpoint you
        // created in step 3.
        fetch('/create-checkout-session', {
          method: 'POST',
        })
        .then(function(response) {
          return response.json();
        })
        .then(function(session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function(result) {
          // If `redirectToCheckout` fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using `error.message`.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function(error) {
          console.error('Error:', error);
        });
      });
    </script>
  </body>
</html>