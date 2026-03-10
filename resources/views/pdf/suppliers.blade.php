<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Proveedores</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .header { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Lista de Proveedores Registrados</h1>
    <table>
        <thead>
            <tr class="header">
                <th>Nombre</th>
                <th>Numero de telefono</th>
                <th>Descripcion</th>
                <th>Ultimo abastecimiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($supplies as $supply)
            <tr>
                <td>{{ $supply->name }}</td>
                <td>{{ $supply->phone_number }}</td>
                <td>{{ $supply->description }}</td>
                <td>{{ $supply->last_supply }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>