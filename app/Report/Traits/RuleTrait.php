<?php
namespace App\Report\Traits;
trait RuleTrait
{

    public function rules($id = null)
    {
        return [
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d',
            
        ];
    }
        
}
