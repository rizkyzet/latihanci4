<?php

namespace App\Controllers;

use App\Models\KomikModel;


class Contact extends BaseController
{

    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        $komik = $this->komikModel->findAll();
        dd($komik);
    }
}
