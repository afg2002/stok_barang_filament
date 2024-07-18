<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
    <link href="{{asset('/js/tailwind.js')}}" rel="stylesheet">
    <style>
        /* Additional CSS styles can be placed here */
        @page {
            margin: 2cm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0.5cm 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body class="font-sans bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-4 text-center">Data Supplier</h2>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Nama</th>
                    <th class="py-2 px-4">Kontak</th>
                    <th class="py-2 px-4">Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                    <td class="py-2 px-4">{{ $supplier->id }}</td>
                    <td class="py-2 px-4">{{ $supplier->nama }}</td>
                    <td class="py-2 px-4">{{ $supplier->kontak }}</td>
                    <td class="py-2 px-4">{{ $supplier->alamat }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
