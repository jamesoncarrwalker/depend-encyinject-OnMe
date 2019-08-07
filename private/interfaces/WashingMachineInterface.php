<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 23/07/2019
 * Time: 13:54
 */

namespace interfaces;

interface WashingMachineInterface {

    public function setCycle(int $cycle);

    public function loadLaundry(array $inputs);

    public function runCycle();

    public function getLaundry();
}