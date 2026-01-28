<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aspirasi Terselesaikan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .header p {
            font-size: 11px;
            margin: 3px 0;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-section p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px 5px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border: 1px solid #000;
            border-radius: 3px;
            font-size: 10px;
        }

        .student-info {
            line-height: 1.5;
        }

        .student-name {
            font-weight: bold;
        }

        .student-detail {
            font-size: 10px;
            color: #555;
        }

        .footer {
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .signature-box {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }

        @media print {
            body {
                padding: 15px;
            }

            .no-print {
                display: none !important;
            }

            @page {
                margin: 1cm;
            }

            tr {
                page-break-inside: avoid;
            }

            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }
        }

        @media screen {
            .print-button {
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 10px 20px;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
                z-index: 1000;
            }

            .print-button:hover {
                background-color: #218838;
            }

            .back-button {
                position: fixed;
                top: 20px;
                right: 140px;
                padding: 10px 20px;
                background-color: #6c757d;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
                z-index: 1000;
                text-decoration: none;
                display: inline-block;
            }

            .back-button:hover {
                background-color: #5a6268;
            }
        }
    </style>
</head>
<body>
    <!-- Print Button (only visible on screen) -->
    <a href="{{ route('admin.aspirasi-selesai.index', request()->all()) }}" class="back-button no-print">← Kembali</a>
    <button onclick="window.print()" class="print-button no-print">🖨️ Print</button>

    <!-- Header -->
    <div class="header">
        <h1>Laporan Aspirasi Terselesaikan</h1>
        <p>Sistem Informasi Aspirasi Siswa</p>
    </div>

    <!-- Info Section -->
    <div class="info-section">
        <p><strong>Tanggal Cetak:</strong> {{ now()->format('d/m/Y H:i') }} WIB</p>
        @if(request('kategori_id'))
            <p><strong>Filter Kategori:</strong> {{ $kategoris->find(request('kategori_id'))->ket_kategori ?? '-' }}</p>
        @else
            <p><strong>Filter Kategori:</strong> Semua Kategori</p>
        @endif
        @if(request('search'))
            <p><strong>Pencarian:</strong> "{{ request('search') }}"</p>
        @endif
        <p><strong>Total Data:</strong> {{ $aspirasis->count() }} aspirasi</p>
    </div>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="15%">Siswa</th>
                <th width="10%">Kategori</th>
                <th width="12%">Lokasi</th>
                <th width="10%">Tgl Kejadian</th>
                <th width="22%">Keterangan</th>
                <th width="17%">Feedback</th>
                <th width="10%">Diselesaikan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aspirasis as $index => $aspirasi)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    <div class="student-info">
                        <div class="student-name">{{ $aspirasi->siswa->nama ?? '-' }}</div>
                        <div class="student-detail">NISN: {{ $aspirasi->siswa->nisn ?? '-' }}</div>
                        @if($aspirasi->siswa->kelas)
                            <div class="student-detail">{{ $aspirasi->siswa->kelas }} {{ $aspirasi->siswa->jurusan ?? '' }}</div>
                        @endif
                    </div>
                </td>
                <td class="text-center">
                    <span class="badge">{{ $aspirasi->kategori->ket_kategori ?? '-' }}</span>
                </td>
                <td>{{ $aspirasi->inputAspirasi->lokasi ?? '-' }}</td>
                <td class="text-center">
                    {{ $aspirasi->inputAspirasi->tanggal ? $aspirasi->inputAspirasi->tanggal->format('d/m/Y') : '-' }}
                </td>
                <td>{{ $aspirasi->inputAspirasi->keterangan ?? '-' }}</td>
                <td>{{ $aspirasi->feedback ?? '-' }}</td>
                <td class="text-center">
                    {{ $aspirasi->updated_at->format('d/m/Y') }}<br>
                    <small>{{ $aspirasi->updated_at->format('H:i') }}</small>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center" style="padding: 30px;">
                    Tidak ada data aspirasi terselesaikan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer with signature -->
    <div class="footer no-print">
        <div class="signature-section">
            <div class="signature-box">
                <p>Mengetahui,</p>
                <p><strong>Kepala Sekolah</strong></p>
                <div class="signature-line">
                    <p>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>
                </div>
            </div>
            <div class="signature-box">
                <p>{{ now()->format('d F Y') }}</p>
                <p><strong>Petugas</strong></p>
                <div class="signature-line">
                    <p>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto print when page loads (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
