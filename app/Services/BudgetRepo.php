<?php

namespace App\Services;

class BudgetRepo implements IBudgetRepo
{
   public function getAll(){
       return [
           [
               'year_month' => '202210',
               'amount' => 3100
           ],
           [
               'year_month' => '202211',
               'amount' => 3000
           ],
       ];
   }
}