<div class="flex" >
    <div>
    <h3>Transaction ID: {{$distributorProduct['id']}}</h3>
    <h3 class="text-md">Product Name: {{$distributorProduct['product']['name']}}</h3>
    <h3 class="text-md">Product ID: {{$distributorProduct['product']['id']}}</h3>
    <h3>Qty: {{$distributorProduct['qty']}}</h3>
    <h3>Supplied By: {{$distributorProduct['distributor']['name']}}</h3>
    <h3>Destination: {{$distributorProduct['retailer']['name']}}</h3>

</div>
<div>
    
    {!! QrCode::size(100)->generate(asset('retailer/distributor-products/'.$distributorProduct['id'].'/edit')); !!}
</div>
    </div>
