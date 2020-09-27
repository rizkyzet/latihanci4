<?php

namespace App\Controllers;

use CodeIgniter\Database\Seeder;
use Config\Services;
use CodeIgniter\I18n\Time;

class Orang extends BaseController
{

    protected $orangModel;


    public function __construct()
    {
        // date_default_timezone_set('Asia/Jakarta');

        // $this->orangModel = new OrangModel();
        $this->orangModel = new \App\Models\OrangModel();
    }

    public function index()
    {
        $time = Time::parse('March 9, 2016 12:00:00', 'America/Chicago');

        echo $time->humanize();
        die;
        $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;
        $numberPage = 10;
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $orang = $this->orangModel->search($keyword);
        } else {
            $orang = $this->orangModel;
        }

        $data = [
            'title' => 'Daftar Orang',
            'orang' => $orang->paginate($numberPage, 'orang'),
            'pager' => $this->orangModel->pager,
            'currentPage' => $currentPage,
            'numberPage' => $numberPage,
            'request' => \Config\Services::request()
        ];
        $data['session'] = $this->session;
        return view('orang/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Orang';
        $data['validation'] = \Config\Services::validation();


        return view('orang/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Data {field} Harus Diisi!'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Data {field} Harus Diisi'
                ]
            ]
        ])) {
            return redirect()->to('/orang/create')->withInput();
        }

        $data = [
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat')
        ];

        $this->orangModel->save($data);


        $this->session->setFlashdata('pesan', 'Data Orang Berhasil Ditambahkan');
        return redirect()->to('/orang');
    }

    public function edit($id)
    {

        $orang = $this->orangModel->find($id);

        $data = [
            'title' => 'Edit Data Orang',
            'orang' => $orang,
            'validation' => \Config\Services::validation(),
            'session' => $this->session
        ];

        return view('orang/edit', $data);
    }


    public function update()
    {

        if (!$this->validate([
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Data {field} Harus diisi!'
                ]
            ],
            'alamat' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Data {field} Harus diisi!'
                ]
            ]

        ])) {
            return redirect()->to('/orang/edit/' . $this->request->getVar('id'))->withInput();
        } else {

            // $this->orangModel->update($this->request->getVar('id'), [

            //     'nama' => $this->request->getVar('nama'),
            //     'alamat' => $this->request->getVar('alamat')
            // ]);
            $this->orangModel->save([
                'id' => $this->request->getVar('id'),
                'nama' => $this->request->getVar('nama'),
                'alamat' => $this->request->getVar('alamat')
            ]);
            $this->session->setFlashData('pesan', 'Data Orang Berhasil Diubah!');

            return redirect()->to('/orang');
        }
    }
}
