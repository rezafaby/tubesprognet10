<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiIKSPro;
use App\Models\IKS;
use Yajra\DataTables\Facades\DataTables;

class TransaksiIKSProController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Transaksi IKS Provider';
        $table_id = 'tbt_iksprovider';
        $transaksi = TransaksiIKSPro::all();
        return view('transaksiikspro.index',compact('subtitle','table_id','icon','transaksi'));
    }

    public function listData(Request $request){
        $data = TransaksiIKSPro::with('IKS');
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->EditColumn('IKS.nama', function($data){
                    return $data->IKS->nama;
                })
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/transaksiikspro/edit/".$data->id."' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->nama_iks}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nama='{$data->nama_iks}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(TransaksiIKSPro::destroy($request->id)){
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
    public function create() {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Transaksi IKS Provider';
        $iks = IKS::all();
        return view('transaksiikspro.create',compact('subtitle','icon','iks'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->iks_file;
        $namafile = $file->getClientOriginalName();
        
            $upload = new TransaksiIKSPro;
            $upload->iks_id = $request->iks_id;
            $upload->nomor_iks = $request->nomor_iks;
            $upload->tanggal_awal = $request->tanggal_awal;
            $upload->tanggal_akhir = $request->tanggal_akhir;
            $upload->iks_file = $namafile;
            
            $file->move(public_path().'/img', $namafile);
            $upload->save();
        return redirect()->route('transaksiikspro.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiIKSPro $transaksiikspro, $id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Transaki IKS Provider';
        $data = TransaksiIKSPro::find($id);
        $iks = IKS::all();
        $transaksiikspro = TransaksiIKSPro::all();
        return view('transaksiikspro.edit',compact('icon','subtitle','data','transaksiikspro','iks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = TransaksiIKSPro::find($id);
        $data->fill($request->all())->save();
        return redirect()->route('transaksiikspro.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
}
