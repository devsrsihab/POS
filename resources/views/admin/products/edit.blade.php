<div class="panel-body">
    <form id="productUpdateForm" method="post">
        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="name">Product Name</label>
            <input name="product_name" type="text" class="form-control" id="product_name" placeholder="Enter Product Name" value="{{ $product->product_name }}">
            <div class="product_name-error text-danger error d-none "></div>
        </div>

        <div class="form-group">
            <label for="phone">Product Garage</label>
            <input name="product_garage" type="text" class="form-control" id="product_garage" placeholder="Enter Product Garage" value="{{ $product->product_garage }}">
            <div class="product_garage-error text-danger error d-none "></div>
        </div>
        
        <div class="form-group">
            <label for="product_route">Product Route</label>
            <input name="product_route" type="text" class="form-control" id="product_route" placeholder="Enter Product Route" value="{{ $product->product_route }}">
            <div class="product_route-error text-danger error d-none "></div>
        </div>

        <div class="form-group">
            <label for="sup_id">Supplier</label>
            <select class="form-control" id="sup_id" name="sup_id">

              <option selected disabled>Select Supplier</option>
              @forelse ($suppliers as  $supplier)
              <option {{ $product->sup_id == $supplier->id ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
              @empty
              
              @endforelse            

            </select>
            <div class="sup_id-error text-danger error d-none "></div>

          </div>

        <div class="form-group">
            <label for="cat_id">Categorie</label>
            <select class="form-control" id="cat_id" name="cat_id">

              <option selected disabled>Select Categorie</option>
              @forelse ($categories as  $categorie)
              <option {{ $product->cat_id == $categorie->id ? 'selected' : '' }}  value="{{ $categorie->id }}">{{ $categorie->cate_name }}</option>
              @empty
              @endforelse            

            </select>
            <div class="cat_id-error text-danger error d-none "></div>

          </div>

        <div class="form-group">
            <label for="product_image">Product Image</label>
            <input name="product_image" type="file" class="form-control" id="product_image" >
            <img style="height:90px;margin-top:15px;margin-bottom:35px;" src="{{ asset('uploads/Products/'. $product->product_image) }}" alt="">
            <div class="product_image-error text-danger error d-none "></div>
        </div>


        <div class="form-group">
            <label for="buy_date">Buy Date</label>
            <input name="buy_date" type="date" class="form-control" id="buy_date" placeholder="Enter Buy Date" value="{{ $product->expire_date }}">
            <div class="buy_date-error text-danger error d-none "></div>
        </div>


        <div class="form-group">
            <label for="expire_date">Expiring Date</label>
            <input name="expire_date" type="date" class="form-control" id="expire_date" placeholder="Enter Expiring Date" value="{{ $product->expire_date }}">
            <div class="expire_date-error text-danger error d-none "></div>
        </div>


        <div class="form-group">
            <label for="buying_price">Buying Price</label>
            <input name="buying_price" type="text" class="form-control" id="buying_price" placeholder="Enter Buying Price" value="{{ $product->buying_price }}">
            <div class="buying_price-error text-danger error d-none "></div>
        </div>

        <div class="form-group">
            <label for="selling_price">Selling Price</label>
            <input name="selling_price" type="text" class="form-control" id="selling_price" placeholder="Enter Selling Price" value="{{ $product->selling_price }}">
            <div class="selling_price-error text-danger error d-none "></div>
        </div>

        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
        <button type="button" class="btn  bootbox-close-button  btn-danger waves-effect waves-light">Cancel</button>
    </form>
</div><!-- panel-body -->