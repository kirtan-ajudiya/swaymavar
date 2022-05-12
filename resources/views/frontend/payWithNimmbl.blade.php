@extends('frontend.layouts.app')

@section('content')


<button id="nimbbl_button" style="display:none">Pay with Nimbbl</button>

<form name='nimbblpayform' action="{{ route('payment.nimbbl') }}" method="POST" >
    @csrf
    <input type="hidden" name="nimbbl_transaction_id" id="nimbbl_transaction_id">
    <input type="hidden" name="nimbbl_signature"  id="nimbbl_signature" >
    <input type="hidden" name="nimbbl_order_id"  id="nimbbl_order_id" >
    <input type="hidden" name="order_id"  id="order_id" >
    <input type="hidden" name="transaction_id"  id="transaction_id" >
    <input type="hidden" name="signature"  id="signature" >
    <input type="hidden" name="status"  id="status" >
    <input type="hidden" name="invoice"  id="invoice" value="{{ $invoice }}">

</form>
   
@endsection
<script src="https://api.nimbbl.tech/static/assets/js/checkout.js"></script>

@section('script')
<script>
    var options = {
        "access_key": "access_key_GZ3pw4kmYkEbVvbM", // Enter the Key ID generated from the Dashboard
        "order_id": '{{ $newOrder->order_id }}', // Enter the order_id from the create-order api
        "callback_handler": function (response) {
            document.getElementById('nimbbl_transaction_id').value = response.nimbbl_transaction_id;
            document.getElementById('nimbbl_signature').value = response.nimbbl_signature;
            document.getElementById('nimbbl_order_id').value = response.nimbbl_order_id;
            document.getElementById('order_id').value = response.order_id;
            document.getElementById('transaction_id').value = response.transaction_id;
            document.getElementById('signature').value = response.signature;
            document.getElementById('status').value = response.status;
            document.nimbblpayform.submit();
        },
        "custom": {
            "key_1": "val_1",
            "key_2": "val_2"
        },
    };

var checkout = new NimbblCheckout(options);

$( document ).ready(function() {
    checkout.open('{{ $newOrder->order_id }}');
    e.preventDefault();
});
</script>
@endsection