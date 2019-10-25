<?php

namespace App\Http\Controllers;

use App\Repositories\Chapter\ChapterRepository;
use App\Repositories\Lession\LessionRepository;
use Illuminate\Http\Request;

class JoinCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $chapter, $lession;


    public function __construct(ChapterRepository $chapterRepository,
                                LessionRepository $lessionRepository)
    {
        $this->chapter = $chapterRepository;
        $this->lession = $lessionRepository;
    }

    public function index($class_id)
    {
        $parentChapters = $this->chapter->getParentChapter($class_id);

        return view('view.pages.join_course', compact('parentChapters'));
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

    public function showLession($class_id, $lession_id){
        $lession = $this->lession->getLession($lession_id);
        $parentChapters = $this->chapter->getParentChapter($class_id);

        return view('view.pages.content_course', compact(['lession', 'parentChapters']));
    }
}
