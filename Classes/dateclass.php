<?php
    
    class DateClass
    {
        //Class Varibles
        var $c_Day;
        var $c_Month;
        var $c_Year;
        
        //Set Normal Date
        function setnormaldate($normaldate)
        {
            if(substr($normaldate,2,1) == "/"){
                //Normal Date
                $this->c_Day = substr($normaldate,0,2);
                $this->c_Month = substr($normaldate,3,2);
                $this->c_Year = substr($normaldate,6,4);
            } else {
                //Database Date
                $this->c_Year = substr($normaldate,0,4);
                $this->c_Month = substr($normaldate,5,2);
                $this->c_Day = substr($normaldate,8,2);
            }
        }
        
        //Get Normal Date
        function getnormaldate()
        {
            return $this->c_Day . "/" . $this->c_Month . "/" . $this->c_Year;
        }
        
        //Get String Date Short Format
        function stringdateshort()
        {
            return $this->c_Day . " " . $this->monthstring . " " . $this->c_Year;
        }
        
        //Set Database Date
        function setdatabasedate($databasedate)
        {
            $this->c_Year = substr($databasedate,0,4);
            $this->c_Month = substr($databasedate,5,2);
            $this->c_Day = substr($databasedate,8,2);
        }
        
        //Get Database Date
        function getdatabasedate()
        {
            return $this->c_Year . "/" . $this->c_Month . "/" . $this->c_Day;
        }
        
        //Set Day
        function setday($day)
        {
            $this->c_Day = $day;
        }
        
        //Get Day
        function getday()
        {
            if($this->c_Day <= 9){
                return "0" . $this->c_Day;
            } else {
                return "" . $this->c_Day;
            }
        }
        
        //Get Day Value
        function getdayval()
        {
            return $this->c_Day;
        }
        
        //Get Day String
        function getdaystring()
        {
            switch($this->c_Day)
            {
                case 1: return "1st";
                case 2: return "2nd";
                case 3: return "3rd";
                case 4: return "4th";
                case 5: return "5th";
                case 6: return "6th";
                case 7: return "7th";
                case 8: return "8th";
                case 9: return "9th";
                case 10: return "10th";
                case 11: return "11th";
                case 12: return "12th";
                case 13: return "13th";
                case 14: return "14th";
                case 15: return "15th";
                case 16: return "16th";
                case 17: return "17th";
                case 18: return "18th";
                case 19: return "19th";
                case 20: return "20th";
                case 21: return "21st";
                case 22: return "22nd";
                case 23: return "23rd";
                case 24: return "24th";
                case 25: return "25th";
                case 26: return "26th";
                case 27: return "27th";
                case 28: return "28th";
                case 29: return "29th";
                case 30: return "30th";
                case 31: return "31st";
            }
        }
        
        //Set Month
        function setmonth($month)
        {
            $this->c_Month = $month;
        }
        
        //Get Month
        function getmonth()
        {
            if($this->c_Month <= 9){
                return "0" . $this->c_Month;
            } else {
                return "" . $this->c_Month;
            }
        }
        
        //Get Month Value
        function getmonthval()
        {
            return $this->c_Month;
        }
        
        //Get Month String
        function getmonthstring()
        {
            switch($this->c_Month)
            {
                case 1: return "January";
                case 2: return "February";
                case 3: return "March";
                case 4: return "April";
                case 5: return "May";
                case 6: return "June";
                case 7: return "July";
                case 8: return "August";
                case 9: return "September";
                case 10: return "October";
                case 11: return "November";
                case 12: return "December";  
            }
        }
        
        //Set Year
        function setyear($year)
        {
            $this->c_Year = $year;
        }
        
        //Get Year
        function getYear()
        {
            return $this->c_Year;
        }
        
        //Get Year Value
        function getYearVal()
        {
            return $this->c_Year;
        }
        
        //Operations
        
        //Date Class Constructor
        function DateClass($classdate, $datestring, $day, $month, $year)
        {
            if($classdate)
            {
                //New Date from Class
                $this->c_Day = $classdate->c_Day;
                $this->c_Month = $classdate->c_Month;
                $this->c_Year = $classdate->c_Year;
            } else if($datestring) {
                //New Date from String
                $this->setnormaldate($datestring);
            } else if($day && $month && $year){
                //New Date from Day Month Year
                $this->c_Day = $day;
                $this->c_Month = $month;
                $this->c_Year = $year;
            } else {
                //Today
                $this->c_Day = date(d);
                $this->c_Month = date(m);
                $this->c_Year = date(Y);
            }   
        }
        
        //Add Days to Date
        function adddays($numberofdays)
        {
            do{
                if(($this->c_Day + $numberofdays) <= $this->daysinamonth()){
                    //Can Add Days
                    $this->c_Day += $numberofdays;
					if($this->c_Day <= 9)
					{
						$this->c_Day = "0" . $this->c_Day;
					}
                    $numberofdays = 0;
                } else {
                    //Add Month
                    $this->c_Day = "01";
                    $this->addmonths(1);
					$numberofdays -= ($this->daysinamonth() - $this->c_Day);
                }
            }while($numberofdays>0);
        }
        
        //Add Months to Date
        function addmonths($numberofmonths)
        {
            do{
                if(($this->c_Month + $numberofmonths) <= 12){
                    $this->c_Month += $numberofmonths;
					if($this->c_Month <= 9)
					{
						$this->c_Month = "0" . $this->c_Month;
					}
                    $numberofmonths = 0;
                } else {
                    $numberofmonths -= (12 - $this->c_Month);
                    $numberofmonths = 1;
                    $this->addyears(1);
                }
            }while($numberofmonths>0);
        }
        
        //Add Years to Date
        function addyears($numberofyears)
        {
            $this->c_Year += $numberofyears;
        }
        
        //Check Date is Valid
        function valid()
        {
            if($this->c_Month<=12){
                if($this->c_Day > $this->daysinamonth()){
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
        
        //Check if Year is Leap Year
        function isleapyear()
        {
            return ($this->c_Year%400==0) || ($this->c_Year%4==0 && $this->c_Year%100!=0);
        }
        
        //Number of Days in this Month
        function daysinamonth()
        {
            switch($this->c_Month)
            {
                case 1: return 31;
                case 2: if($this->isleapyear){ return 28; } else { return 29; }
                case 3: return 31;
                case 4: return 30;
                case 5: return 31;
                case 6: return 30;
                case 7: return 30;
                case 8: return 31;
                case 9: return 30;
                case 10: return 31;
                case 11: return 30;
                case 12: return 31;
            }
        }
        
        //Dates Equal
        function equals($classdate2)
        {
            if(($this->c_Day == $classdate2->c_Day) && ($this->c_Month == $classdate2->c_Month) && ($this->c_Year == $classdate2->c_Year)){
                return true;
            } else {
                return false;
            }
        }
        
        //Dates Greater Than
        function greaterthan($classdate2)
        {
            if($this->getdatabasedate() > $classdate2->getdatabasedate()){
                return true;
            } else {
                return false;
            }
        }
        
        //Dates Less Than
        function lessthan($classdate2)
        {
            if($this->getdatabasedate() < $classdate2->getdatabasedate()){
                return true;
            } else {
                return false;
            }
        }
        
        //To String
        function tostring()
        {
            return $this->getnormaldate();
        }
        
    }
    
?>