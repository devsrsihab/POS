<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" style="width:150px;height:150px;border-radius:50%;object-fit:cover" width="150px" src="{{ asset('uploads/Products/'.$products->product_image) }}"><span class="text-black-50"><h3>{{ $products->product_name }}</h3></span><span> </span></div>
        </div>
        <div class="col-md-7 border-right">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h4 class="">Product Details</h4>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Product Name</h4>
                            <h5 class="text-capitalize">{{ $products->product_name }}</h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Product Categorie</h4>
                            <h5 class="text-capitalize">{{ $products->cate_name }}</h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Product Supplier</h4>
                            <h5 class="text-capitalize">{{ $products->name }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Product Code</h4>
                            <h4 class="text-capitalize">{{ $products->product_code }}</h4>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Product Garage</h4>
                            <h5 class="text-capitalize">{{ $products->product_garage }}</h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Product Route</h4>
                            <h5 class="text-capitalize">
                                {{ $products->product_route }}
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Buy Date</h4>
                            <h5 class="text-capitalize">
                                {{ $products->buy_date }}
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Expire Date</h4>
                            <h5 class="text-capitalize">
                                {{ $products->expire_date }}
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Buying Price</h4>
                            <h5 class="text-capitalize">
                                {{ $products->buying_price }}
                            </h5>
                        </div>
                    </div>
  
                    <div class="col-md-6">
                        <div class="details-group">
                            <h4>Selling Price</h4>
                            <h5 class="text-capitalize">
                                {{ $products->selling_price }}
                            </h5>
                        </div>
                    </div>


                </div>

        </div>

    </div>
    <div class="button-div text-right">
        <button type="button" class="bootbox-close-button  btn btn-danger">Close</button>
    </div>
</div>
</div>
</div>