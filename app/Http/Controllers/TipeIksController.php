<?php

namespace App\Http\Controllers;

use App\Models\TipeIks;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TipeIksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tipe Iks';
        $table_id = 'tbtipeiks';
        return view('tipeiks.index',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = TipeIks::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/tipeiks/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->kode}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-group='{$data->kode}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(TipeIks::destroy($request->id)){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('success'=>2,'msg'=>'Gagal menghapus data');
        }
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Tipe Iks';
        return view('tipeiks.create',compact('subtitle','icon'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TipeIks::create($request->all());
        return redirect()->route('tipeiks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipeIks  $tipeIks
     * @return \Illuminate\Http\Response
     */
    public function show(TipeIks $tipeIks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipeIks  $tipeIks
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){
        $data = TipeIks::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Tipe IKS';
        return view('tipeiks.edit',compact('subtitle','icon','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipeIks  $tipeIks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = TipeIks::find($id);
        $data->fill($request->all())->save();
        return redirect()->route('tipeiks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipeIks  $tipeIks
     * @return \Illuminate\Http\Response
     */
    
}