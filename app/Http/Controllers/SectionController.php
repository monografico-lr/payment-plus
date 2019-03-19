<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use App\Section;
use App\Ip;

class SectionController extends ApiController
{
    public function __construct(Section $section)
    {
        $this->model = $section;
        $this->searchable = ["id"];
        $this->createdMessage = "Seccion creada con exito";
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dump($request->post());
        try {
            DB::beginTransaction();
            $resource = $this->model::create($request->post());
            $this->createIps($resource->id);
            DB::commit();
            return [
                "message" => $this->createdMessage,
                "data" => $resource
            ];
        } catch (\Exception $e) {
            DB::rollback();
            return [
                "message" => $e->getMessage(), 
                "data" => $e
            ];
        }
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ips(Request $request, $id)
    {
        $limit = $request->get('limit');
        $search = $request->get('search');
        $limit = $limit ? $limit : 50;
        $section = $this->model::find($id);

        if ($search) {
            try {
                return $section->ips()->search($search)->paginate($limit);
            } catch (\Exception $exception) {
                return $this->localIpSearch($search, $limit);
            }
        }

        return $section->ips()->with('section')->paginate($limit);
    }

    private function createIps($sectionId) {
        for ($i=2; $i <= 250; $i++) {
            $ip = Ip::create([
                'id_seccion'   => $sectionId,
                'codigo_final' => $i,
                'estado' => 1
            ]);
            $this->model->ips($ip);
        }
    }
}
