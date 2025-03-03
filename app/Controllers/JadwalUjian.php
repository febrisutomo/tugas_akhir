<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\ProdiModel;
use App\Models\RuangUjianModel;
use App\Models\JadwalUjianModel;
use App\Models\TahunAkademikModel;

class JadwalUjian extends BaseController
{
    protected $jadwal_ujianModel;
    protected $prodiModel;
    protected $kelasModel;
    protected $tahunAkademikModel;
    protected $ruang_ujianModel;

    public function __construct()
    {
        $this->jadwal_ujianModel = new JadwalUjianModel();
        $this->prodiModel = new ProdiModel();
        $this->kelasModel = new KelasModel();
        $this->tahunAkademikModel = new TahunAkademikModel();
        $this->ruang_ujianModel = new RuangUjianModel();
        $this->tahun_akademikModel = new TahunAkademikModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Jadwal Ujian',
            'jadwal_ujian' => $this->jadwal_ujianModel->getJadwalUjian()
        ];

        return view('admin/jadwal_ujian/index', $data);
    }

    public function create()
    {
        // dd($this->tahunAkademikModel->where('status', true)->first()['id_tahun_akademik']);
        $data = [
            'title'         => 'Tambah Jadwal Ujian',
            'prodi'         => $this->prodiModel->getProdi(),
            'ruang_ujian'   => $this->ruang_ujianModel->getRuangUjian(),
            'tahun_akademik' => $this->tahunAkademikModel->findAll(),

        ];

        return view('admin/jadwal_ujian/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'kelas' => [
                'rules' => 'required',
                'label' => 'Kelas',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'ruang_ujian' => [
                'rules' => 'required',
                'label' => 'Ruang Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'tahun_akademik' => [
                'rules' => 'required',
                'label' => 'Tahun Akademik',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jumlah_peserta' => [
                'rules' => 'required',
                'label' => 'Jumlah Peserta',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'label' => 'Tanggal',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jam_mulai' => [
                'rules' => 'required',
                'label' => 'Jam Mulai',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jam_selesai' => [
                'rules' => 'required',
                'label' => 'Jam Selesai',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->jadwal_ujianModel->save([
                'id_kelas' => $this->request->getVar('kelas'),
                'id_ruang_ujian' => $this->request->getVar('ruang_ujian'),
                'id_tahun_akademik' => $this->request->getVar('tahun_akademik'),
                'jumlah_peserta' => $this->request->getVar('jumlah_peserta'),
                'id_tahun_akademik' => $this->tahunAkademikModel->getAktif()['id_tahun_akademik'],
                'tanggal' => $this->request->getVar('tanggal'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_selesai' => $this->request->getVar('jam_selesai')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            // dd($e);
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/jadwal_ujian');
    }

    public function delete($id_jadwal_ujian)
    {
        try {
            $this->jadwal_ujianModel->delete($id_jadwal_ujian);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data Berhasil Dihapus',
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data Gagal Dihapus',
            ]);
        }
    }

    public function edit($id_jadwal_ujian)
    {
        $jadwalUjian = $this->jadwal_ujianModel->find($id_jadwal_ujian);
        $data = [
            'title' => 'Edit Jadwal Ujian',
            'jadwal_ujian' => $jadwalUjian,
            'prodi' => $this->prodiModel->findAll(),
            'kelas' => $this->kelasModel->find($jadwalUjian['id_kelas']),
            'ruang_ujian' => $this->ruang_ujianModel->findAll(),
            'tahun_akademik_aktif' => $this->tahunAkademikModel->find($jadwalUjian['id_tahun_akademik']),
        ];
        return view('admin/jadwal_ujian/edit', $data);
    }

    public function update($id_jadwal_ujian)
    {
        if (!$this->validate([
            'kelas' => [
                'rules' => 'required',
                'label' => 'Kelas',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'ruang_ujian' => [
                'rules' => 'required',
                'label' => 'Ruang Ujian',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jumlah_peserta' => [
                'rules' => 'required',
                'label' => 'Jumlah Peserta',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'label' => 'Tanggal',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jam_mulai' => [
                'rules' => 'required',
                'label' => 'Jam Mulai',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'jam_selesai' => [
                'rules' => 'required',
                'label' => 'Jam Selesai',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        try {
            $this->jadwal_ujianModel->save([
                'id_jadwal_ujian' => $id_jadwal_ujian,
                'id_kelas' => $this->request->getVar('kelas'),
                'id_ruang_ujian' => $this->request->getVar('ruang_ujian'),
                'jumlah_peserta' => $this->request->getVar('jumlah_peserta'),
                'id_tahun_akademik' => $this->request->getVar('tahun_akademik'),
                'tanggal' => $this->request->getVar('tanggal'),
                'jam_mulai' => $this->request->getVar('jam_mulai'),
                'jam_selesai' => $this->request->getVar('jam_selesai')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->to('/admin/jadwal_ujian');
    }
}
