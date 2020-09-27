<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikModel;
    protected $db;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {

        $keyword = $this->request->getVar('keyword');
        $pageNumber = 6;
        $currentPage = $this->request->getVar('page_komik') ? $this->request->getVar('page_komik') : 1;

        if ($keyword) {
            $komik = $this->komikModel->search($keyword);
        } else {
            $komik = $this->komikModel;
        }
        // dd($this->db->table('komik')->like('judul', $keyword)->get()->getResultArray());
        $data = [
            'title' => 'Latihan | Komik',
            'pageNumber' => $pageNumber,
            'currentPage' => $currentPage,
            'komik' => $komik->paginate($pageNumber, 'komik'),
            'pager' => $komik->pager,
            'request' => \Config\Services::request()
        ];

        return view('komik/index.php', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Latihan | Detail',
            'komik' => $this->komikModel->getKomik($slug)

        ];

        if (empty($data['komik'])) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan!');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        session();
        $data = [
            'title' => 'Latihan | Create',
            'validation' => \Config\Services::validation()
        ];
        return view('komik/create.php', $data);
    }


    public function save()
    {

        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi!',
                    'is_unique' => '{field} komik sudah terdaftar!'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]|is_image[sampul]',
                'errors' => [

                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'Yang anda pilih bukan gambar.',
                    'mime_in' => 'Gambar harus jpg, jpeg, png.'
                ]
            ]
        ])) {

            return redirect()->to('/komik/create')->withInput();
        }

        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {
            // generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //    pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
        }


        $slug = url_title($this->request->getVar('judul'), '-', true);
        $data = [
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul

        ];

        $this->komikModel->save($data);

        session()->setFlashdata('pesan', 'Data Komik Berhasil Ditambahkan!');
        return redirect()->to('/komik');
    }

    public function delete($id)
    {

        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data Komik Berhasil Dihapus.');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Tambah Data Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/edit', $data);
    }
    public function update()
    {

        $id = $this->request->getVar('id');
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul,id,' . $id . ']',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar.'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]|is_image[sampul]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'Yang anda pilih bukan gambar.',
                    'mime_in' => 'Gambar harus jpg, jpeg, png.'
                ]
            ]
        ])) {

            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        // cek gambar, apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // generate nama file random 
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan gambar
            $fileSampul->move('img', $namaSampul);
            // hapus file yang lama
            if ($this->request->getVar('sampulLama') !== 'default.png') {

                unlink('img/' . $this->request->getVar('sampulLama'));
            }
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashData('pesan', 'Data berhasil diubah.');

        return redirect()->to('/komik');
    }
}
