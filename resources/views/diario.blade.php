<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diario</title>
</head>
<body>
    <h1>Importar Diario</h1>
    <form id="formulario" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file"
            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
            required>
            <button type="button" class="btn btn-success btn-user float-right mb-3"  id="boton1">Importar</button>
    </form>
    <script src="{{asset('mayorContable/diario.js')}}"></script>
</body>
</html>
