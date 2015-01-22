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
     *
     *
     * @package   Bas\VehicleRunningCostCalculator\DataParser
     *
     * @author    Bas van Driel <basvandriel94@gmail.com>
     * @copyright 2015 Bas van Driel
     * @license   MIT
     */
    class DataPropertyResolver
    {
        /**
         * Resolves the "weight class" (not an actual class) based on the vehicle's weight and inputted data
         *
         * @param array $data          The inputted data array where the weight classes should exist
         * @param float $vehicleWeight The vehicle type's weight
         *
         * @return int The resolved weight class
         */
        public static function resolveWeightClass(array $data, $vehicleWeight) {
            $weightClasses = array_keys($data);
            for ($weightClassIndex = 0; $weightClassIndex < count($weightClasses); $weightClassIndex++) {
                $weightClass = $weightClasses[$weightClassIndex];

                //Define the next weight class in the array
                if ($weightClassIndex !== count($data) - 1) {
                    $nextWeightClass = $weightClasses[$weightClassIndex + 1];
                } else {
                    $nextWeightClass = $weightClass;
                }

                //The checking if the vehicle belongs to which weight class
                if (($vehicleWeight >= $weightClass) && ($vehicleWeight < $nextWeightClass)) {
                    return $weightClass;
                }
            }
            return 0;
        }

        /**
         * @param array $data
         * @param       $fuelType
         *
         * @return mixed
         * @throws \Exception
         */
        public static function resolveFuelType(array $data, $fuelType) {
            if (!isset($data[$fuelType])) {
                throw new \Exception("Can't find fuel type");
            }
            return $fuelType;
        }
    }