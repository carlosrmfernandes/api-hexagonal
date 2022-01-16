<?php

namespace App\Report;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\DeliveryOrder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AdminReport implements FromCollection, WithMapping, WithHeadings {

    public $parameters;

    public function __construct($parameters = null) {
        $this->parameters = $parameters;
    }

    public function map($item): array {
        $array = [];
        $array[] = $item->company_name;
        $array[] = $item->cpf_cnpj;
        $array[] = $item->email;
        $array[] = $item->phone;
        $array[] = $item->amount_total;
        $array[] = $this->parameters['from'];
        $array[] = $this->parameters['to'];


        return $array;
    }

    public function headings(): array {
        return [
            'Logista',
            'CNPJ/CPF',
            'Email',
            'Telefone',
            'Valor á ser pago',
            'Data Inicial',
            'Data Final'
        ];
    }

    public function collection() {

        $query = DeliveryOrder::leftJoin('users', 'delivery_orders.seller_id', '=', 'users.id')
                        ->select([
                            'users.company_name',
                            'users.cpf_cnpj',
                            'users.email',
                            'users.phone',
                            DB::raw('sum(delivery_orders.amount_total) as amount_total'),
                        ])->groupBy([
            'users.company_name',
            'users.cpf_cnpj',
            'users.email',
            'users.phone',
        ]);
        $from = $this->parameters['from'] . ' ' . '00:00:00';
        $to = $this->parameters['to'] . ' ' . '23:59:59';

        return $query
                        ->whereBetween('delivery_orders.created_at', [$from, $to])
                        ->get();
    }

}
