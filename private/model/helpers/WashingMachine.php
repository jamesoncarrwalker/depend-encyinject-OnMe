<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 23/07/2019
 * Time: 14:00
 */

namespace model\helpers;


use constants\AbstractLaundryCycle;
use interfaces\WashingMachineInterface;

class WashingMachine implements WashingMachineInterface {

    private $cycle;
    private $inputs;
    public $outputs;

    public function setCycle(int $cycle) {
        $this->cycle = $cycle;
    }

    public function loadLaundry(array $inputs) {
        $this->outputs = [];//make sure we don't send back the wrong laundry
        $this->inputs = $inputs;
    }

    public function runCycle() {
       switch ($this->cycle) {
           case AbstractLaundryCycle::EMAIL:
               foreach($this->inputs as $key => $email) {
                   $cleanEmail = $this->validateEmail($email);
                   if(!$cleanEmail) continue;
                   $this->outputs[$key] = $email;
               }
               break;
           default :
               foreach($this->inputs as $key => $input){
                   if(is_array($input) || is_object($input)) {
                       $laundry = [];
                       foreach ($input as $inputKey => $inputValue) {
                           $laundry[$inputKey] = $this->cleanString($inputValue);
                       }
                       $this->outputs[$key] = $laundry;
                   } else {
                       $this->outputs[$key] =  $this->cleanString($input);
                   }
               }


       }
    }

    public function getLaundry() {
        return  $this->outputs;
    }

    private function validateEmail($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) return $email;
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        return filter_var($email,FILTER_VALIDATE_EMAIL) ? $email : false;
    }

    private static function cleanString($value) {
        $value = nl2br("$value");
        $value = str_replace(['<div>',"\r","\n"],'<br>',$value);
        $value = strip_tags($value,'<br>');
        $value = str_replace(['src','&lt;','&gt;'],'',$value);
        return $value;
    }


}