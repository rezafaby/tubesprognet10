<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiIKSPro;
use App\Models\TransaksiKomIKS;
use App\Models\KomponenGroups;  
use Yajra\DataTables\Facades\DataTables;

class TransaksiKomIKSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Transaksi Komponen IKS';
        $table_id = 'tbt_komponeniks';
        return view('transaksikomiks.index',compact('subtitle','table_id','icon',));
    }

    public function listData(Request $request){
        $data = TransaksiKomIKS::with('TransaksiIKSPro');
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->EditColumn('TransaksiIKSPro.nama_iks', function($data){
                    return $data->TransaksiIKSPro->nama_iks;
                })
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/transaksikomiks/edit/".$data->id."' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->group}\",this)' class='btn btn-md btn-danger' data-id='{$data->group}' data-nama='{$data->group}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
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
    public function create()
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Transaksi Komponen IKS';
        $tikspro = TransaksiIKSPro::all();
        $group = KomponenGroups::all();
        return view('transaksikomiks.create',compact('subtitle','icon','tikspro','group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group_id = $request -> group;
        $group = KomponenGroups::find($group_id);
        $tkomiks = new TransaksiKomIKS();
        $tkomiks -> iks_provider_id = $request -> nama_iks;
        $tkomiks -> iks_gkomponen_id = $request -> iks_gkomponen_id;
        $tkomiks -> group = $group -> group;
        $tkomiks -> save();
        session()->flash('message',$tkomiks['group'].'  Berhasil Ditambahkan');
        return redirect()->route('transaksikomiks.index');
        
        // $data = $request->all();
        // KomponenGroupDetail::create($data);
        // session()->flash('message',$data['gkomponen_detail'].'  Berhasil Ditambahkan');
        // return redirect()->route('komponengroupdetail.index');
        // return back();
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
    public function edit($id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Transaki Komponen IKS';
        $data = TransaksiKomIKS::find($id);
        $tikspro = TransaksiIKSPro::all();
        $group = KomponenGroups::all();
        return view('transaksikomiks.edit',compact('icon','subtitle','tikspro','group','data'));
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
        $data = TransaksiKomIKS::find($id);
        $group_id = $request -> group;
        $group = KomponenGroups::find($group_id);
        $data = new TransaksiKomIKS();
        $data -> iks_provider_id = $request -> nama_iks;
        $data -> iks_gkomponen_id = $request -> iks_gkomponen_id;
        $data -> group = $group -> group;
        $data -> save();
        session()->flash('message',$data['group'].'  Berhasil Diupdate');
        return redirect()->route('transaksikomiks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
