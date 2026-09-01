<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Daftar Ulang - {{ $peserta->nama_peserta }}</title>
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 24px; background: #f3f4f6; color: #111; }
        .sheet { max-width: 800px; margin: 0 auto; background: #fff; padding: 32px; box-shadow: 0 2px 10px rgba(0,0,0,.08); }
        .header { display: flex; align-items: center; gap: 16px; border-bottom: 3px solid #15803d; padding-bottom: 16px; }
        .header img { width: 72px; height: 72px; object-fit: contain; }
        .header h1 { margin: 0; font-size: 20px; color: #166534; }
        .header p { margin: 4px 0 0; font-size: 13px; color: #4b5563; }
        .meta { display: flex; justify-content: space-between; gap: 16px; margin: 20px 0; }
        .box { flex: 1; border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; }
        .box h3 { margin: 0 0 8px; font-size: 13px; color: #6b7280; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #d1d5db; padding: 8px 10px; font-size: 13px; }
        th { background: #dcfce7; text-align: left; }
        .right { text-align: right; }
        .total { font-weight: bold; background: #f0fdf4; }
        .status { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: bold; }
        .lunas { background: #dcfce7; color: #166534; }
        .belum { background: #fee2e2; color: #991b1b; }
        .actions { margin-bottom: 16px; text-align: right; }
        .btn { display: inline-block; background: #15803d; color: #fff; padding: 8px 16px; border: 0; border-radius: 6px; cursor: pointer; text-decoration: none; font-size: 14px; }
        .note { margin-top: 18px; font-size: 12px; color: #4b5563; line-height: 1.5; }
        @media print {
            body { background: #fff; padding: 0; }
            .actions { display: none; }
            .sheet { box-shadow: none; }
        }
    </style>
</head>
<body>
    <div class="actions">
        <button class="btn" onclick="window.print()">Unduh / Cetak Invoice</button>
    </div>
    <div class="sheet">
        <div class="header">
            <img src="{{ asset('icon.png') }}" alt="Al Syukro Universal">
            <div>
                <h1>Al Syukro Universal</h1>
                <p>Penerimaan Siswa Baru</p>
                <p>Kota Tangerang Selatan, Prov. Banten</p>
            </div>
        </div>

        <h2 style="margin: 20px 0 8px; font-size: 18px;">Invoice Registrasi Daftar Ulang</h2>
        <p style="margin: 0 0 16px; font-size: 13px; color: #6b7280;">Dicetak: {{ now()->translatedFormat('d F Y H:i') }}</p>

        <div class="meta">
            <div class="box">
                <h3>Data Peserta</h3>
                <p><strong>{{ $peserta->nama_peserta }}</strong></p>
                <p>No. Pendaftaran: {{ $peserta->no_pendaftaran }}</p>
                <p>Sekolah: {{ $peserta->fakultas ?? '-' }}</p>
                <p>Jurusan: {{ $peserta->prodi ?? '-' }}</p>
            </div>
            <div class="box">
                <h3>Pembayaran</h3>
                <p>Virtual Account: <strong>{{ $peserta->va_number }}</strong></p>
                <p>Status:
                    @if($peserta->status_pembayaran_registrasi == 1)
                        <span class="status lunas">LUNAS</span>
                    @else
                        <span class="status belum">BELUM LUNAS</span>
                    @endif
                </p>
                @if($peserta->tgl_bayar_regis)
                    <p>Tanggal Bayar: {{ \Carbon\Carbon::parse($peserta->tgl_bayar_regis)->translatedFormat('d F Y') }}</p>
                @endif
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width:40px;">No</th>
                    <th>Nama Pembayaran</th>
                    <th class="right">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($detail as $i => $row)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $row['nama_tagihan'] ?? '-' }}</td>
                        <td class="right">Rp {{ number_format((int)($row['biaya'] ?? $row['nominal'] ?? 0), 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center;">Tidak ada rincian tagihan</td>
                    </tr>
                @endforelse
                <tr class="total">
                    <td colspan="2" class="right">Total Tagihan Daftar Ulang</td>
                    <td class="right">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="note">
            Pembayaran daftar ulang hanya melalui Virtual Account di atas. Simpan invoice ini sebagai bukti tagihan.
            @if($peserta->batas_akhir_registrasi)
                Batas daftar ulang: {{ \Carbon\Carbon::parse($peserta->batas_akhir_registrasi)->translatedFormat('d F Y') }}.
            @endif
        </div>
    </div>
    <script>window.addEventListener('load', function () { window.print(); });</script>
</body>
</html>
