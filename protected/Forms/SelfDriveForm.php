<?php

/**
 * @author Ctel
 * @ignore It will handle the form validations of Self Drive Search
 */
class SelfDriveForm extends CFormModel {

    public $self_vehicle_id;
    public $self_book_location;
    public $trip_start_date_time;
    public $trip_end_date_time;
    public $self_collection_mode;
    public $location;

    /**
     * @author Ctel
     * @return array It will return array of errors if not satisfied the criteria
     */
    public function rules() {
        return array(
            array('self_vehicle_id,self_book_location,trip_start_date_time,trip_end_date_time,self_collection_mode,location', 'required', 'message' => '{attribute} is required.'),
            array('trip_end_date_time','isChecking'),
         
        );
    }
    
       public function attributeLabels() {
        return array(
            'self_vehicle_id' => 'Vehicle',
            'self_book_location' => 'Booking Location',
            'trip_start_date_time' => 'Trip Strat Date',
            'trip_end_date_time' => 'Trip End Date',
            'self_collection_mode' => 'Collection ',
            'location' => 'location',
        );
    }


        public function isChecking($attribute){

        $startdate = new DateTime($this->trip_start_date_time);
        $strStartDateNTime = $startdate->format('Y-m-d');
        $startTime = $startdate->format('H:i');
        $enddate = new DateTime($this->trip_end_date_time);
        $strEndDateNTime = $enddate->format('Y-m-d');
        $endTime = $enddate->format('H:i');

        list($strHour, $strMin) = explode(':', $startTime);
        list($endHour, $endMin) = explode(':', $endTime);
        list($strYear, $strMonth, $strDay) = explode('-', $strStartDateNTime);
        list($endYear, $endMonth, $endDay) = explode('-', $strEndDateNTime);

        $startSeconds = mktime($strHour, $strMin, 0, $strMonth, $strDay, $strYear);
        $endSeconds = mktime($endHour, $endMin, 0, $endMonth, $endDay, $endYear);

        if ($startSeconds < $endSeconds) {
            return true;
        } else {
            $this->addError('trip_end_date_time', 'End Date & time is not more than start date');
            return false;
        }
    }

}
