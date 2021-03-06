<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

abstract class ApiController extends Controller
{
    protected $model;
    protected $createdMessage = "created";
    protected $searchable = ["id"];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit');
        $filter = $request->get('filter');
        $search = $request->get('search');
        $limit = $limit ? $limit : 50;

        if ($filter) {

        }

        if ($search) {
            try {
                return $this->model::search($search)->paginate($limit);
            } catch (\Exception $exception) {
                return $this->localSearch($search, $limit);
            }
        }

        return $this->model::paginate($limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resource = $this->model::create($request->post());
        return [
            "message" => $this->createdMessage,
            "data" => $resource
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->model::find($id);
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
        dump($request->post());
        $resource = $this->model::find($id);
        $resource->update($request->post());
        return $resource;
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
        $resource = $this->model::find($id);
        $resource->delete();
        return $resource;
    }

    private function localSearch($search, $limit)
    {
        $whereRaw = '';
        foreach ($this->searchable as $field) {
            if (!$whereRaw) {
                $whereRaw .= "$field like '%$search%'";
            } else {
                $whereRaw .= " or $field like '%$search%'";
            }
        }
        return $this->model::whereRaw($whereRaw)->paginate($limit);
    }

    public function report(Request $request)
    {
        $limit = $request->get('limit');
        $search = $request->get('search');
        $limit = $limit ? $limit : 50;

        if ($search) {
            try {
                return $this->model::search($search)->paginate($limit);
            } catch (\Exception $exception) {
                return $this->localSearch($search, $limit);
            }
        }

        return $this->model::paginate($limit);
    }
}
