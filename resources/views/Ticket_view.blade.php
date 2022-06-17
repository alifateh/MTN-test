<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tickets</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <!-- Datatables CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Datatables JS CDN -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>View Tickets Records</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-4">
                    @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header bg-info text-white">Tickets List</div>
                        <div class="card-body">
                            <table id="dtBasicExample" class="table table-striped table-bordered table-sm"
                                cellspacing="0" width="100%">
                                <tr>
                                    <td>ID</td>
                                    <td>Movie Name</td>
                                    <td>Cost</td>
                                    <td>Tcap</td>
                                    <td>CCap</td>
                                    <td>Reserve</td>
                                </tr>
                                @foreach ($Tickets as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->Movie }}</td>
                                    <td>{{ $item->Cost }}</td>
                                    <td>{{ $item->TCap }}</td>
                                    <td>{{ $item->CCap }}</td>
                                    <td>
                                        @if((400 - ($item->TCap) ) > 0)
                                        <form method="POST" action="{{ url('reserve/'.$item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="quantity">Quantity (between 1 and
                                                    {{400 - ($item->TCap)}}):</label>
                                                <input type="hidden" id="id" name="id" value="{{ $item->id }}" />
                                                <input type="number" id="quantity" name="quantity" min="1"
                                                    max="{{400 - ($item->TCap)}}" required="required">
                                                <input type="submit" class="btn btn-primary">
                                            </div>
                                        </form>
                                        @else
                                        <span
                                            class="badge badge-pill badge-danger p-3">{{"Ticket capacity is reached"}}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>