<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{

    protected $orangModel;

    public function __construct()
    {
        $this->orangModel = new OrangModel();
    }
    public function index($page = 5)
    {
        $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;
        $cari = $this->request->getVar('cari');
        if ($cari) {
            $orang =  $this->orangModel->search($cari);
        } else {
            $orang = $this->orangModel;
        }

        $data = [
            'judul' => 'List Orang',
            'page' => $page,
            'orang' => $orang->paginate($page, 'orang'),
            'pager' => $this->orangModel->pager,
            'currentPage' => $currentPage
        ];
        return view('orang/index', $data);
    }
}
