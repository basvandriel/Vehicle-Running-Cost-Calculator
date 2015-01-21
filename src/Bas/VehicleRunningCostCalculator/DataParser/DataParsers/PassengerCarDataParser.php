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
    use Bas\VehicleRunningCostCalculator\Vehicle\FuelType\FuelType;
    use Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\Car\Cars\PassengerCar;
    use Bas\VehicleRunningCostCalculator\Vehicle\VehicleType;
    use Bas\VehicleRunningCostCalculator\VehicleOwner\Province\Province;
    use Bas\VehicleRunningCostCalculator\VehicleOwner\VehicleOwner;


    /**
     *
     *
     * @package   Bas\VehicleRunningCostCalculator\DataParserHandler\DataParsers
     *
     * @author    Bas van Driel <basvandriel94@gmail.com>
     * @copyright 2015 Bas van Driel
     * @license   MIT
     */
    class PassengerCarDataParser implements DataParser
    {

        public function resolveData(VehicleType $vehicleType, VehicleOwner $vehicleOwner) {
            return require "var/road-tax-data/PassengerCarData.php";
        }


        /**
         * @param array        $resolvedData The resolved data array for the selected vehicle type
         * @param VehicleType  $vehicleType  The selected vehicle type
         * @param VehicleOwner $vehicleOwner The vehicle owner belonging to the vehicle type
         *
         * @return mixed
         * @throws \Exception
         */
        public function parse(array $resolvedData, VehicleType $vehicleType, VehicleOwner $vehicleOwner) {
            /**
             * @type PassengerCar $vehicleType The passenger car vehicle type
             */
            $province = strtolower(Province::getProvinceName($vehicleOwner->getProvince()));

            if (!isset($resolvedData[$province])) {
                throw new \Exception("Cant find province!");
            }
            $data = $resolvedData[$province];
            $data = $data[$this->resolveWeightClass($data, $vehicleType->getWeight())];
            $fuelType = strtolower(FuelType::getFuelTypeName($vehicleType->getFuelType()));

            if (!isset($data[$fuelType])) {
                throw new \Exception("Cant find fuel type");
            }
            $data = $data[$fuelType];

            return $data;
        }

        public function resolveWeightClass(array $provinceData, $vehicleWeight) {
            $weightClasses = array_keys($provinceData);
            for ($weightClassIndex = 0; $weightClassIndex < count($weightClasses); $weightClassIndex++) {
                $weightClass = $weightClasses[$weightClassIndex];

                //Define the next weight class in the array
                if ($weightClassIndex !== count($provinceData) - 1) {
                    $nextWeightClass = $weightClasses[$weightClassIndex + 1];
                } else {
                    $nextWeightClass = $weightClass;
                }

                //The checking if the vehicle belongs to which weight class
                if ($vehicleWeight >= $weightClass && $vehicleWeight < $nextWeightClass) {
                    return $weightClass;
                }
            }
            return 0;
        }
    }