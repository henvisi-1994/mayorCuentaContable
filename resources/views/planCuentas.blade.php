<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plan de Cuentas</title>
</head>

<body>
    <h1>Importar Plan de Cuenta</h1>
    <form id="formulario" enctype="multipart/form-data" >
        @csrf
        <input type="file" name="file"
            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
            required>
            <button type="button" id="boton1" class="btn btn-primary">Importar</button>
    </form>
    <script src="{{asset('mayorContable/planCta.js')}}"></script>
</body>

</html>
