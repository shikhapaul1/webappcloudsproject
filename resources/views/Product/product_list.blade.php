<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<style>
    .table
    {
        width: 70%; /* Adjust the width of the table */
        border-collapse: collapse; /* Collapse borders between cells */
        margin: 0 auto; /* Center the table horizontally */

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
}

</style>

<body>
<nav class="navbar navbar-light bg-light justify-content-between px-4">
  <a class="navbar-brand title" href="#">My Products</a>
  <div class="form-inline">
  <div class="row">
    <div class="col-auto">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Back</button>
    </div>
    <div class="col-auto">
      <a class="btn btn-outline-success my-2 my-sm-0" href="{{route('view_cart')}}">My Cart</a>
    </div>
  </div>
</div>
</nav>
<div class="text-center mt-3 mb-3">
    <h4 class="title">Products</h4>
</div>
<div class="container">
    <table class="table table-bordered">
    <thead>
        <tr class="table-info">
        <th width="60px;" scope="col">Sl. No.</th>
        <th class="text-center">Product Name</th>
        <th class="text-center">Product Price</th>
        <th class="text-center">Product Description</th>
        <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $lists)
        <tr class="table-warning">
            <th scope="row">{{$loop->iteration}}</th>
            <td class="text-center">{{$lists->name}}</td>
            <td class="text-center">{{$lists->price}}</td>
            <td class="text-center">{{$lists->description}}</td>
            <td class="text-center"><a class="btn btn-info" href="{{route('add_cart', $lists->id)}}">Add to Cart</a></td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</html>