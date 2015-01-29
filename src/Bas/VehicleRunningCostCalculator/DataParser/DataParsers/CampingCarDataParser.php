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

    namespace Bas\VehicleRunningCostCalculator\DataParser\DataParsers;

    use Bas\VehicleRunningCostCalculator\DataParser\DataParser;
    use Bas\VehicleRunningCostCalculator\DataParser\DataPropertyResolver;
    use Bas\VehicleRunningCostCalculator\Vehicle\FuelType;
    use Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\Car\Cars\CampingCar;
    use Bas\VehicleRunningCostCalculator\VehicleOwner\Province;
    use Bas\VehicleRunningCostCalculator\VehicleOwner\VehicleOwner;


    /**
     *
     *
     * @package   Bas\RoadTaxDataWriter
     *
     * @author    Bas van Driel <basvandriel94@gmail.com>
     * @copyright 2015 Bas van Driel
     * @license   MIT
     */
    class CampingCarDataParser extends DataParser
    {

        /**
         * Parses the resolved data and returns the right data belonged on the vehicle type and vehicle owner's
         * property's
         *
         * @param array        $resolvedData The resolved data array for the selected vehicle type
         *
         * @throws \Exception When it can't find the data in the resolved data array
         *
         * @return array|int The right data belonged on the vehicle type and vehicle owner's property's
         */
        public function parse(array $resolvedData) {
            /**
             * @type CampingCar $vehicleType
             */
            $vehicleType = $this->vehicleOwner->getVehicleType();
            $data        = $resolvedData[$vehicleType->isRented()];
            $province    = strtolower(Province::getName($this->vehicleOwner->getProvince()));

            if (!isset($data[$province])) {
                throw new \Exception("Cant find province!");
            }
            $data = $data[$province];
            $data = $data[DataPropertyResolver::resolveWeightClass($data, $vehicleType->getWeight())];

            $fuelType = strtolower(FuelType::getName($vehicleType->getFuelType()));
            if (!isset($data[$fuelType])) {
                throw new \Exception("Can't find fuel type");
            }
            return $data[$fuelType];
        }
    }