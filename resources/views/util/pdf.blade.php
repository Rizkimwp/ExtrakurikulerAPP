<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report PDF</title>
    <style>
        /* CSS untuk styling PDF */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Terbaru</h1>
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Extrakurikuler</td>
                    <td>{{ $extra }}</td>
                </tr>
                <tr>
                    <td>Blog</td>
                    <td>{{ $posts }}</td>
                </tr>
                <tr>
                    <td>Siswa</td>
                    <td>{{ $siswa }}</td>
                </tr>
                <tr>
                    <td>Peserta Extrakurikuler</td>
                    <td>{{ $member }}</td>
                </tr>
                <!-- Tambahkan baris lain sesuai kebutuhan -->
            </tbody>
        </table>
    </div>
</body>
</html>
