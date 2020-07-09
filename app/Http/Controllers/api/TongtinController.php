<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TongtinResource;
use App\Tongtin;

class TongtinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TongtinResource::collection( Tongtin::paginate(10) );
    }
    public function TongtinAll()
    {
        return TongtinResource::collection( Tongtin::orderBy('name', 'asc')->get() );
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
        //return $request->all();
        return Tongtin::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TongtinResource(Tongtin::find($id));
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
        $tongtin = Tongtin::find($id);

        $tongtin->start_date = $request->start_date;
        $tongtin->name = $request->name;
        $tongtin->amount = $request->amount;
        $tongtin->number_of_play = $request->number_of_play;
        $tongtin->number_of_player = $request->number_of_player;
        $tongtin->description = $request->description;
        $tongtin->status_id = $request->status_id;
        return $tongtin->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Tongtin::destroy($id);
    }
}
