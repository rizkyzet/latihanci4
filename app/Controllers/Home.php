<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Home extends BaseController
{
    protected $komikModel;
    public function __construct()
    {

        $this->komikModel = new KomikModel();
    }
    public function index()
    {
        $komik = $this->komikModel->findAll();

        return view('welcome/v_index');
    }
}
