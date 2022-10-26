<?php 

namespace App\Models;

use CodeIgniter\Model;

class filmModel extends Model
{
	protected $table = "listFilm";
	protected $primaryKey = "id";
	protected $allowedFields = [
		'judul','genre','penulis','sutradara','penerbit','tahunTerbit',
		'negara','actor','storyline','durasi'
	];
	protected $validationRules = [
		'judul'=>'required',
		'genre'=>'required',
		'sutradara'=>'required',
		'penerbit'=>'required',
		'tahunTerbit'=>'required',
		'negara'=>'required',
		'actor'=>'required',
		'storyline'=>'required',
		'durasi'=>'required',
	];
	protected $validationMessages = [
		'judul' => [
			'required' => 'Judul belum diisi, silahkan masukkan judul'
		],
		'genre' => [
			'required' => 'Judul belum diisi, silahkan masukkan genre'
		],
		'sutradara' => [
			'required' => 'Judul belum diisi, silahkan masukkan sutradara'
		],
		'penerbit' => [
			'required' => 'Judul belum diisi, silahkan masukkan penerbit'
		],
		'tahunTerbit' => [
			'required' => 'Judul belum diisi, silahkan masukkan tahunTerbit'
		],
		'negara' => [
			'required' => 'Judul belum diisi, silahkan masukkan negara'
		],
		'actor' => [
			'required' => 'Judul belum diisi, silahkan masukkan aktor'
		],
		'storyline' => [
			'required' => 'Judul belum diisi, silahkan masukkan storyline'
		],
		'durasi' => [
			'required' => 'Judul belum diisi, silahkan masukkan durasi'
		],
	];
}


    

?>
