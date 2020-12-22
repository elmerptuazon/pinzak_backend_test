<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use App\Http\Resources\News as NewsResource;
use App\Http\Resources\NewsCollection;
use App\Http\Requests\ValidateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $news = News::paginate(10);

            return response(['status'=>'success', 'data'=>new NewsCollection($news)]);
            }catch(\Exception $err) {
                return response(['status'=>'failed', 'message'=>$err]);
            }
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
    public function store(ValidateNewsRequest $request)
    {
        try{
            $data = $request->all();

            $news = News::create($data);

            return response(['status'=>'success', 'data'=>new NewsResource($news)]);
        }catch(\Exception $err) {
            return response(['status'=>'failed', 'message'=>$err]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        try{
            $get_news = News::where('id', $news->id)->first();

            return response(['status'=>'success', 'data'=>new NewsResource($get_news)]);
        }catch(\Exception $err) {
            return response(['status'=>'failed', 'message'=>$err]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateNewsRequest $request, News $news)
    {
        try{
            $data = $request->all();

            $update_news = News::where('id', $news->id)->update($data);
            $get_updated_news = News::where('id', $news->id)->first();

            return response(['status'=>'success', 'data'=>new NewsResource($get_updated_news)]);
        }catch(\Exception $err) {
            return response(['status'=>'failed', 'message'=>$err]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        try{
            News::where('id', $news->id)->delete();

            return response(['status'=>'success', 'data'=>'News deleted.']);
        }catch(\Exception $err) {
            return response(['status'=>'failed', 'message'=>$err]);
        }
    }
}
