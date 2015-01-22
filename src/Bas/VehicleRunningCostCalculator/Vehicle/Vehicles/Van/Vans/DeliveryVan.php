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

    namespace Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\Van\Vans;

    /**
     * Use the "Van" class for polymorphism
     */
    use Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\Van\Van;


    /**
     * Defines a delivery van, this vehicle type can have multiple price calculations:
     *
     * When the delivery van is for passengers it relies on the following data to do the road tax data calculations:
     *
     * - It's weight
     * - It's fuel type
     *
     * When the delivery van is for commercial use or for disabled people, it relies on the following data to do the
     * road tax data calculations:
     *
     * - It's weight
     *
     * @package   Bas\VehicleRunningCostCalculator\Vehicle\Vehicles
     *
     * @author    Bas van Driel <basvandriel94@gmail.com>
     * @copyright 2015 Bas van Driel
     * @license   MIT
     */
    class DeliveryVan extends Van
    {
        /**
         * @var int $weight The fuel type of the camping car
         */
        private $weight;

        /**
         * @var int $fuelType The fuel type of the camping car for passengers
         */
        private $fuelType;

        /**
         * @var bool $isCommercial If the delivery van is being used commercially
         */
        private $isCommercial;

        /**
         * Instantiates a new delivery van class
         *
         * @param int   $fuelType     The fuel type of the passenger car
         * @param float $weight       The weight of the passenger car
         * @param bool  $isCommercial If the delivery van is being used commercially
         */
        public function __construct($fuelType, $weight, $isCommercial) {
            $this->fuelType     = $fuelType;
            $this->weight       = $weight;
            $this->isCommercial = $isCommercial;
        }

        /**
         * A getter for retrieving the $fuelType variable in a safe way.
         *
         * @return int $fuelType The fuel type of the passenger car
         */
        public function getFuelType() {
            return $this->fuelType;
        }

        /**
         * A getter for retrieving the $weight variable in a safe way.
         *
         * @return float $weight The weight of the passenger car.
         */
        public function getWeight() {
            return $this->weight;
        }

        /**
         * A getter for retrieving the $isCommercial variable in a safe way.
         *
         * @return float $weight The weight of the passenger car.
         */
        public function isCommercial() {
            return $this->isCommercial;
        }
    }