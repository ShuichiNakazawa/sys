<!-- resources/views/rooms/index.blade.php -->
@extends('layouts.not_app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div class="card-body ">
  <div>
    <h4 style="display: block; text-align: center;">チケット購入</h4>

    <section>
      <div class="product">
        <img
          src="https://i.imgur.com/EHyR2nP.png"
          alt="The cover of Stubborn Attachments"
        />
        <div class="description">
          <h3>Stubborn Attachments</h3>
          <h5>$20.00</h5>
        </div>
      </div>
      <button type="button" id="checkout-button">Checkout</button>
    </section>

  </div>
</div>
@endsection

@section('footer')
<div class="container copyright">
    ©2020 lara-assist.jp
</div>
@endsection

@section('script')

<script type="module">
  // Create an instance of the Stripe object with your publishable API key
  var stripe = Stripe("pk_test_51IrwPCIGn1OXhDRnA1FggQtYdT4KUffGN31HTmM6TYvJY1GoBEOZbaB7aUM3Jb7NtzPwg97MmEjUOviW41GtCfF700627z9QoZ");
  var checkoutButton = document.getElementById("checkout-button");
  checkoutButton.addEventListener("click", function () {
    console.log('ボタン押下判定');
    fetch("/create-checkout-session", {
      method: "POST",
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (session) {
        return stripe.redirectToCheckout({ sessionId: session.id });
      })
      .then(function (result) {
        // If redirectToCheckout fails due to a browser or network
        // error, you should display the localized error message to your
        // customer using error.message.
        if (result.error) {
          alert(result.error.message);
        }
      })
      .catch(function (error) {
        console.error("Error:", error);
      });
  });
</script>

@endsection