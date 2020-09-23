<!DOCTYPE html>
<html>
<head>
    <title>Response Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    @if(session('success_message'))
        <div class="alert alert-success">
            {{session('success_message')}}
        </div>
    @endif
        @if(session('error_message'))
            <div class="alert alert-danger">
                {{session('error_message')}}
            </div>
        @endif
</div>
</body>
</html>
