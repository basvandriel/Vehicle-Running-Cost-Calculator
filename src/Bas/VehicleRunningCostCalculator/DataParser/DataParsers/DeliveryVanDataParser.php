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
    use Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\Van\Vans\DeliveryVan;
    use Bas\VehicleRunningCostCalculator\VehicleOwner\VehicleOwner;


    /**
     *
     *
     * @package   Bas\VehicleRunningCostCalculator\DataParser\DataParsers
     *
     * @author    Bas van Driel <basvandriel94@gmail.com>
     * @copyright 2015 Bas van Driel
     * @license   MIT
     */
    class DeliveryVanDataParser extends DataParser
    {

        /**
         * Resolves the right data based on the vehicle type in array format
         *
         * @param VehicleOwner $vehicleOwner
         *
         * @return array The resolved data array for the selected vehicle type
         */
        protected function resolveData(VehicleOwner $vehicleOwner) {
            /**
             * @type DeliveryVan $vehicleType
             */
            $vehicleType = $vehicleOwner->getVehicleType();
            if ($vehicleOwner->isDisabled()) {
                return require "var/road-tax-data/DeliveryVanDisabledData.php";
            } elseif ($vehicleType->isCommercial()) {
                return require "var/road-tax-data/DeliveryVanCommercialData.php";
            }
            return require "var/road-tax-data/DeliveryVanPassengerData.php";
        }

        /**
         * @param array        $resolvedData The resolved data array for the selected vehicle type
         *
         * @param VehicleOwner $vehicleOwner The vehicle owner belonging to the vehicle type
         *
         * @throws \Exception
         *
         * @return int
         */
        protected function parse(array $resolvedData, VehicleOwner $vehicleOwner) {
            /**
             * @type DeliveryVan $vehicleType
             */
            $vehicleType = $vehicleOwner->getVehicleType();
            $weight      = $vehicleType->getWeight();
            $fuelType    = strtolower(FuelType::getName($vehicleType->getFuelType()));

            if ($vehicleOwner->isDisabled() || $vehicleType->isCommercial()) {
                return $data = $resolvedData[DataPropertyResolver::resolveWeightClass($resolvedData, $weight)];
            }
            $data = $resolvedData[DataPropertyResolver::resolveWeightClass($resolvedData, $weight)];
            if (!isset($data[$fuelType])) {
                throw new \Exception("Cant find the fuel type");
            }
            return $data = $data[$fuelType];
        }
    }