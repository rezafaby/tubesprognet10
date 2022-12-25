<?php

namespace App\Http\Controllers;

use App\Models\IKS;
use App\Models\Penjamin;
use App\Models\TipeIks;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IKSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $icon = 'ni ni-dashlite';
        $subtitle = 'IKS';
        $table_id = 'tbm_iks';
        return view('iks.index',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = IKS::with('Penjamin', 'TipeIks');
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->EditColumn('Penjamin.nama', function($data){
                    return $data->Penjamin->nama;
                })
                ->EditColumn('TipeIks.nama', function($data){
                    return $data->TipeIks->nama;
                })
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/iks/edit/".$data->id."' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
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
        $penjamin = Penjamin::all();
        $tiks = TipeIks::all();
        return view('iks.create',compact('subtitle','icon','penjamin','tiks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'=>'required|unique:m_iks',
        ]);
        $data = $request->all();
        IKS::create($data);
        session()->flash('message',$data['nama'].'  Berhasil Ditambahkan');
        return redirect()->route('iks.index');
    }
  

    public function edit(IKS $iKS, $id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data IKS';
        $data = IKS::find($id);
        $penjamin = Penjamin::all();
        $tiks = TipeIks::all();
        return view('iks.edit',compact(['icon','subtitle','data','penjamin','tiks']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode'=>'required|unique:m_iks,kode,'.$id,
        ]);
        $data = IKS::find($id);
        $data->fill($request->all())->save();
        session()->flash('message',$data['nama'].'  Berhasil Diubah');
        return redirect()->route('iks.index');
    }
}
