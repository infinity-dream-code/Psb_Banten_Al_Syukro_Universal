<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PesertaRegistrasiExport implements FromCollection, WithHeadings
{
    protected $peserta;

    public function __construct($peserta)
    {
        $this->peserta = $peserta;
    }

    public function collection()
    {
        return $this->peserta->map(function ($p, $i) {
            return [
                'no' => $i + 1,
                'no_pendaftaran' => $p->no_pendaftaran,
                'gelombang' => $p->gelombang,
                'jalur' => $p->jalur,
                'fakultas' => $p->fakultas,
                'prodi' => $p->prodi,
                'nama_peserta' => $p->nama_peserta,
                'nik' => $p->nik,
                'tempat_lahir' => $p->tempat_lahir,
                'tanggal_lahir' => $p->tanggal_lahir,
                'nisn' => $p->nisn,
                'no_akta_lahir' => $p->no_akta_lahir,
                'gender' => $p->gender,
                'agama' => $p->agama,
                'kewarganegaraan' => $p->kewarganegaraan,
                'email' => $p->email,
                'no_hp' => $p->no_hp,
                'alamat_lengkap' => $p->alamat_lengkap,
                'alamat_sekolah' => $p->alamat_sekolah,
                'dusun' => $p->dusun,
                'kecamatan' => $p->kecamatan,
                'kabupaten' => $p->kabupaten,
                'provinsi' => $p->provinsi,
                'kode_pos' => $p->kode_pos,
                'nama_sekolah' => $p->nama_sekolah,
                'kota_sekolah' => $p->kota_sekolah,
                'provinsi_sekolah' => $p->provinsi_sekolah,
                'jurusan' => $p->jurusan,
                'tahun_lulus' => $p->tahun_lulus,
                'status_sekolah' => $p->status_sekolah,
                'ibu_nama' => $p->ibu_nama,
                'ibu_tanggal_lahir' => $p->ibu_tanggal_lahir,
                'ibu_nik' => $p->ibu_nik,
                'ibu_alamat' => $p->ibu_alamat,
                'ibu_suku' => $p->ibu_suku,
                'ibu_pendidikan' => $p->ibu_pendidikan,
                'ibu_pekerjaan' => $p->ibu_pekerjaan,
                'ibu_penghasilan' => $p->ibu_penghasilan,
                'ibu_no_tlp' => $p->ibu_no_tlp,
                'ayah_nama' => $p->ayah_nama,
                'ayah_tanggal_lahir' => $p->ayah_tanggal_lahir,
                'ayah_nik' => $p->ayah_nik,
                'ayah_alamat' => $p->ayah_alamat,
                'ayah_suku' => $p->ayah_suku,
                'ayah_pendidikan' => $p->ayah_pendidikan,
                'ayah_pekerjaan' => $p->ayah_pekerjaan,
                'ayah_penghasilan' => $p->ayah_penghasilan,
                'ayah_no_tlp' => $p->ayah_no_tlp,
                'jml_saudara_kandung' => $p->jml_saudara_kandung,
                'jml_saudara_yayasan' => $p->jml_saudara_yayasan,
                'nama_sumber' => $p->nama_sumber,
                'foto' => $p->foto,
                'no_kk' => $p->no_kk,
                'dokumen_kk' => $p->dokumen_kk,
                'dokumen_ktp_ortu' => $p->dokumen_ktp_ortu,
                'dokumen_akte_kelahiran' => $p->dokumen_akte_kelahiran,

          
                'no_kks' => $p->bantuan->no_kks ?? '',
                'no_kps' => $p->bantuan->no_kps ?? '',
                'usulan_pip' => $p->bantuan->usulan_pip ?? '',
                'nomor_kip' => $p->bantuan->nomor_kip ?? '',
                'nama_kip' => $p->bantuan->nama_kip ?? '',
                'alasan_menolak_kip' => $p->bantuan->alasan_menolak_kip ?? '',
                'no_reg_akta_lahir' => $p->bantuan->no_reg_akta_lahir ?? '',

                'va_number' => $p->va_number,
                'status_paid' => $p->status_paid,
                'status_pembayaran_registrasi' => $p->status_pembayaran_registrasi,
                'tgl_bayar_regis' => $p->tgl_bayar_regis,
                'tgl_bayar_daftar' => $p->tgl_bayar_daftar,
                'status_ujian' => $p->status_ujian,
                'batas_awal_registrasi' => $p->batas_awal_registrasi,
                'batas_akhir_registrasi' => $p->batas_akhir_registrasi,
                'pembekalan' => $p->pembekalan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No','No Pendaftaran','Gelombang','Jalur','Fakultas/Unit','Prodi','Nama Peserta',
            'NIK','Tempat Lahir','Tanggal Lahir','NISN','No Akta Lahir','Gender','Agama',
            'Kewarganegaraan','Email','No HP','Alamat Lengkap','Alamat Sekolah','Dusun',
            'Kecamatan','Kabupaten','Provinsi','Kode Pos','Nama Sekolah','Kota Sekolah',
            'Provinsi Sekolah','Jurusan','Tahun Lulus','Status Sekolah','Ibu Nama',
            'Ibu Tanggal Lahir','Ibu NIK','Ibu Alamat','Ibu Suku','Ibu Pendidikan',
            'Ibu Pekerjaan','Ibu Penghasilan','Ibu No Tlp','Ayah Nama','Ayah Tanggal Lahir',
            'Ayah NIK','Ayah Alamat','Ayah Suku','Ayah Pendidikan','Ayah Pekerjaan',
            'Ayah Penghasilan','Ayah No Tlp','Jumlah Saudara Kandung','Jumlah Saudara Yayasan',
            'Nama Sumber','Foto','No KK','Dokumen KK','Dokumen KTP Ortu','Dokumen Akte Kelahiran',

            'No KKS','No KPS','Usulan PIP','Nomor KIP','Nama KIP','Alasan Menolak KIP','No Reg Akta Lahir',

            'VA Number','Status Paid','Status Pembayaran Registrasi','Tgl Bayar Regis',
            'Tgl Bayar Daftar','Status Ujian','Batas Awal Registrasi','Batas Akhir Registrasi','Pembekalan'
        ];
    }
}
