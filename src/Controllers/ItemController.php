<?php

namespace MetaverseSystems\MultiChain\Controllers;

use Illuminate\Http\Request;
use MetaverseSystems\MultiChain\Facades\MultiChain;

class ItemController extends \App\Http\Controllers\Controller
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
    public function index($chain, $stream)
    {
        $items = MultiChain::liststreamitems($stream, true);
        foreach($items as $item)
        {
            $item->plain = hex2bin($item->data);
        }
        return response()->json($items, 200);
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
    public function store($chain, $stream, Request $request)
    {
        $key = $request->input("key");
        $item = bin2hex(json_encode($request->input("item")));

        $txid = MultiChain::publish($stream, $key, $item);
        return $this->show($chain, $stream, $key);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $chain
     * @param  string  $stream
     * @param  string $item
     * @return \Illuminate\Http\Response
     */
    public function show($chain, $stream, $item)
    {
        $items = MultiChain::liststreamkeyitems($stream, $item, true);

        foreach($items as $item)
        {
            $item->plain = hex2bin($item->data);
        }
        return response()->json($items, 200);
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
