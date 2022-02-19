@extends('layouts.app')

@section('content')
<!-- Start Cart  -->
<form action="{{url('/theway-shop/checkout/place')}}" method="post" name="form" class="mt-3 review-form-box collapse show validation" novalidate data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
    @csrf
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="checkout-address">
                    <div class="title-left">
                        <h3>Billing address</h3>
                    </div>
                    

                        <div class="row addDiv">

                            {{-- <form action="{{url('/checkout/place')}}" method="post" name="form" class="mt-3 review-form-box collapse show validation" novalidate data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form"> --}}
                            {{-- @csrf --}}
                            <input type="hidden" name="order_user_id" value="">
                            <div class="col-md-5 mb-3">
                                <label for="country">Country *</label>
                                <select name="order_country" id="country" class="form-control">
                                    <option value="India">India</option>
                                </select>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="state">State *</label>
                                <input type="text" id="state" class="form-control" name="order_state" placeholder="Enter State">
                                <div id="errorstate" class="error" style="color: red"><b> *Please Enter State.</b> </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="city">City *</label>
                                    <input type="text" id="city" class="form-control" name="order_city" placeholder="Enter City">
                                    <div id="errorcity" class="error" style="color: red"><b> *Please Enter City.</b> </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="zip">Pin Code *</label>
                                <input type="text" class="form-control" name="order_pin" id="zip" placeholder="Enter Pin Code" maxlength="6" pattern="/{0-9}/" required>
                                <div id="errorpin" class="error" style="color: red"><b> *Please Enter Pin.</b> </div>
                                <div id="errorpincheck" class="error" style="color: red"><b> *Please Enter Valid Pin.</b> </div>
                            </div>
                        </div>
                           {{-- </form> --}}
                       {{-- @endif --}}
                       {{-- for payment --}}
                        <hr class="mb-4">
                        <div class="title-left">
                            <h3>Payment</h3>
                        </div>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="cod" name="payment_method_name" type="radio" class="custom-control-input" value="COD" checked >
                                <label class="custom-control-label" for="cod">COD</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="stripe" name="payment_method_name" type="radio" class="custom-control-input" value="Stripe" >
                                <label class="custom-control-label" for="stripe">Stripe</label>
                            </div>
                        </div>
                        {{-- stripe payment --}}
                        <div class="stripePayment">
                            <div class='form-row row' >
                                <div class='col-md-12 hide error form-group'>
                                    <div class='alert-danger alert' style="display: none;">Fix the errors before you begin.</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" required> <small class="text-muted">Full name as displayed on card</small>
                                    <div class="invalid-feedback"> Name on card is required </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">Credit card number</label>
                                    <input type="text" class="form-control card-num" id="cc-number" placeholder="" required>
                                    <div class="invalid-feedback"> Credit card number is required </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration Month</label>
                                    <input type="text" class="form-control card-expiry-month" id="cc-expiration" placeholder="" required>
                                    <div class="invalid-feedback"> Expiration date required </div>
                                </div>
                                {{-- <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration Year</label>
                                    <input type="text" class="form-control card-expiry-year" id="" placeholder="" required>
                                    <div class="invalid-feedback"> Expiration date required </div>
                                </div> --}}
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label> <input
                                        class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                        type='text'>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">CVV</label>
                                    <input type="text" class="form-control card-cvc" id="cc-cvv" placeholder="" maxlength="3" required>
                                    <div class="invalid-feedback"> Security code required </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="payment-icon">
                                        <ul>
                                            <li><img class="img-fluid" src="{{ asset('theway-shop/images/payment-icon/1.png') }}" alt=""></li>
                                            <li><img class="img-fluid" src="{{ asset ('theway-shop/images/payment-icon/2.png') }}" alt=""></li>
                                            <li><img class="img-fluid" src="{{ asset ('theway-shop/images/payment-icon/3.png') }}" alt=""></li>
                                            <li><img class="img-fluid" src="{{ asset ('theway-shop/images/payment-icon/5.png') }}" alt=""></li>
                                            <li><img class="img-fluid" src="{{ asset ('theway-shop/images/payment-icon/7.png') }}" alt=""></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                   <!--  </form> -->
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <div class="odr-box">
                            {{-- <div class="title-left">
                                <h3>Shopping cart</h3>
                            </div> --}}
                            {{-- view cart data 
                             @if (count($cart_data)>0)
                                @foreach($cart_data as $cartItem)
                                @php
                                $variant = App\Models\Variant::where('id',$cartItem->variantId)->first();

                                $price = $variant->productSaleprice;
                                @endphp
                                @foreach($variantjson as $var)
                                    <input type="hidden" name="variant[]" value ="{{$var->variant}}"></p>
                                    <input type="hidden" name="variant[]" value ="{{$var->variant}}">
                                @endforeach  --}}
                                {{-- <div class="rounded p-2 bg-light">
                                    <div class="media mb-2 border-bottom">
                                        <div class="media-body"> --}}
                                            {{-- <a href="#">{{$cartItem->get_product_name->productName}}</a> --}}
                                            {{-- <div class="small text-muted">
                                                Price:₹
                                                <span class="mx-2">|</span>
                                                Qty:
                                                <span class="mx-2">|</span>
                                                Subtotal:₹
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- @endforeach --}}
                            {{-- @endif --}}
                        </div>
                    </div>
                    {{-- @php
                    $sub_total = 0;
                    if(count($cart_data)>0){
                        foreach ($cart_data as $cartval) {
                            $sub_total += $cartval->quantity * $cartval->get_variant->productSaleprice;
                        }
                    }
                    @endphp --}}
                    input
                    <div class="col-md-12 col-lg-12">
                        <div class="order-box">
                            <div class="title-left">
                                <h3>Your order</h3>
                            </div>

                            <div class="d-flex">
                                <div class="font-weight-bold">Product</div>
                                <div class="ml-auto font-weight-bold">Total</div>
                            </div>
                            @php
                                $total=0;
                            @endphp
                    @foreach ($cartUserProduct as $cartUserProducts)
                    @foreach($products as $product)
                        @if($cartUserProducts->cart_product_id == $product->product_id)
                            @php
                                $images = explode(',',$product->product_images);
                                $image = $images[0];
                                $total += $product->product_sale_price;
                            @endphp
                            <hr class="my-1">
                            <div class="d-flex">
                                <h4>{{$product->product_name}} </h4>
                                <div class="ml-auto font-weight-bold"> ₹ {{$product->product_sale_price}}</div>
                            </div>
                            @endif
                            @endforeach
                            @endforeach
                            {{-- <hr class="my-1">
                            <div class="d-flex">
                                <h4>Sub Total</h4>
                                <div class="ml-auto font-weight-bold"> ₹</div>
                            </div> --}}
                            <hr>
                            <div class="d-flex gr-total">
                                <h5>Grand Total</h5>
                                <div class="ml-auto h5"> ₹ {{ $total }} </div>
                                <input type = "hidden" name = "payment_amount" value="{{ $total }}">
                            </div>
                            <hr>

                        </div>
                    </div>
                    {{-- @if (count($cart_data)>0) --}}
                    <button class="ml-auto btn hvr-hover placeorder" name="placeorder"  type="submit">Place Order</button>
                    {{-- @else --}}
                    <button class="ml-auto btn hvr-hover placeorder" name="placeorder"  type="submit" disabled>Place Order</button>
                    {{-- @endif --}}
                </div>
            </div>

        </div>
    </div>
</div>
</form>
<!-- End Cart -->
@endsection

@section('footer_scripts')
{{-- validation for address field --}}
<script>
$(document).ready(function(){
    var count = $("#count").val();
    if(count <= 0){
        $(".error").hide();
        $(".placeorder").click(function(){
        var address = $("#addressField").val();
        var state = $("#state").val();
        var city = $("#city").val();
        var pin = $("#zip").val();
        if(address == "")
        {
            $("#erroraddress").show();
            return false;
        }else{
            $("#erroraddress").hide();
        }
        if(state == "")
        {
            $("#errorstate").show();
            return false;
        }else{
            $("#errorstate").hide();
        }
        if(city == "")
        {
            $("#errorcity").show();
            return false;
        }else{
            $("#errorcity").hide();
        }
        if(pin == "")
        {
            $("#errorpin").show();
            $("#errorpincheck").hide();
            return false;
        }
        else if(isNaN(pin)){
            $("#errorpincheck").show();
            $("#errorpin").hide();
            return false;
        }
        else if(pin.length<6)
        {
            $("#errorpincheck").show();
            $("#errorpin").hide();
            return false;
        }
        else{
            $("#errorpincheck").hide();
            $("#errorpin").hide();
        }
    });
    }

});
</script>

{{-- for stripe payment --}}
<script>
$(document).ready(function(){
$(".stripePayment").hide();
  $("#cod").click(function(){
      $(".stripePayment").hide();
  });
  $("#stripe").click(function(){
      $(".stripePayment").show();
  });
});

</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">

$(function() {
var $form         = $(".validation");
$('form.validation').bind('submit', function(e) {
    var isChecked = $('#stripe').prop('checked');
    if (isChecked == true) {

        var $form         = $(".validation"),
        inputVal = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputVal),
        $errorStatus = $form.find('div.error'),
        valid         = true;
        $errorStatus.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorStatus.removeClass('hide');
                e.preventDefault();
            }
        });

        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-num').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeHandleResponse);
        }
    }
});

function stripeHandleResponse(status, response) {
    if (response.error) {
        $(".alert").show();
        // $('.error')
        //     .removeClass('hide')
        //     .find('.alert')
        //     .text(response.error.message);
    } else {
        var token = response['id'];
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
    }
}
});

</script>
@endsection
