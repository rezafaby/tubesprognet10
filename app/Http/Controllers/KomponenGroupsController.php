<?php

namespace App\Http\Controllers;

use App\Models\KomponenGroups;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KomponenGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $icon = 'ni ni-dashlite';
        $subtitle = 'Komponen Groups';
        $table_id = 'tbkomponengroups';
        return view('komponengroups.index',compact('subtitle','table_id','icon'));
    }

    public function listData(Request $request){
        $data = KomponenGroups::all();
        $datatables = DataTables::of($data);
        return $datatables
                ->addIndexColumn()
                ->addColumn('aksi', function($data){
                    $aksi = "";
                    $aksi .= "<a title='Edit Data' href='/komponengroups/".$data->id."/edit' class='btn btn-md btn-primary' data-toggle='tooltip' data-placement='bottom' onclick='buttonsmdisable(this)'><i class='ti-pencil' ></i></a>";
                    $aksi .= "<a title='Delete Data' href='javascript:void(0)' onclick='deleteData(\"{$data->id}\",\"{$data->group}\",this)' class='btn btn-md btn-danger' data-id='{$data->id}' data-group='{$data->group}'><i class='ti-trash' data-toggle='tooltip' data-placement='bottom' ></i></a> ";
                    return $aksi;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function deleteData(Request $request){
        if(KomponenGroups::destroy($request->id)){
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
        $subtitle = 'Tambah Data Mahasiswa';
        return view('komponengroups.create',compact('subtitle','icon'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        KomponenGroups::create($request->all());
        return redirect()->route('komponengroups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KomponenGroups  $komponenGroups
     * @return \Illuminate\Http\Response
     */
    public function show(KomponenGroups $komponenGroups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KomponenGroups  $komponenGroups
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = KomponenGroups::find($request->id);
        $icon = 'ni ni-dashlite';
        $subtitle = 'Edit Data Komponen Group';
        return view('komponengroups.edit',compact('subtitle','icon','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KomponenGroups  $komponenGroups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = KomponenGroups::find($id);
        $data->fill($request->all())->save();
        return redirect()->route('komponengroups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KomponenGroups  $komponenGroups
     * @return \Illuminate\Http\Response
     */
    public function destroy(KomponenGroups $komponenGroups)
    {
        //
    }
}
