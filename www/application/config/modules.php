<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config['module-names'] = array(
    'TranskripRequest' => 'Cetak Transkrip',
    'TranskripManage' => 'Manajemen Cetak Transkrip',
    'PerubahanKuliahRequest' => 'Perubahan Kuliah',
    'PerubahanKuliahManage' => 'Manajemen Perubahan Kuliah',
	'EntriJadwalDosen' => 'Entri Jadwal Dosen',
	'LihatJadwalDosen' => 'Lihat Jadwal Dosen'
	
);

$config['modules'] = array(
    'TranskripRequest' => array('root', 'mahasiswa.ftis'),
    'TranskripManage' => array('root', 'tu.ftis'),
    'PerubahanKuliahRequest' => array('root', 'staf.unpar'),
    'PerubahanKuliahManage' => array('root', 'tu.ftis'),
	'EntriJadwalDosen' => array('root', 'dosen.informatika' ),
	'LihatJadwalDosen' => array('root', 'mahasiswa.informatika', 'dosen.informatika')
);


//ganti

$config['roles'] = array(
    'root' => array('jonatanlaksamanapurnomo@gmail.com'),
    'tu.ftis' => array('7316081@student.unpar.ac.id'),
    'mahasiswa.ftis' => '(7[123]\\d{5})|(20[1-9][0-9]7[123][0-9]{4})@student\\.unpar\\.ac\\.id',
    'staf.unpar' => '.+@unpar\\.ac\\.id',
	'dosen.informatika' => array ('7316081@student.unpar.ac.id'),
	'mahasiswa.informatika' => '73\\d{5}@student\\.unpar\\.ac\\.id'
);
