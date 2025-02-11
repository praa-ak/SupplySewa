<div class="flex" >
    <div>
    <h3>Transaction ID: {{$manifactureProduct['id']}}</h3>
    <h3 class="text-md">Product Name: {{$manifactureProduct['product']['name']}}</h3>
    <h3 class="text-md">Product ID: {{$manifactureProduct['product']['id']}}</h3>
    <h3>Qty: {{$manifactureProduct['qty']}}</h3>
    <h3>Supplied By: {{$manifactureProduct['manufacturer']['name']}}</h3>
    <h3>Destination: {{$manifactureProduct['distributor']['name']}}</h3>

</div>
<div>

    {!! QrCode::size(100)->generate(asset('distributor/manifacture-products/'.$manifactureProduct['id'].'/edit')); !!}
</div>
    </div>
