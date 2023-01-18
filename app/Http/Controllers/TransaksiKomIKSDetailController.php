<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiIKSPro;
use App\Models\TransaksiKomIKS;
use App\Models\KomponenGroupDetail;
use App\Models\TransaksiKomIKSDetail;  
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class TransaksiKomIKSDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = 0)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Transaksi Komponen IKS Detail';
        $table_id = 'tbt_komiksdetail';
        // $tkomiks = TransaksiKomIKS::where('id', $id)->get();
        // $tkomiksdetail = TransaksiKomIKSDetail::with(['TransaksiKomIKS' => function($query_transaksikomiks){
        //     $query_transaksikomiks->with('TransaksiIKSPro')->whereHas('TransaksiIKSPro');
        // }])->whereHas('TransaksiKomIKS')->findOrFail($id);
        // $tikspro = TransaksiIKSPro::all();
        // $tkomiks = TransaksiKomIKS::where('iks_provider_id',$tkomiksdetail->TransaksiKomIKS->TransaksiIKSPro->id)->get();
        
        Session::put('tkomiksdetail_url', request()->fullUrl());
        Session::put('data_url', request()->fullUrl());

        $data = TransaksiKomIKS::find($id);
        $dataProvider = TransaksiIKSPro::find($data->iks_provider_id);
        // dd($dataProvider);

        return view('transaksikomiksdetail.index',compact('subtitle','table_id','icon','id', 'dataProvider','data'));
    }

    public function listData(Request $request, $id){
        $data = TransaksiKomIKSDetail::with('TransaksiKomIKS')->whereHas('TransaksiKomIKS')->get();
        if(($id!=0)){
            $data = TransaksiKomIKSDetail::with('TransaksiKomIKS')->whereHas('TransaksiKomIKS')->where('komponen_iks_id',$id)->get();
        }else{
            $data = TransaksiKomIKSDetail::with('TransaksiKomIKS');
        }
        // $data = TransaksiKomIKSDetail::with('TransaksiKomIKS');
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->EditColumn('TransaksiKomIKS.group', function($data){
                    return $data->TransaksiKomIKS->group;
                })
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/transaksikomiksdetail/edit/".$data->id."' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->komponen_iks_detail}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nama='{$data->komponen_iks_detail}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(TransaksiKomIKSDetail::destroy($request->id)){
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
        $subtitle = 'Tambah Data Transaksi Komponen IKS Detail';
        $tkomiks = TransaksiKomIKS::all();
        $gdetail = KomponenGroupDetail::all();
        return view('transaksikomiksdetail.create',compact('subtitle','icon','tkomiks','gdetail'));
    }

    public function createSpesific($id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Transaksi Komponen IKS Detail';
        $tkomiks = TransaksiKomIKS::where('id', $id)->get();
        $gdetail = KomponenGroupDetail::all();
        return view('transaksikomiksdetail.create',compact('subtitle','icon','tkomiks','gdetail','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gdetail_id = $request -> gkomponen_detail;
        $gdetail = KomponenGroupDetail::find($gdetail_id);
        // dd($gdetail);
        $tkomiksdetail = new TransaksiKomIKSDetail();
        $tkomiksdetail -> komponen_iks_id = $request -> komponen_iks_id;
        $tkomiksdetail -> komponen_iks_detail = $gdetail -> gkomponen_detail;
        $tkomiksdetail -> save();
        session()->flash('message',$tkomiksdetail['komponen_iks_detail'].'  Berhasil Ditambahkan');

        if(session(key:'tkomiksdetail_url')){
            return redirect(session(key:'tkomiksdetail_url'));
        }

        return redirect()->route('transaksikomiksdetail.index');
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
        $subtitle = 'Edit Data Transaksi Komponen IKS Detail';
        $data = TransaksiKomIKSDetail::find($id);
        $tkomiks = TransaksiKomIKS::all();
        $gdetail = KomponenGroupDetail::all();
        return view('transaksikomiksdetail.edit',compact('icon','subtitle','tkomiks','gdetail','data'));
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
        $data = TransaksiKomIKSDetail::find($id);
        $gdetail = KomponenGroupDetail::find($request->komponen_iks_detail);
        $dataRequest = $request->all();
        $dataRequest['komponen_iks_detail'] = $gdetail->gkomponen_detail;
        $data->fill($dataRequest)->save();
        session()->flash('message',$data['komponen_iks_detail'].'  Berhasil Diubah');

        if(session(key:'data_url')){
            return redirect(session(key:'data_url'));
        }
        return redirect()->route('transaksikomiksdetail.index');
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
