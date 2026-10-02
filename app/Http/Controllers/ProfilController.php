<?php

namespace App\Http\Controllers;

class ProfilController extends Controller
{
    public function index()
    {
        // Data sejarah sekolah
        $sejarah = [
            'text' => 'SMK Negeri 4 Kota Bogor merupakan sekolah kejuruan negeri termuda ("paling bontot") di Kota Bogor yang dirintis sejak tahun 2008 dan resmi beroperasi pada 2009. Sekolah berakreditasi A ini berdiri di atas lahan seluas 12.724 meter persegi di Jalan Raya Tajur, Kampung Buntar, Kelurahan Muarasari, Kecamatan Bogor Selatan. Sejak awal berdiri, SMK Negeri 4 Kota Bogor konsisten memfokuskan pendidikannya pada bidang keahlian Teknologi Informasi dan Komunikasi (TIK) serta Teknologi dan Rekayasa.',
            'image' => 'sejarahsekolah.JPG',
        ];

        // Data kepala sekolah
        $kepalaSekolah = [
            'name'    => 'Drs. Mulya Murprihartono, M.Si',
            'jabatan' => 'Kepala SMK Negeri 4 Kota Bogor',
            'photo'   => 'pamul1.jpeg',
            'pesan'   => [
                'Selamat datang di SMK Negeri 4 Kota Bogor. Kami berkomitmen untuk memberikan pendidikan yang berkualitas serta membentuk peserta didik yang kompeten, berkarakter, disiplin, dan siap menghadapi perkembangan dunia kerja maupun pendidikan di masa depan.',
                'Semoga SMK Negeri 4 Kota Bogor terus menjadi tempat tumbuhnya generasi yang berprestasi, berintegritas, dan mampu memberikan kontribusi positif bagi masyarakat.',
            ],
        ];

        // Visi
        $visi = 'Mewujudkan generasi unggul, berkarakter, dan kompeten di bidang teknologi dan kejuruan. Siap kerja, santun, mandiri, dan kreatif.';

        // Misi (list)
        $misi = [
            [
                'title' => 'Unggul & Kompeten',
                'desc'  => 'Mengembangkan kemampuan siswa dalam bidang teknologi dan kejuruan sesuai kebutuhan zaman.',
            ],
            [
                'title' => 'Berkarakter & Santun',
                'desc'  => 'Membentuk peserta didik yang bermoral baik, sopan, dan berintegritas tinggi.',
            ],
            [
                'title' => 'Siap Kerja & Mandiri',
                'desc'  => 'Membekali siswa dengan keterampilan vokasi agar siap menghadapi dunia kerja atau berwirausaha secara mandiri, mengembangkan potensi siswa secara optimal.',
            ],
            [
                'title' => 'Kreatif',
                'desc'  => 'Mendorong inovasi dan daya cipta dalam memecahkan masalah di bidang keahlian masing-masing.',
            ],
        ];

        // Tujuan (list) - sesuaikan dengan tujuan resmi sekolah
        $tujuan = [
            [
                'title' => 'Lulusan Kompeten',
                'desc'  => 'Menghasilkan lulusan yang siap kerja, berwirausaha, atau melanjutkan pendidikan ke jenjang yang lebih tinggi.',
            ],
            [
                'title' => 'Karakter Unggul',
                'desc'  => 'Membentuk peserta didik yang berakhlak mulia, disiplin, santun, dan bertanggung jawab.',
            ],
            [
                'title' => 'Kemitraan Industri',
                'desc'  => 'Memperkuat kerja sama dengan dunia usaha dan dunia industri agar pembelajaran selaras dengan kebutuhan kerja.',
            ],
            [
                'title' => 'Kreativitas & Inovasi',
                'desc'  => 'Mendorong siswa berkarya dan berinovasi di bidang teknologi melalui kegiatan pembelajaran, kompetisi, dan produk sekolah.',
            ],
        ];

        // Struktur organisasi
        $struktur = [
            'kepala' => [
                'jabatan' => 'Kepala Sekolah',
                'nama'    => 'Drs. Mulya Murprihartono, M.Si',
            ],
            'level2' => [
                ['jabatan' => 'Ketua Komite', 'nama' => 'Drs. Budi Raharjo'],
                ['jabatan' => 'Kasubag TU', 'nama' => 'Hj. Siti Hasanah, S.E'],
            ],
            'level3' => [
                ['jabatan' => 'Wakasek Kurikulum', 'nama' => 'Iwan Setiawan, S.Pd'],
                ['jabatan' => 'Wakasek Kesiswaan', 'nama' => 'Deni Maulana, S.T'],
                ['jabatan' => 'Wakasek Humas', 'nama' => 'Rina Susilowati, S.Pd'],
                ['jabatan' => 'Wakasek Sarpras', 'nama' => 'Agus Suherman, M.Si'],
            ],
        ];

        return view('profil', compact(
            'sejarah',
            'kepalaSekolah',
            'visi',
            'misi',
            'tujuan',
            'struktur'
        ));
    }
}