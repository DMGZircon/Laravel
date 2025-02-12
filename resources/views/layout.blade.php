<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* .page-title {
                text-align: center;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 3rem;
                margin-top: 20px;
            }
            .content-container {
                margin-top: 70px;
            } */
            .logout-btn {
                top: 20px;
                right: 20px;
                }
             .header-container{ 
                display: flex;
                align-items:center;
                justify-content: space-between;
                padding: 20px;
                background: #ffffff;
            }
        </style>
    </head>
    <body class="container">
        <div class="header-container">
            <h1 class="text-center page-title">To-Do List</h1>
            <form method="POST" action="{{ route('logout') }}" class="d-inline logout-btn">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
        <div class="content-container">
            @yield(section: 'content')
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
