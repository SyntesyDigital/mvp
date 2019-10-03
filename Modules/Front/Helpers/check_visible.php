<?php

if (!function_exists('check_visible')) {

    function check_visible($settings,$parameters)
    {
      if(!isset($parameters)){
        return true;
      }

      if(!isset($settings) || !isset($settings['hiddenFilter'])
        || $settings['hiddenFilter'] == ""){
        return true;
      }

      $filterArray = explode(':',$settings['hiddenFilter']);
      $filterName = $filterArray[2];
      $filterValue = $filterArray[1];

      $paramsArray = explode("&",$parameters);
      foreach($paramsArray as $param) {
        $paramArray = explode("=",$param);

        if($paramArray[0] == $filterName){
          //dd($paramArray[0],$paramArray[1],$filterValue);
          //if the parameter of the filter exist in the url
          if($paramArray[1] == $filterValue){
            //if the value is the same set in the hidden filter
            return false; //hide
          }
        }
      }

      return true;
    }
}
