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
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ]
        ])) {

            return redirect()->to('/komik/create')->withInput();
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $data = [
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')

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
}
