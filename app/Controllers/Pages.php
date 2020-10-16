<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {

        $data = [
            'judul' => 'Home | Randi Ramlan'
        ];
        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'judul' => 'About'
        ];
        echo view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'judul' => 'Contact',
            'penerima' => [
                'noHp' => '081-111-111',
                'email' => 'support@gmail.com'
            ]
        ];
        return view('pages/contact', $data);
    }
}
