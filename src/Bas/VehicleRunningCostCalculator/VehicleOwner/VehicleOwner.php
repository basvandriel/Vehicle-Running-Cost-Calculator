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

    namespace Bas\VehicleRunningCostCalculator\VehicleOwner;

    /**
     * Use the "VehicleType" class for dependency injection inside the class constructor
     */
    use Bas\VehicleRunningCostCalculator\Vehicle\VehicleType;


    /**
     * Defines a new vehicle owner, a vehicle owner class contains:
     *
     * - The vehicle type of the vehicle owner
     * - The province where the vehicle owner lives.
     *
     * @package   Bas\VehicleRunningCostCalculator\VehicleOwner
     *
     * @author    Bas van Driel <basvandriel94@gmail.com>
     * @copyright 2015 Bas van Driel
     * @license   MIT
     */
    class VehicleOwner
    {
        /**
         * @var VehicleType $vehicleType The vehicle's owner vehicle type
         */
        private $vehicleType;

        /**
         * @var int $province The province where the vehicle owner is living.
         */
        private $province;

        /**
         * Instantiates a new vehicle owner
         *
         * @param VehicleType $vehicleType The vehicle's owner vehicle type
         * @param int         $province    The province where the vehicle owner is living.
         */
        public function __construct(VehicleType $vehicleType, $province) {
            $this->vehicleType = $vehicleType;
            $this->province    = $province;
        }

        /**
         * A getter for retrieving the $vehicleType variable in a safe way.
         *
         * @return VehicleType The vehicle's owner vehicle type
         */
        public function getVehicleType() {
            return $this->vehicleType;
        }

        /**
         * A getter for retrieving the $province variable in a safe way.
         *
         * @return int The province where the vehicle owner is living.
         */
        public function getProvince() {
            return $this->province;
        }
    }