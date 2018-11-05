<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use App\Contract;
use App\Payment;

class ContractController extends ApiController
{
    public function __construct(Contract $contract)
    {
        $this->model = $contract;
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
        try {
            DB::beginTransaction();
            $resource = $this->model::create($request->post());
            $this->createPayments($resource->id, $resource);
            $this->setIp($resource);
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
    public function payments(Request $request, $id)
    {
        $limit = $request->get('limit');
        $search = $request->get('search');
        $limit = $limit ? $limit : 50;
        $contract = $this->model::find($id);

        if ($search) {
            try {
                return $contract->payments()->search($search)->paginate($limit);
            } catch (\Exception $exception) {
                return $this->localIpSearch($search, $limit);
            }
        }

        return $contract->payments()->with('contract')->paginate($limit);
    }

    private function createPayments($contractId, $data) {
        $contract_date = new DateTime($data->fecha);
        $next_payment_date = $contract_date;
        $duration = $data->duracion;
        $concept = "Instalación";
        $paymentAmount = $data->mensualidad;
    
        for ($i; $i < $duration + 1; $i++) {
          if ($i > 0) $concepto = "mensualidad";
    
          $new_data = [
            'id_contrato' => $contractId,
            'id_servicio' => $data->id_servicio,
            'fecha_pago'  => null,
            'concepto'    => $concept,
            'cuota'       => $paymentAmount,
            'mora'        => 0,
            'total'       => $paymentAmount,
            'estado'      => 0,
            'fecha_limite'=> $next_payment_date->format("Y-m-d")
          ];
    
          $payment = Payment::create($new_data);
          $this->model->payments($payment);
          $next_payment_date = get_next_date($next_payment_date);
        }
    }

    private function set_ip($data) {
        $resource = App\Ip::find($data->ip);
        $resource->update(["id_contrato" => $data->$data->id]);
    }
}
