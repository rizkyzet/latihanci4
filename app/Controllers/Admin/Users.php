<?php

namespace App\Controllers\Admin;

use App\Models\KomikModel;
use App\Controllers\BaseController;


class Users extends BaseController
{
    protected $komikMode;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }
    public function index()
    {
        $komik = $this->komikModel->findAll();
        dd($komik);
        return view('welcome/v_index');
    }
}
