<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mayor Contable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-dark bg-primary">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Mayor Contable</span>
            </div>
        </nav>
        <form id="frmDiarioMayor">
            @csrf
        <div class="row">
            <div class="col">
                <label for="exampleInputEmail1" class="form-label">Cuenta</label>
                <input type="text" class="form-control" id="cuenta_contable" name="cuenta_contable" aria-describedby="Cuenta">
            </div>
            <div class="col py-4">
                <input type="text" class="form-control" id="nom_cuenta" aria-describedby="Nombre Cuenta" readonly>
            </div>
            <div class="col">
                <label for="exampleInputEmail1" class="form-label">Año Fiscal</label>
                <input type="year" class="form-control" id="aniofisc" aria-describedby="Añio Fiscal" readonly>
            </div>
            <div class="col">
                <label for="exampleInputEmail1" class="form-label">Desde</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" aria-describedby="Fecha de Inicio">
              </div>
              <div class="col">
                <label for="exampleInputEmail1" class="form-label">Hasta</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" aria-describedby="Fecha de Fin">
              </div>
              <div class="col py-4">
                <button type="submit" class="btn btn-primary">Buscar</button>
              </div>

          </div>
        </form>
        <div class="table-responsive">
        <table class="table table-striped table-hover overflow-auto">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Diario</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Ref #</th>
                    <th scope="col">Debito</th>
                    <th scope="col">Credito</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Detalle</th>
                </tr>
            </thead>
            <tbody id="diarios">
            </tbody>
        </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{asset('mayorContable/mayorContable.js')}}"></script>
</body>

</html>
