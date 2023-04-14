<div class="panel-body">
    <form id="productCreateForm" method="post">
        @csrf

        <div class="form-group">
            <label for="name">Product Name</label>
            <input name="product_name" type="text" class="form-control" id="product_name" placeholder="Enter Product Name">
            <div class="product_name-error text-danger error d-none "></div>
        </div>

        <div class="form-group">
            <label for="phone">Product Garage</label>
            <input name="product_garage" type="text" class="form-control" id="product_garage" placeholder="Enter Product Garage">
            <div class="product_garage-error text-danger error d-none "></div>
        </div>
        
        <div class="form-group">
            <label for="product_route">Product Route</label>
            <input name="product_route" type="text" class="form-control" id="product_route" placeholder="Enter Product Route">
            <div class="product_route-error text-danger error d-none "></div>
        </div>

        <div class="form-group">
            <label for="sup_id">Supplier</label>
            <select class="form-control" id="sup_id" name="sup_id">

              <option selected disabled>Select Supplier</option>
              @forelse ($suppliers as  $supplier)
              <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
              <option value="{{ $categorie->id }}">{{ $categorie->cate_name }}</option>
              @empty
              @endforelse            

            </select>
            <div class="cat_id-error text-danger error d-none "></div>

          </div>

        <div class="form-group">
            <label for="product_image">Product Image</label>
            <input name="product_image" type="file" class="form-control" id="product_image" >
            <div class="product_image-error text-danger error d-none "></div>
        </div>


        <div class="form-group">
            <label for="buy_date">Buy Date</label>
            <input name="buy_date" type="date" class="form-control" id="buy_date" placeholder="Enter Buy Date">
            <div class="buy_date-error text-danger error d-none "></div>
        </div>


        <div class="form-group">
            <label for="expire_date">Expiring Date</label>
            <input name="expire_date" type="date" class="form-control" id="expire_date" placeholder="Enter Expiring Date">
            <div class="expire_date-error text-danger error d-none "></div>
        </div>


        <div class="form-group">
            <label for="buying_price">Buying Price</label>
            <input name="buying_price" type="text" class="form-control" id="buying_price" placeholder="Enter Buying Price">
            <div class="buying_price-error text-danger error d-none "></div>
        </div>

        <div class="form-group">
            <label for="selling_price">Selling Price</label>
            <input name="selling_price" type="text" class="form-control" id="selling_price" placeholder="Enter Selling Price">
            <div class="selling_price-error text-danger error d-none "></div>
        </div>

        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
        <button type="button" class="btn  bootbox-close-button  btn-danger waves-effect waves-light">Cancel</button>
    </form>
</div><!-- panel-body -->