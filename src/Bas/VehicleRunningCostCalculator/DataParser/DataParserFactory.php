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
     * Use the "VehicleType" class for polymorphism
     */
    use Bas\VehicleRunningCostCalculator\Vehicle\VehicleType;

    /**
     * A factory class to retrieve the right data parser for the selected vehicle type based on the following
     * (specific) user's property's:
     *
     * - The vehicle type
     * - The vehicle's fuel type
     * - The vehicle's owner province
     * - If the vehicle owner is disabled
     *
     * @package   Bas\VehicleRunningCostCalculator\DataParser
     *
     * @author    Bas van Driel <basvandriel94@gmail.com>
     * @copyright 2015 Bas van Driel
     * @license   MIT
     */
    class DataParserFactory
    {

        /**
         * Resolves the instance of the right data parser belonging to the selected vehicle type
         *
         * @param VehicleType $vehicleType The user selected vehicle type
         *
         * @throws \Exception When it can't find the data parser class
         *
         * @return DataParser The resolved data parser belonging to the user selected vehicle type
         */
        public function resolveDataParser(VehicleType $vehicleType) {
            $vehicleTypeClass      = substr(get_class($vehicleType), strrpos(get_class($vehicleType), "\\") + 1);
            $vehicleTypeDataParser = "{$this->getNamespace()}\\DataParsers\\{$vehicleTypeClass}DataParser";
            if (!class_exists($vehicleTypeDataParser)) {
                throw new \Exception("Couldn't find the data parser class for the vehicle type");
            }
            return new $vehicleTypeDataParser;
        }

        /**
         * @return string The namespace of this class
         */
        private function getNamespace() {
            return substr($this->getClass(), 0, strrpos($this->getClass(), "\\"));
        }

        /**
         * @return string The class name as string format
         */
        private function getClass() {
            return get_class($this);
        }
    }