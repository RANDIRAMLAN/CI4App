<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Comics extends BaseController
{

    protected $KomikModel;

    public function __construct()
    {
        $this->KomikModel = new KomikModel();
    }
    public function index()
    {

        $data = [
            'judul' => 'List Comic',
            'komik' => $this->KomikModel->getKomik()
        ];
        return view('comics/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'judul' =>  'Detail Comic',
            'komik' => $this->KomikModel->getKomik($slug)
        ];
        // jika komik tidak ada ditabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Comic Title ' . $slug . ' Not Found');
        }
        return view('comics/detail', $data);
    }

    public function create()
    {

        $data = [
            'judul' => 'Add Comic',
            'header' => 'Add Comic',
            'validation' => \Config\Services::validation()
        ];
        return view('comics/create', $data);
    }

    public function save()
    {
        //Validasi untuk saat input (judul dan sampul)
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => 'Comic title can not emty',
                    'is_unique' => 'Comic title can not duplicate'
                ]

            ],
            'sampul' => [
                'rules' => 'max_size[sampul,10024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'max size 10024 kb',
                    'is_image' => 'Can not upload another image',
                    'mime_in' => 'Only for jpg, jpeg and png'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/comics/create')->withInput()->with('validation', $validation);
            return redirect()->to('/comics/create')->withInput();
        }
        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {
            // generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
        }
        // ambil slug
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->KomikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashdata('simpan', 'Data Saved Successfully');
        return redirect()->to('/comics');
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $komik = $this->KomikModel->find($id);
        // cek jika file gambarnya default
        if ($komik['sampul'] != 'default.png') {
            // hapus gambar
            unlink('img/' . $komik['sampul']);
        }
        $this->KomikModel->delete($id);
        session()->setFlashdata('hapus', 'Data Deleted Successfully');
        return redirect()->to('/comics');
    }

    public function edit($slug)
    {
        $data = [
            'judul' => 'Edit Comic',
            'header' => 'Edit Comic',
            'validation' => \Config\Services::validation(),
            'komik' => $this->KomikModel->getKomik($slug)
        ];
        return view('comics/edit', $data);
    }

    public function update($id)
    {
        $komiklama = $this->KomikModel->getKomik($this->request->getVar('slug'));
        if ($komiklama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }
        //Validasi untuk saat update
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Comic title can not emp ty',
                    'is_unique' => 'Comic title can not duplicate'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,10024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'max size 10024 kb',
                    'is_image' => 'Can not upload another image',
                    'mime_in' => 'Only for jpg, jpeg and png'
                ]
            ]

        ])) {

            return redirect()->to('/comics/edit/' . $this->request->getVar('slug'))->withInput();
        }
        $fileSampul = $this->request->getFile('sampul');
        // cek gambar apakah tetap gambar lama atau berubah
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            //generate nama file random
            $namaSampul = $fileSampul->getRandomName();
            // upload gambar
            $fileSampul->move('img', $namaSampul);
            // hapus file lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->KomikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashdata('ubah', 'Data Updated Successfully');
        return redirect()->to('/comics');
    }
}
