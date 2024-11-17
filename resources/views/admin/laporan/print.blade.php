<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <style>
        /* Gaya untuk cetak */
        @media print {
            body {
                font-family: Arial, sans-serif;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            table,
            th,
            td {
                border: 1px solid black;
            }

            th,
            td {
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .kop-surat {
                text-align: center;
                margin-bottom: 20px;
            }

            .kop-surat h1,
            .kop-surat h2,
            .kop-surat p {
                margin: 0;
            }

            .kop-surat h1 {
                font-size: 24px;
                font-weight: bold;
            }

            .kop-surat h2 {
                font-size: 20px;
            }

            .kop-surat p {
                font-size: 14px;
            }

            /* Menghilangkan elemen yang tidak ingin dicetak */
            .no-print {
                display: none;
            }
        }

        /* Gaya untuk tampilan layar */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat h1,
        .kop-surat h2,
        .kop-surat p {
            margin: 0;
        }

        .kop-surat h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .kop-surat h2 {
            font-size: 20px;
        }

        .kop-surat p {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <!-- KOP SURAT -->
    <div class="kop-surat">
        <h1>Nama Instansi</h1>
        <h2>Alamat Lengkap</h2>
        <p>Telepon: (021) 12345678 | Email: info@instansi.com</p>
        <hr>
    </div>

    <!-- Tabel Laporan -->
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Obat</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->obat }}</td>
                    <td>{{ $item->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
