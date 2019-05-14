<?php

class arrayOperation{

    //get depth of an array
    static function array_depth(array $array) {
         $max_indentation = 1;
         $array_str = print_r($array, true);
         $lines = explode("\n", $array_str);
         foreach ($lines as $line) {
              $indentation = (strlen($line) - strlen(ltrim($line))) / 4;

              if ($indentation > $max_indentation) {
                  $max_indentation = $indentation;
              }
         }
         return ceil(($max_indentation - 1) / 2) + 1;
   }

   //remove an element from an array
   static function removeElementfromArray(array $array){

   }

   //add element to an array
   static function addElementtoArray(array $array){

   }

   static function findElementandPositionFromArray(array $array){

   }

   static function updateElementinArray(){

   }

   static function mergeTwoArray(){

   }



}