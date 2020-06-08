<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salone;


class SalonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $salon = Salone::get();
        return $salon;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sal_cod' => 'required|max:10000|numeric|unique:salones',
            'sal_cur' => 'required|max:10000'
        ]);
        $salon = new Salone();
        $salon->sal_cod = $request->sal_cod;
        $salon->sal_cur = $request->sal_cur;
        $salon->user_id = auth()->id();
        $salon->save();
        return $salon;
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
        //
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
        $request->validate([
            'sal_cod' => 'required|max:10000|numeric|unique:salones,sal_cod,'.$id,
            'sal_cur' => 'required|max:10000'
        ]);
        $salon = Salone::find($id);
        $salon->sal_cod = $request->sal_cod;
        $salon->sal_cur = $request->sal_cur;
        $salon->save();
        return $salon;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salon = Salone::find($id);
        $salon->delete();
    }
}
