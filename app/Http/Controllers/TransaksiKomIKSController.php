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
    public function index($id = 0)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Transaksi Komponen IKS';
        $table_id = 'tbt_komponeniks';
        return view('transaksikomiks.index',compact('subtitle','table_id','icon','id'));
    }

    public function listData(Request $request, $id){
        $data = TransaksiKomIKS::with('TransaksiIKSPro')->whereHas('TransaksiIKSPro')->get();
        if(($id!=0)){
            $data = TransaksiKomIKS::with('TransaksiIKSPro')->whereHas('TransaksiIKSPro')->where('iks_provider_id',$id)->get();
        }else{
            $data = TransaksiKomIKS::with('TransaksiIKSPro');
        }
        // $data = TransaksiKomIKS::with('TransaksiIKSPro');
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->EditColumn('TransaksiIKSPro.nama_iks', function($data){
                    return $data->TransaksiIKSPro->nama_iks;
                })
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/transaksikomiks/edit/".$data->id."' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Transaksi Komponen Detail' href='/transaksikomiksdetail/index/".$data->id."' class='btn btn-md btn-secondary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-eye' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->group}\",this)' class='btn btn-md btn-danger' data-id='{$data->group}' data-nama='{$data->group}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(TransaksiKomIKS::destroy($request->id)){
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
    
    public function createSpesific($id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Mahasiswa';
        $tikspro = TransaksiIKSPro::where('id', $id)->get();
        $group = KomponenGroups::all();
        return view('transaksikomiks.create',compact('subtitle','icon','tikspro','group','id'));
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
        $subtitle = 'Edit Data Transaksi Komponen IKS';
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
        $group = KomponenGroups::find($request->group);
        $dataRequest = $request->all();
        $dataRequest['iks_provider_id']  = $request -> nama_iks;
        $dataRequest['group'] = $group->group;
        $data->fill($dataRequest)->save();
        session()->flash('message',$data['group'].'  Berhasil Diubah');
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
