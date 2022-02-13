<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RuleTelat;

class RuleTelatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validation($request)
    {
        $validate_data = $this->validate(
            $request,
            [
                'namaRuleTelat' => 'required',
                'maxTelatMasuk' => 'required',
            ],
            [
                'namaRuleTelat.required' => 'Nama Rule harus diisi',
                'maxTelatMasuk.required' => 'Maksimal telat masuk harus diisi',
            ]
        );
        return $validate_data;
    }

    public function index()
    {
        $ruleTelat = RuleTelat::all();
        return view('pages.rule_telat.index', compact('ruleTelat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Tambah Rule Telat Presensi";
        $isEdit = false;
        return view('pages.rule_telat.create_edit', compact('page', 'isEdit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        RuleTelat::create($request->all());
        return redirect('ruletelat')->with('success','Berhasil Menambah Data Rule Telat');
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
        $page = "Edit Rule Telat Presensi";
        $isEdit = true;
        $ruleTelat = RuleTelat::find($id);
        return view('pages.rule_telat.create_edit', compact('page', 'isEdit', 'ruleTelat'));
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
        $this->validation($request);
        $ruleTelat = RuleTelat::find($id);
        $ruleTelat->namaRuleTelat = $request->namaRuleTelat;
        $ruleTelat->maxTelatMasuk = $request->maxTelatMasuk;
        $ruleTelat->maxTelatPulang =  $request->maxTelatPulang;
        $ruleTelat->save();
        return redirect('ruletelat')->with('success','Berhasil Mengubah Data Rule Telat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruleTelat = RuleTelat::find($id);
        $ruleTelat->destroy();
        return redirect('ruletelat')->with('success','Berhasil Menghapus Data Rule Telat');
    }
}
