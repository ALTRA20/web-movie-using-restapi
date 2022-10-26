<?php

namespace App\Controllers;


use CodeIgniter\API\ResponseTrait;
use App\Models\filmModel;
use App\Models\rateFilmModel;

use chriskacerguis\RestServer\RestController;

class pages extends film
{
    function __construct()
    {
        $this->model = new filmModel();
        $this->rateFilmModel = new rateFilmModel();
        // $this->show();
        $this->apiFilm = new film();
    }
    public function index()
    {
        // $data = [
        //     'dataFilm' => $this->show(),
        // ];
        // dd($data['dataFilm']);
        return view('film/index');
    }

    public function detail($id)
    {
        $data = [
            'idFilm' => $id,
        ];
        return view('film/detail', $data);
    }

    // public function show()
    // {
    //   $this->show();
    // }


    // class ctrl1 extends film
    // {
        
    //     function __construct(argument)
    //     {
            
    //     }
        // public function rate($id)
        // {
        //     app('App\Controllers\film')->rate($id);
        // }
    // }

    
}

