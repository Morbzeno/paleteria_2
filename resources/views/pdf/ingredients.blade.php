<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Ingredientes</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .header { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Lista de Ingredientes Registrados</h1>
    <table>
        <thead>
            <tr class="header">
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>precio</th>
                <th>Stock</th>
                <th>Proveedor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ingredients as $ingredient)
            <tr>
                <td>{{ $ingredient->name }}</td>
                <td>{{ $ingredient->description }}</td>
                <td>{{ $ingredient->price }}</td>
                <td>{{$ingredient->inventory->stock ?? 'Sin stock' }}</td>
                <td>{{ $ingredient->supplier->name ?? 'Sin proveedor' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>