<?php
// app/Library/Services/DemoOne.php
namespace App\Services;

use App\Interfaces\DateCalculatorInterface;
use Illuminate\Support\Facades\Date;
use Ouzo\Utilities\Clock;
use phpDocumentor\Reflection\Types\Boolean;

class DueDate implements DateCalculatorInterface
{
    /**
     *
     * @returns Date
     *
     * due date --> datetime.now + 16h
     *
     * ticket can arrive outside of working hours
     *
     * ticket arrives before: 09:00 -> 16h clock ticking starts at 09:00 that day
     *
     * ticket arrives after: 17:00 -> 16h clock ticking start at 09:00 the next day
     *
     * ticket arrives between 09:00 and 17:00 -> 16h clock ticking start right after submitting, stops at 17:00 that day
     * and starts from next day 09:00
     *
     *                             YYYY MM DD HH MM
     * Example: ticket arrives at: 2020.01.01 09:00.  due date -> 2020.01.02. 17:00
     *
     * Working hours:
     * Monday
     * 9 10 11 12 13 14 15 16 17
     *
     * Tuesday
     * 9 10 11 12 13 14 15 16 17
     *
     * Wednesday
     * 9 10 11 12 13 14 15 16 17
     *
     * Thursday
     * 9 10 11 12 13 14 15 16 17
     *
     * Friday
     * 9 10 11 12 13 14 15 16 17
     *
     */
    public function calculate()
    {
        $date = Clock::now(); //submit date

        //case: ticket arrives before 09:00-----------------------------------------------------------------------------
        if($this->isBeforeWorkingHour()){
            // I cloud set the due date to tuesday 17:00 becasue if the ticket arrives in the weekends, it will be always tuesday 17PM
            //but in this case we will add the hours separately

            $newDate = $this->fromWeekendsToMonday($date); // check if the submit happened on the weekend
            $year = substr($newDate->toDateTime()->format('Y-m-d H:i:s'),0,10);// get the year/month/day from the full date form
            $newDate = Clock::at($year . " " ."09:00" ); //set the clock for 09:00 that day

            $newDatePlusHours = $newDate->plusHours(8); //added 8 hours for that day, we are now at 17:00 (same day) - remaining hours: 8

            $finalDate = $this->plusHoursForNextDay($newDatePlusHours);//skip for tomorrow and add the remaining 8 hours

            return $finalDate->toDateTime(); //final due date if ticket arrives any day before 09:00

            //case: ticket arrives after 17:00--------------------------------------------------------------------------
        } else if($this->isAfterWorkingHour()) {
            $dateTime = $date->toDateTime();

            if($this->isSaturday($dateTime) == true || $this->isSunday($dateTime) == true){ //if it is one of the weekdays
                $newDate = $this->fromWeekendsToMonday($date); // jump to monday
            } else {
                $nextDay = $date->plusDays(1);              //next day: if it is friday, the next day is gonna be a weekend then
                if($this->isSaturday($nextDay->toDateTime())) {
                    $newDate =  $date->plusDays(3);         // jump to monday
                } else {
                    $newDate = $this->skipForNextDay($date); //if it was in weekday, skip for the next week day
                }
            }
            //set the time to 09:00 AM that day
            $year = substr($newDate->toDateTime()->format('Y-m-d H:i:s'),0,10);
            $newDate = Clock::at($year . " " ."09:00" );

            $newDatePlusHours = $newDate->plusHours(8); //added 8 hours for that day, we are now at 17:00 (same day) - remaining hours: 8
            $finalDate = $this->plusHoursForNextDay($newDatePlusHours); //skip for tomorrow and add the remaining 8 hours

            return $finalDate->toDateTime(); //final due date if ticket arrives any day after 09:00

            //case: ticket arrives in working hours---------------------------------------------------------------------
        } else if($this->isInWorkingHour()){
            $estimateTime = 16; // current 16h estimate time
            $date = Clock::now(); // date to set

            //case: the ticket arrives in the weekends (in working hours ofc)
            $date = $this->fromWeekendsToMonday($date); //skip the weekend
            $year = substr($date->toDateTime()->format('Y-m-d H:i:s'),0,10);
            $date = Clock::at($year . " " ."09:00" ); //set the clock for 09:00 that day

            while($estimateTime != 0) {
                $year = substr($date->toDateTime()->format('Y-m-d H:i:s'),0,10);//get the y/m/d from date var.

                while($date->toDateTime()->format('Y-m-d H:i:s') !== Clock::at($year . ' 17:00:00')->toDateTime()->format('Y-m-d H:i:s')){
                    $date = $date->plusHours(1);
                    if( 1 <= $estimateTime ){ // make sure to do not go minus
                        $estimateTime--;
                        if($estimateTime == 0)
                            return $date->toDateTime(); // 0 estimated hour remaining, we got it!
                    } else {
                        break;
                    }

                }
                //while are out of the while loop which means we are the same day at 17:00.
                //we have to go for the next day but we have to check if it is gonna be a weekend or not.
                //in case if it is a weekend that means the ticket arrived in friday

                $nextDay = $date->plusDays(1)->toDateTime(); // the next day

                if($this->isSaturday($nextDay) == true) { //check if it is saturday then skip to monday 09:00
                    $date = $date->plusDays(3);
                    $year = substr($date->toDateTime()->format('Y-m-d H:i:s'),0,10);
                    $date = Clock::at($year . " 09:00:00");
                } else { //if not, skip for the next workday start. ---> 09:00
                    $date = $this->skipForNextDay($date);
                    $year = substr($date->toDateTime()->format('Y-m-d H:i:s'),0,10);
                    $date = Clock::at($year . " 09:00:00");
                }
            }
        }
    }


