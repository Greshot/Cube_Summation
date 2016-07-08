<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cube Summation</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <style>
        .footer {
            margin-top: 10%;
        }
    </style>
</head>
<body>
@include('modal')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="page-header">
                <h1>Cube Summation</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <form action="/cube" name="formCube" id="formCube">
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
            <div class="col-md-5">
                <label for="input"><h3>Entrada</h3></label>
                <textarea name="input" id="input" cols="30" rows="12" class="form-control" required></textarea>
            </div>
            <div class="col-md-2">
                <br><br><br><br><br><br><br><br>
                <button id="test" class="btn btn-success btn-block">Probar</button>
                <br><br><br><br><br><br><br><br>
            </div>
            <div class="col-md-5">
                <label for="result"><h3>Salida</h3></label>
                <textarea name="result" id="result" cols="30" rows="12" class="form-control" readonly></textarea>
            </div>
        </form>
    </div>
    <footer class="footer">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Descripción completa del ejercicio
                    <a href="https://www.hackerrank.com/challenges/cube-summation" target="_blank">Aquí</a></h3>
            </div>
        </div>
    </footer>
</div>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>