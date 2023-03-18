<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Tiket as Model;

class TiketClientController extends Controller
{

    private $viewIndex = 'tiket_index';
    private $viewCreate = 'tiket_form';
    private $viewEdit = 'tiket_form';
    private $viewShow = 'tiket_show';
    private $routePrefix = 'tiket';

    public function index(){

        $models = Model::with('konser')->latest()->paginate('30');


        return view('client.' . $this->viewIndex, [
             'models' => $models,
             'routePrefix' => $this->routePrefix,
             'title' => 'Data tiket'
         ]);
    }

}
