<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>
        @if (isset($title))
            {{$title}}
        @else
            'Judul Kosong'
        @endif
        </h1>

        <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nama</th>
            <th scope="col">Kategori</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Harga Jual</th>
          </tr>
        </thead>
        <tbody>
            @if (count($products)>0)
            @foreach ($products as $prod)
            <tr>
                <th scope="row">{{$prod->id}}</th>
                <td>{{$prod->nama}}</td>
                <td>{{$prod->nama_kategori}}</td>
                <td>{{$prod->harga_beli}}</td>
                <td>{{$prod->harga_jual}}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td>BELUM ADA DATA</td>
            </tr>
            @endif

        </tbody>
      </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>
