<?php

namespace MetaverseSystems\MultiChain\Controllers;

use Illuminate\Http\Request;
use MetaverseSystems\MultiChain\Facades\MultiChain;

class StreamController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->chain = MultiChain::get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->chain->liststreams("*", true);
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
        $name = $request->input('name');
        $open = ($request->input('open') == 0) ? false : true;

        return MultiChain::create('stream', $name, $open);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $chainname
     * @param  string  $stream_id
     * @return \Illuminate\Http\Response
     */
    public function show($chainname, $id)
    {
        $data = [
            'stream' => $this->chain->getstreaminfo($id, true),
            'permissions' => $this->chain->listpermissions($id.".*", "*", true)
        ];
        return $data;
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
        //
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
