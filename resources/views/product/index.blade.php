<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style type="text/css">
      
    </style>
</head>
<body>

<div class="container pt-2">
    <div class="row ">
        <div class="col-9">
            <h2 class="h2">Add products</h2>
            <form class="add_product_form">
                @csrf 
              <div class="form-group">
                <label class="text-muted" for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name">
                  <span  class="text-danger"  product_name_error></span>
              </div>
              <div class="form-group">
                <label class="text-muted" for="product_description">Product description</label>
                <input type="text" class="form-control" name="product_description" id="product_description" placeholder="Product description">
               <span  class="text-danger"  product_description_error></span>
              </div>
               <div class="form-group">
                <label class="text-muted" for="quantity_in_stock">Quantity in stock</label>
                <input type="text" class="form-control" id="quantity_in_stock" name="quantity_in_stock" placeholder="Quantity in stock">
                <span  class="text-danger"  quantity_in_stock_error></span>
              </div>
               <div class="form-group">
                <label class="text-muted"  for="price_per_item">Price per item</label>
                <input type="text" class="form-control" id="price_per_item" placeholder="Price per item" name="price_per_item">
                <span  class="text-danger"  price_per_item_error></span>
              </div>
                <button type="submit" id="add_product" class="btn btn-success">Add product</button>
            </form>
        </div>
    </div>
  <h2 class="pt-2">Product List</h2> 

  <table class="table table-responsive">
    <thead class="thead-light">
      <tr>
        <th>Product name</th>
        <th>Product description</th>
        <th>Quantity in stock</th>
        <th>Price per item</th>
        <th>Date</th>
        <th>Total value </th>
      </tr>
    </thead>
    <tbody>
        @if($products->isNotEmpty())
            @foreach($products as $key => $product)
                @if(is_array($product->products_details))
                    <tr>
                        <td>{{$product->products_details["product_name"] ?? null}}</td>
                        <td>{{$product->products_details["product_description"] ?? null}}</td>
                        <td>{{$product->products_details["quantity_in_stock"] ?? 0}}</td>
                        <td>{{$product->products_details["price_per_item"] ?? 0}}</td> 
                        <td>{{(new Carbon\Carbon )->diffForHumans(
                                $product->products_details["created_at"]
                            )}}</td>
                        <td>{{($product->products_details["quantity_in_stock"] ?? 0 ) * ($product->products_details["price_per_item"] ?? 0) }}</td>
                     
                    </tr>

                @endif 
            @endforeach
          
                 @else 
                    <td></td>
                    <td></td>
                    <td>
                        <h4 class="h4  "> No Products</h4>
                    </td>
                    <td></td>
                    <td></td>
            
        @endif
           
    </tbody>
  
  </table>
     @if($products->isNotEmpty())
                {{$products->links()}}
            @endif
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <script type="text/javascript">
      $("#add_product").click(function(e) {
        e.preventDefault()
       var  form = $(this).parents("form")[0] ;
       console.log(form );
       var formData = new FormData(form);
        
       $.ajax({
            url: '/products', 
            type: 'POST',
            data: formData,  
            processData: false,                         
            contentType:false
          }).done(function(product){
   
          
             $("table.table").prepend (
                "<tr>" +
                    "<td>" + product.product_name + "</td>" +
                    "<td>" + product.product_description + "</td>" +
                    "<td>" + product.quantity_in_stock+ "</td>" +
                    "<td>" + product.price_per_item + "</td>" +
                    "<td>" + product.created_at+ "</td>"  +
                    "<td>" + (product.quantity_in_stock * product.price_per_item) + "</td>" 
                + "</tr>"
            );
          }).fail(function(error){
           
             if(error.status == 422) {
                  $.each(error.responseJSON.errors, function (key, val) {
                     $("span["+key+"_error]").text(val[0]);
                });
                return false;
            }

        });
});

  </script>
</body>
</html>
