<?php

namespace MetaverseSystems\MultiChain\Controllers;

use Illuminate\Http\Request;
use MetaverseSystems\MultiChain\Facades\MultiChain;

class NodeController extends \App\Http\Controllers\Controller
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
    public function index($chain)
    {
        return $this->chain->getpeerinfo();
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
    public function store($chain, Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($chain, $node)
    {
        return [
            'runtimeparams'=>$this->chain->getruntimeparams(),
            'info'=>$this->chain->getinfo(),
            'initstatus'=>$this->chain->getinitstatus()
        ];
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
