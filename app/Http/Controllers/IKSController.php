<?php

namespace App\Http\Controllers;

use App\Models\IKS;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IKSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    public function index() {
        $icon = 'ni ni-dashlite';
        $subtitle = 'IKS';
        $table_id = 'tbm_iks';
        return view('iks.index',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = IKS::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/crud/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->nama}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nama='{$data->nama}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(IKS::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    public function create() {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Ikatan';
        return view('create',compact('subtitle','icon'));
    }
  
    public function edit(IKS $iKS) {
        $data = IKS::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Ikatan';
        return view('edit',compact('subtitle','icon','data'));
    }
}
