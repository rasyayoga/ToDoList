<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/7692/7692809.png" type="image/x-icon"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Registation</title>
</head>
<body>
    <div class="container py-5">
        <div class="w-50 center border rounded px-3 py-3 mx-auto">
        <h1>Registation</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $item)
                <li>{{ $item }}</li>
                @endforeach
            </div>
        @endif
        <form action="{{ route('registation.user') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" name="username" class="form-control" value="{{ old('username') }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" value="{{ old('password') }}">
            </div>
            <div class="mb-3 d-grid">
                <button name="submit" type="submit" class="btn btn-primary">Registation</button>
            </div>
        </form>
        <p class="d-block text-end">
            <a href="{{ route('login') }}" class="text-decoration-none">Login ?</a>
        </p>     
    </div> 
    </div>
</body>
</html>