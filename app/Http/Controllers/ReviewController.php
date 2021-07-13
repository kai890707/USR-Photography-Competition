<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Group;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public $group;
    public function __construct()
    {
        $this->middleware('frontpermission');
        $this->group = new Group();
    }
    public function index()
    {
        //
        $donegroup = $this->group->getGroup();
        $undonegroup = $this->group->getGroup();
        return view('front.control',compact('donegroup','undonegroup'));
    
    }
    public function getGroup(Request $request)
    {
        # code...
        $allGroup  = $this->group->getGroup();
        return response()->json($allGroup);
    }
    public function items($id)
    {
        # code...
        return view('front.item');
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
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}