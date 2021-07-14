<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public $portfolio;
    public function __construct()
    {
        # code...
        $this->portfolio = new Portfolio();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all = $this->portfolio->getAllItems();
        return view('portfolio.index',compact('all'));
    }
    /**
     * $id=>圖片ID
     */
    public function getItems(Request $request,$id)
    {
        # code...
        $photoInfos = $this->portfolio->getItemOfPhoto($id);
        if(count($photoInfos)==0){
            return view('404');
        }else{
            $getItemOfNext = $this->portfolio->getItemOfNext($request,$id,$photoInfos[0]["groupId"]);
            $compactArray = array('photoInfos','getItemOfNext');
            return view('portfolio.item',compact($compactArray));
        }
  
    }
  
    public function getGroupOfItem()
    {
        # code...
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
}