    /***
     * if not weekend, skip for the next day
     *
     * @return Clock
     */
    public function skipForNextDay($date){
        if(($this->isSaturday($date->toDateTime()) == false && $this->isSunday($date->toDateTime()) == false)){
            $newDate = $date->plusDays(1);
            return $newDate;
        }
            return $date;
    }


    /***
     * check if the date is before working hour
     *
     * @return bool
     */
    public function isBeforeWorkingHour(){
        $date = Clock::now(); //date to set
        $year = substr($date->toDateTime()->format('Y-m-d H:i:s'),0,10); //YYYY-MM-DD

        if($date->isBefore(Clock::at($year .' 09:00'))){
            return true;
        } else {
            return false;
        }
    }


    /***
     * check if the date is after working hour
     *
     * @return bool
     */
    public function isAfterWorkingHour(){
        $date = Clock::now(); //date to set
        $year = substr($date->toDateTime()->format('Y-m-d H:i:s'),0,10); //YYYY-MM-DD

        if($date->isAfter(Clock::at($year .' 17:00'))){
            return true;
        } else {
            return false;
        }
    }


    /***
     * check if the date is in working hour
     *
     * @return bool
     */
    public function isInWorkingHour(){
        $date = Clock::now(); //date to set
        $year = substr($date->toDateTime()->format('Y-m-d H:i:s'),0,10); //YYYY-MM-DD

        if($date->isAfter(Clock::at($year .' 08:59')) && $date->isBefore(Clock::at($year .' 17:01'))){
            return true;
        } else {
            return false;
        }
    }


    /**
     * check if the current day is Saturday
     *
     * @param $date YYYY-MM-DD
     * @return bool
     */
    public function isSaturday($date) {
        $dt1 = strtotime($date->format('Y-m-d H:i:s')); //accepts string, i had to format datetime
        $dt2 = date("l", $dt1);
        $dt3 = strtolower($dt2);

        if($dt3 == "saturday" )
        {
           return true;
        }
        else
        {
            return false;
        }
    }


    /**
     * check if the current day is Sunday
     *
     * @param $date YYYY-MM-DD
     * @return bool
     */
    public function isSunday($date) {
        $dt1 = strtotime($date->format('Y-m-d H:i:s')); //accepts string, i had to format datetime
        $dt2 = date("l", $dt1);
        $dt3 = strtolower($dt2);

        if($dt3 == "sunday")
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    /**
     * If the ticket comes in the weekend, skip these two days and jump to the first working day, Monday
     *
     * @param $date
     * @return Clock
     */
    public function fromWeekendsToMonday($date){
        if($this->isSaturday($date->toDateTime()) == true) {  //if it is Saturday, we add to days to reach Monday
            $newdate = $date->plusDays(2);
            return $newdate;
        } else if($this->isSunday($date->toDateTime())) { //if it is Sunday, we add one day to reach Monday
            $newdate = $date->plusDays(1);
            return $newdate;
        }else {
            return $date;
        }
    }


    /**
     * Add plus 8 hours to next day (current time 9AM --> next day + 8 hours) weekend problem handled
     *
     * @param $date
     * @return Clock
     */
    public function plusHoursForNextDay($date){
        //we have to check again if the next day is gonna be saturday (that means the ticket arrived at friday before 9AM)
        $nextDay = $date->plusDays(1);
        if($this->isSaturday($nextDay->toDateTime())) {

            //skip for Monday morning 09:00 + add the remaining 8 hours
            $newDate = $date->plusDays(3);

            $year = substr($newDate->toDateTime()->format('Y-m-d H:i:s'),0,10);
            $newDate = Clock::at($year . " " ."17:00");
            return $newDate;
        } else {
            //it is not Saturday, go for the next day 09:00 and add the remaining 8 hours
            $newDate = $date->plusDays(1);
            $year = substr($newDate->toDateTime()->format('Y-m-d H:i:s'),0,10);
            $newDate = Clock::at($year . " " ."17:00");
            return $newDate;
        }
    }
}
