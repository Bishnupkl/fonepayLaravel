<!DOCTYPE html>
<html>
<head>
    <title>ESEWA Payment Gateway</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="pt-md-5">
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="imagecontainer" style="height: 400px">
                        <img src="{{asset('img/'.$product->image)}}" class="card-img-top" alt="..." style="width: 100%; height: 100%;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$product->title}}</h5>
                        <p class="card-text">Rs. {{$product->amount}}</p>
                        <p class="card-text">{{$product->description}}</p>
                        <form action="{{route('checkout')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="submit" name="submit" value="Buy Now" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
