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
    use Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\RentableVehicle;


    /**
     * Defines a camping car vehicle type, this vehicle type relies on the following data for calculating it's
     * road tax prices:
     *
     * - It's fuel type
     * - It's weight
     * - If it's rented or not
     * - The camping car's owner province
     *
     * @package   Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\Cars
     *
     * @author    Bas van Driel <basvandriel94@gmail.com>
     * @copyright 2015 Bas van Driel
     * @license   MIT
     */
    class CampingCar implements Car, RentableVehicle
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
         * @var bool $isRented If the camping car is rented or not
         */
        private $isRented;

        /**
         * Instantiates a new camping car class
         *
         * @param int   $fuelType The fuel type of the camping car
         * @param float $weight   The weight of the camping car
         * @param bool  $isRented
         */
        public function __construct($fuelType, $weight, $isRented) {
            $this->fuelType = $fuelType;
            $this->weight   = $weight;
            $this->isRented = $isRented;
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

        /**
         * A check if the vehicle type is rented
         *
         * @return bool $isRented If the vehicle type is rented or not
         */
        public function isRented() {
            return $this->isRented;
        }
    }