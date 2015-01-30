<?php
    /**
     * The MIT License (MIT)
     *
     * Copyright (c) 2014 Bas van Driel
     *
     * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
     * documentation files (the "Software"), to deal in the Software without restriction, including without limitation
     * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and
     * to permit persons to whom the Software is furnished to do so, subject to the following conditions:
     *
     * The above copyright notice and this permission notice shall be included in all copies or substantial portions of
     * the Software.
     *
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO
     * THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
     * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
     * DEALINGS IN THE SOFTWARE.
     */

    namespace Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\Car\Cars;

    /**
     * Use the "Car" class for polymorphism
     */
    use Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\Car\Car;


    /**
     * Defines a passenger car, a passenger car needs the relies on the following data for calculating it's road tax
     * prices:
     *
     * - It's fuel type
     * - It's weight
     * - The passenger car's owner province
     *
     * @package   Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\Cars
     *
     * @author    Bas van Driel <basvandriel94@gmail.com>
     * @copyright 2015 Bas van Driel
     * @license   MIT
     */
    class PassengerCar implements Car
    {

        /**
         * @var int $fuelType The fuel type of the car vehicle type
         */
        private $fuelType;

        /**
         * @var float $weight The weight of the car vehicle type
         */
        private $weight;

        /**
         * Instantiates a new passenger car class
         *
         * @param int   $fuelType The fuel type of the passenger car
         * @param float $weight   The weight of the passenger car
         */
        public function __construct($fuelType, $weight) {
            $this->fuelType = $fuelType;
            $this->weight   = $weight;
        }

        /**
         * A getter for retrieving the $fuelType variable in a safe way.
         *
         * @return int $fuelType The fuel type of the car vehicle type
         */
        public function getFuelType() {
            return $this->fuelType;
        }

        /**
         * A getter for retrieving the $weight variable in a safe way.
         *
         * @return float $weight The weight of the car vehicle type
         */
        public function getWeight() {
            return $this->weight;
        }
    }