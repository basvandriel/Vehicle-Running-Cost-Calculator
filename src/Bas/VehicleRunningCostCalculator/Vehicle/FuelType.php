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

    namespace Bas\VehicleRunningCostCalculator\Vehicle;


    /**
     * Defines all the fuel types as integer format in constants and it's utility methods.
     *
     * @package   Bas\VehicleRunningCostCalculator\Vehicle
     *
     * @author    Bas van Driel <basvandriel94@gmail.com>
     * @copyright 2015 Bas van Driel
     * @license   MIT
     */
    class FuelType
    {
        /**
         * Defines the benzine fuel type
         */
        const BENZINE = 0;

        /**
         * Defines the diesel fuel type
         */
        const DIESEL = 1;

        /**
         * Defines the LPG3 and natural gas fuel types
         */
        const LPG3_NATURAL_GAS = 2;

        /**
         * Defines the lpg and other fuel types
         */
        const LPG_OTHERS = 4;

        /**
         * Resolves the fuel type's name by selecting a constant out of this class
         *
         * @param int $fuelType The fuel type constant
         *
         * @return string The fuel type's name
         */
        public static function getFuelTypeName($fuelType) {
            return array_flip((new \ReflectionClass(new self))->getConstants())[$fuelType];
        }
    }