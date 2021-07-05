<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Quangcao;
use DB;
use Input,File;
use Yajra\Datatables\Datatables;
class QuangcaoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

}
