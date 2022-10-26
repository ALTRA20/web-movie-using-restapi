<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\filmModel;
use App\Models\rateFilmModel;

class film extends BaseController
{
    use ResponseTrait;

    function __construct()
    {

        $this->session = \Config\Services::session();
        $this->model = new filmModel();
        $this->rateFilmModel = new rateFilmModel();
    }

    // public function index()
    // {
    //     $data = $this->model->orderBy('tahunTerbit', 'asc')->findAll();
    //     return $this->respond($data, 200); 
    // }

    public function show()
    {
        $data = $this->model->findAll();
        if ($data) {
            // array multi-dimensi
            $index=0;
            $dataFilm = array();
            foreach ($data as $d) {
                $data[$index] = [
                    'id' => $d['id'],
                    'judul' => $d['judul'],
                    'slug' => $d['slug'],
                    'sampul' => $d['sampul'],
                    'genre' => $d['genre'],
                    'actor' => $d['actor'],
                    'negara' => $d['negara'],
                    'sutradara' => $d['sutradara'],
                    'storyline' => $d['storyline'],
                    'rate' => $d['rate'],
                    'tahunTerbit' => $d['tahunTerbit'],
                    'status' => $d['status'],
                ];
                $db      = \Config\Database::connect();
                $builder = $db->table('listFilm');
                if ($this->rate($d['id'])!="") {
                    $builder->set('rate', $this->rate($d['id']));
                    $builder->where('id', $d['id']);
                    $builder->update();
                }else{
                    $builder->set('rate', 0);
                    $builder->where('id', $d['id']);
                    $builder->update();
                }
                $index++;
            }
           
            $dataFilm = $data;
        // encode array to json
               $json = json_encode(array('data' => $dataFilm));
                $saveJson= file_put_contents("data.json", $json);
         return  $this->respond($data,200);
        }
    }

    public function showBy($id)
    {
        $listFilm = $this->model->where('slug', $id)->findAll()[0];
        $dataRate = $this->rateFilmModel->select('rate')->where('id_film', $listFilm['id'])->findAll();
        $jmlhRate = count($dataRate);
        $rate = 0;
        $index = 0;
            foreach ($dataRate as $d) {
        // d($dataRate);
                    $rate = $rate + intval($d['rate']);
                $index++;
            }
            if (count($dataRate) == 0) {
                $finalRate = '<span style="color:green;">Belum ada user yang memberi rating untuk film ini</span>';
            }else{
                $finalRate = $rate/$jmlhRate;
            }
        $data = [
           'listFilm' => $listFilm,
           'rate' =>  $finalRate,
        ];
        // dd($data['rate']);
        return view('/film/detail', $data);
    }

    public function create()
    {
        $data = [
            'judul'=>$this->request->getPost('judul'),
            'genre'=>$this->request->getPost('genre'),
            'sutradara'=>$this->request->getPost('sutradara'),
            'penerbit'=>$this->request->getPost('penerbit'),
            'tahunTerbit'=>$this->request->getPost('tahunTerbit'),
            'negara'=>$this->request->getPost('negara'),
            'actor'=>$this->request->getPost('actor'),
            'storyline'=>$this->request->getPost('storyline'),
            'durasi'=>$this->request->getPost('durasi'),
        ];
        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }
        $this->model->save($data);
        $response = [
            'status'=>200,
            'eror'=>null,
            'massage'=>[
                'succes'=>'Berhasil menginput data film'
            ],
        ];
        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        // print_r($data);
        // exit;  
        $exists = $this->model->where('id', $id)->findAll();
        if (!$exists) {
            return $this->failNotFound('data film tidak ditemukan');
        }
        if (!$this->model->update($id, $data)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 200,
            'error' => null,
            'massage'=>[
                'succes'=>'Berhasil mengubah data film'
            ],
        ];

        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            $this->model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'massage'=>[
                    'succes'=>'Berhasil menghapus data film'
                ],
            ];
            return $this->respond($response);
        }else{
            return $this->failNotFound('data film tidak ditemukan');
        }
    }

    public function rate($id)
    {
        $data = $this->rateFilmModel->select('rate')->where('id_film', $id)->findAll();
        $jmlhRate = count($data);
        // d(count($data) == 0);
        $rate = 0;
        $index = 0;
            foreach ($data as $d) {
                    $rate = $rate + intval($d['rate']);
                $index++;
            }
            if (count($data) == 0) {
                return "";
            }
            return $finalRate = $rate/$jmlhRate;
            // d($finalRate == 8.5);

         // return $finalRate;
       // die();
    }
}

// redirect()->to(base_url('/'));
