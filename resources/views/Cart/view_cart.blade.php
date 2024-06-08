<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .card
    {
        width: 50%; /* Adjust the width of the table */
        border-collapse: collapse; /* Collapse borders between cells */
        margin: 0 auto; /* Center the table horizontally */
        background-color: #e6f2ff;

    }
    
    th, td {
        padding: 8px; /* Add padding to table cells */
        text-align: left; /* Align text to the left */
        border-bottom: 1px solid #ddd; /* Add bottom border to cells */
    }

    tr:nth-child(even) {
        background-color: #f2f2f2; /* Add background color to even rows */
    }

    th {
        background-color: #4CAF50; /* Add background color to table header */
        color: white; /* Set text color in table header */
    }
 /* Selectors can be any valid CSS selector, such as tag names, class names, or IDs */
body {
    font-family: Arial, sans-serif; /* Set the font family */
    font-size: 16px; /* Set the font size */
    font-weight: normal; /* Set the font weight (normal, bold, etc.) */
    color: #333; /* Set the text color */
    text-align: left; /* Set the text alignment */
    line-height: 1.5; /* Set the line height */
}

h1 {
    font-size: 24px; /* Example of styling specific elements */
    font-weight: bold;
    color: #0066cc;
    text-decoration: underline;
}

p {
    margin-bottom: 20px; /* Example of adding margin to paragraphs */
}

a {
    color: #009900; /* Example of styling links */
    text-decoration: none; /* Remove underline from links */
}

/* Example of using a class selector */
.highlight {
    background-color: yellow;
}

/* Example of using an ID selector */
#footer {
    font-size: 14px;
    color: #666;
}

.title
{
    color: #0066cc; /* Dark blue */
    font-size: 20px;
    text-align:center;
    font-style:italic;
}

</style>
<body>
<nav class="navbar navbar-light bg-warning justify-content-between px-4">
  <a class="navbar-brand title" href="#">My Products</a>
  <div class="form-inline">
  <div class="row">
    <div class="col-auto">
        <a class="btn btn-outline-success my-2 my-sm-0" href="{{route('product_list')}}">Back</a>
    </div>
    <div class="col-auto">
      <a class="btn btn-outline-success my-2 my-sm-0" href="{{route('view_cart')}}">My Cart</a>
    </div>
  </div>
</div>
</nav>
<div class="text-center mt-3 mb-3">
    <h4 class="title">My Cart Products</h4>
</div>

<div class="container">
    @if($cart_item->isNotEmpty())
        @foreach($cart_item as $cart)
        <div class="card mb-4">
        <div class="card-header">
        Product Name - {{$cart->Product_Details->name}}
        </div>
        <div class="card-body">
        <h5 class="card-title">Quantity: {{$cart->qty}}</h5>
        <p class="card-text">Price: {{$cart->Price}}</p>
        <label>Add Quantity</label><br>
        <select class="selectOption form-select" data-product-id="{{$cart->product_id}}">
            @for($i = 1; $i <= 10; $i++)
                <option value="{{$i}}" {{$cart->qty == $i ? 'selected' : ''}}>{{$i}}</option>
            @endfor
        </select><br>
        <button class="removeButton btn btn-danger" data-product-id="{{$cart->product_id}}">Remove</button>
    </div>
    </div>

        @endforeach
        <p class="title">Total Price: {{$cart->total_price->total_price}}</p>
    @else
        <p>There is No Product in your cart.</p>
    @endif
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.selectOption').change(function() {
            var selectedValue = $(this).val();
            var productId = $(this).data('product-id');
            var $selectOption = $(this); // Cache the reference to the current select element

            $.ajax({
                url: "add-moreqty", // Specify your URL here
                type: "GET", // Or "GET" depending on your server's endpoint
                data: {
                    value: selectedValue, // The selected value from the dropdown
                    productId: productId // The product ID
                },
                success: function(response) {
                    // Handle success response from the server
                    console.log("Values sent successfully");
                    console.log("Server response:", response);
                    location.reload(); // Reload the page after successful request
                },
                error: function(xhr, status, error) {
                    // Handle error response from the server
                    console.error("Error sending values:", error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.removeButton').click(function() {
            var productId = $(this).data('product-id');

            $.ajax({
                url: "/remove-from-cart", // Specify your URL here
                type: "GET", // Or "GET" depending on your server's endpoint
                data: {
                    productId: productId // The product ID to remove
                },
                success: function(response) {
                    // Handle success response from the server
                    console.log("Product removed successfully");
                    console.log("Server response:", response);
                    location.reload(); // Reload the page after successful request
                },
                error: function(xhr, status, error) {
                    // Handle error response from the server
                    console.error("Error removing product:", error);
                }
            });
        });
    });
</script>


</body>
</html>