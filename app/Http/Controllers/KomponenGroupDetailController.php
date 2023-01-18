<?php

namespace App\Http\Controllers;

use App\Models\KomponenGroupDetail;
use App\Models\KomponenGroups;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class KomponenGroupDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(int $id = null)
    // {
    //     $icon = 'ni ni-dashlite';
    //     $subtitle = 'Komponen Group Detail';
    //     $data = KomponenGroupDetail::with('KomponenGroups')->whereHas('KomponenGroups')->get();
    //     if(!is_null($id)){
    //         $data = KomponenGroupDetail::with('KomponenGroups')->whereHas('KomponenGroups')->where('gkomponen_id',$id)->get();
    //     }else{
    //         $data = KomponenGroupDetail::all();
    //     }
        
    //     return view('komponengroupdetail.index',compact('subtitle','icon','data'));
    // }

    public function index($id = 0) {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Komponen Groups Detail';
        $table_id = 'tbm_komponengroupdetail';
        // dd($id);
        // $group = KomponenGroups::all();

        Session::put('komiks_url', request()->fullUrl());
        Session::put('data_url', request()->fullUrl());

        return view('komponengroupdetail.index',compact('subtitle','table_id','icon','id'));

    }

    public function listData(Request $request, $id){
        // $data = KomponenGroupDetail::with('KomponenGroups');
        $data = KomponenGroupDetail::with('KomponenGroups')->whereHas('KomponenGroups')->get();
        if(($id!=0)){
            $data = KomponenGroupDetail::with('KomponenGroups')->whereHas('KomponenGroups')->where('gkomponen_id',$id)->get();
        }else{
            // $data = KomponenGroupDetail::all();
            $data = KomponenGroupDetail::with('KomponenGroups');
        }
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->EditColumn('KomponenGroups.group', function($data){
                    return $data->KomponenGroups->group;
                })
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/komponengroupdetail/edit/".$data->id."' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->gkomponen_detail}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-nama='{$data->gkomponen_detail}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(KomponenGroupDetail::destroy($request->id)){
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
        $subtitle = 'Tambah Data Komponen Group Detail';
        $gkomponen = KomponenGroups::all();
        $pegawai = Pegawai::all();
        return view('komponengroupdetail.create',compact('subtitle','icon','gkomponen','pegawai'));
    }

    public function createSpesific($id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Tambah Data Komponen Group Detail';
        $gkomponen = KomponenGroups::where('id', $id)->get();
        $pegawai = Pegawai::all();
        return view('komponengroupdetail.create',compact('subtitle','icon','gkomponen','id','pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->gkomponen_id == 1){
            $pegawai_id = $request -> gkomponen_detail;
            $pegawai = Pegawai::find($pegawai_id);
            $gdetail = new KomponenGroupDetail();
            $gdetail -> gkomponen_detail = $pegawai -> nama;
            $gdetail -> gkomponen_id = $request -> gkomponen_id;
            $data = $gdetail -> save();
        } else {
            KomponenGroupDetail::create($data);
        }
        // $pegawai_id = $request -> gkomponen_detail;
        // $pegawai = Pegawai::find($pegawai_id);
        // $gdetail = new KomponenGroupDetail();
        // $gdetail -> gkomponen_id = $request -> gkomponen_id;
        // $gdetail -> gkomponen_detail = $pegawai -> nama;
        // $data = $gdetail -> save();
        
        // $group_id = $request -> group;
        // $group = KomponenGroups::find($group_id);
        // $tkomiks = new TransaksiKomIKS();
        // $tkomiks -> iks_provider_id = $request -> nama_iks;
        // $tkomiks -> iks_gkomponen_id = $request -> iks_gkomponen_id;
        // $tkomiks -> group = $group -> group;
        // $tkomiks -> save();
        
        // $data = $request->all();
        // KomponenGroupDetail::create($data);
        session()->flash('message','Data Berhasil Ditambahkan');
        

        if(session(key:'komiks_url')){
            return redirect(session(key:'komiks_url'));
        }


        return redirect()->route('komponengroupdetail.index');
        // return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KomponenGroupDetail  $komponenGroupDetail
     * @return \Illuminate\Http\Response
     */
    public function show(KomponenGroupDetail $komponenGroupDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KomponenGroupDetail  $komponenGroupDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(KomponenGroupDetail $komponenGroupDetail, $id)
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Komponen Group Detail';
        $data = KomponenGroupDetail::find($id);
        $gkomponen = KomponenGroups::all();
        return view('komponengroupdetail.edit',compact('icon','subtitle','data','gkomponen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KomponenGroupDetail  $komponenGroupDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = KomponenGroupDetail::find($id);
        $data->fill($request->all())->save();
        session()->flash('message',$data['gkomponen_detail'].'  Berhasil Diubah');
        if(session(key:'data_url')){
            return redirect(session(key:'data_url'));
        }
        return redirect()->route('komponengroupdetail.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KomponenGroupDetail  $komponenGroupDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(KomponenGroupDetail $komponenGroupDetail, Request $request)
    {
        KomponenGroupDetail::find($request->id)->delete();
        return redirect()->route('komponengroupdetail.index');
    }
}
