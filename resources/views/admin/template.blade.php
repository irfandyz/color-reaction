<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Colors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: {{\App\Models\Setting::first()->background}};
        }

        .min-h {
            min-height: 550px;
            border-radius: 20px;
        }

        .box-scroll {
            height: 490px;
            border-radius: 20px
        }

        .list-group {
            height: 520px;
            margin-bottom: 10px;
            overflow: scroll;
            -webkit-overflow-scrolling: touch;
            overflow-x: hidden;
        }

        .box-content {
            min-height: 550px;
            border-left: solid 2px black;
        }
    </style>
    @yield('style')
</head>

<body id="body">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <div class="container mt-4">
        <a href="{{ asset('admin') }}" class="btn btn-success"><i class="fas fa-star"></i> Scores</a>
        <a href="{{ asset('admin/setting') }}" class="btn btn-success"><i class="fas fa-cogs"></i> Settings</a>
        <a href="{{ asset('logout') }}" class="btn btn-danger"><i class="fas fa-sign-out"></i> Logout</a>
    </div>
    <div class="container bg-white min-h mt-4">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <div class="row">
            <div class="col-sm-3 p-2">
                <div class="panel-body">
                    <ul class="list-group">
                    @foreach ($user as $item)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    {{ $item->name }}
                                </div>
                                <div>
                                    <a href="{{ asset('admin?id='.$item->id) }}" class="badge "><i
                                            class="fas fa-magnifying-glass text-primary"></i></a>

                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-9 box-content p-2">
                @yield('content')
            </div>
        </div>
    </div>

</body>

</html>