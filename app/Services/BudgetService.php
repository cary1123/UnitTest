<?php

namespace App\Services;

use Carbon\Carbon;
use SebastianBergmann\Comparator\DateTimeComparator;

class BudgetService
{
    /**
     * @var IBudgetRepo
     */
    private $repo;

    public function __construct(IBudgetRepo $budgetRepo)
    {
        $this->repo = $budgetRepo;

    }

   public function query(\DateTime $start,\DateTime $end)
   {
       if (Carbon::parse($start) > (Carbon::parse($end))){
           return 0;
       }

       $data = $this->repo->getAll();

       if (date('m', strtotime($start)) === date('m', strtotime($end))) {
            $year_month = date('Ym', strtotime($start));
            return collect($data)->where('year_month', $year_month)->toArray();
       }else{

           $startDate = Carbon::parse($start);
           $endDate = Carbon::parse($end);

           $amountTotal = 0;
           $diffMonth = $startDate->diffInMonths($endDate);
           $diffDate = $startDate->diffInDays($endDate);
           $budgetData = collect($data)->toArray();


//           for($i = 0; $i <= $diffMonth; $i++){
             foreach ($budgetData as $budget){
               $nowMonth = date('m', strtotime($budget['year_month']));
               $nowYear = date('Y', strtotime($budget['year_month']));
               $nowYearMonth = date('Ym', strtotime($budget['year_month']));

               $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $nowMonth, $nowYear);
               $amountDay = round($budget['amount'] / $daysInMonth, 2);
               for($j = 0; $j < $diffDate; $j++){
                   $nowDiffYearMonth = date('Ym', strtotime("$start + $j Day"));
                   if($nowDiffYearMonth == $nowYearMonth){
                       $amountTotal += $amountDay;
                   }
               }
           }

           return $amountTotal;
       }


   }


}