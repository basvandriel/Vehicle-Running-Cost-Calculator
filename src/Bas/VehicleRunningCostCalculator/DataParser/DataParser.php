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

    namespace Bas\VehicleRunningCostCalculator\DataParser;

    /**
     * Use the "VehicleType" and "VehicleOwner" class for dependency injection
     */
    use Bas\VehicleRunningCostCalculator\Vehicle\VehicleType;
    use Bas\VehicleRunningCostCalculator\VehicleOwner\VehicleOwner;


    /**
     * An interface for creating a road tax data parser
     *
     * @package Bas\VehicleRunningCostCalculator\DataParser
     */
    abstract class DataParser
    {

        /**
         * @var VehicleOwner $vehicleOwner The owner of the vehicle type
         */
        private $vehicleOwner;

        /**
         * @param VehicleOwner $vehicleOwner The owner of the vehicle type
         */
        public function __construct(VehicleOwner $vehicleOwner) {
            $this->vehicleOwner = $vehicleOwner;
        }

        /**
         * @return VehicleOwner The owner of the vehicle type
         */
        protected function getVehicleOwner() {
            return $this->vehicleOwner;
        }

        /**
         * @return VehicleType The vehicle type of the owner
         */
        protected function getVehicleType() {
            return $this->vehicleOwner->getVehicleType();
        }

        /**
         * Parses the resolved data and returns the right data belonged on the vehicle type and vehicle owner's
         * property's
         *
         * @param array $resolvedData The resolved data array for the selected vehicle type
         *
         * @return array|int The data belonging to the vehicle owner's property's.
         */
        public abstract function parse(array $resolvedData);
    }