<?php

class Controller_Ajax extends Controller_Rest
{
   
    public function post_months()
    {
        $year = Input::post("year");
        $customerId = Input::post("customerId");

        $dateFrom = mktime(0, 0, 0, 1, 1, $year);
        $dateTo = mktime(0, 0, -1, 1, 1, $year + 1);

        $results = DB::select(array(DB::expr('MONTH(FROM_UNIXTIME(' . DB::quote_identifier('publicationdate') . '))'), 'month'))
                   ->from('clippings')
                   ->where('customer_id', '=', $customerId)
                   ->where('publicationdate', '>=', $dateFrom)
                   ->where('publicationdate', '<', $dateTo)
                   ->distinct(true)
                   ->execute()
                   ->as_array();

        $months = array();

        foreach ($results as $key => $value) 
        {
          $dateInt =  $value['month'];  
          $timestamp = mktime(0, 0, 0, $dateInt, 1, $year);
          $monthStr = date("F", $timestamp);

          $months[$dateInt] = $monthStr;
        }

        if(count($results) > 0)
        {
            return $this->response(array('months', $months));
        }
        else
        {
            return $this->response(array('error', 'geen items'));
        }
    }

    public function post_clippings()
    {
        $year = Input::post("year");
        $month = Input::post("month");
        $customerId = Input::post("customerId");

        $dateFrom = mktime(0, 0, 0, $month, 1, $year);
        $dateTo = mktime(0, 0, -1, $month + 1, 1, $year);

        $results = DB::select_array(array('clippings.id', 'clippings.name'))
                   ->from('clippings')
                   ->where('customer_id', '=', $customerId)
                   ->where('publicationdate', '>=', $dateFrom)
                   ->where('publicationdate', '<', $dateTo)
                   ->execute()
                   ->as_array();

        if(count($results) > 0)
        {
            return $this->response(array('clippings', $results));
        }
        else
        {
            return $this->response(array('error', 'geen items'));
        }
    }

    public function post_fields()
    {
        $customerId = Input::post("customerId");
        $clippingId = Input::post("clippingId");

        $clipping = Model_Clipping::find($clippingId);
        $year = date('Y', $clipping->publicationdate);
        $month = date('n', $clipping->publicationdate);  

        $dateFrom = mktime(0, 0, 0, 1, 1, $year);
        $dateTo = mktime(0, 0, -1, 1, 1, $year + 1);

        $months = DB::select(array(DB::expr('MONTH(FROM_UNIXTIME(' . DB::quote_identifier('publicationdate') . '))'), 'month'))
                   ->from('clippings')
                   ->where('customer_id', '=', $customerId)
                   ->where('publicationdate', '>=', $dateFrom)
                   ->where('publicationdate', '<', $dateTo)
                   ->execute()
                   ->as_array();

        $dateFrom = mktime(0, 0, 0, $month, 1, $year);
        $dateTo = mktime(0, 0, -1, $month + 1, 1, $year);

        $clippings = DB::select_array(array('clippings.id', 'clippings.name'))
                   ->from('clippings')
                   ->where('customer_id', '=', $customerId)
                   ->where('publicationdate', '>=', $dateFrom)
                   ->where('publicationdate', '<', $dateTo)
                   ->execute()
                   ->as_array();

        $results = array();
        $results['month'] = $month;
        $results['year'] = $year;
        $results['months'] = $months;
        $results['clippings'] = $clippings;

        return $this->response(array('fields', $results));
    }
};