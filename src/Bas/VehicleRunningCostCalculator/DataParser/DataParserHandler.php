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
    use Bas\VehicleRunningCostCalculator\VehicleOwner\VehicleOwner;

    /**
     * Use the "VehicleOwner" class for polymorphism
     */

    /**
     * A class to retrieve the right data for the selected vehicle type based on the following (specific) user's
     * property's:
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
    class DataParserHandler
    {
        /**
         * @var VehicleType $vehicleType The vehicle type the data has to be parsed for
         */
        private $vehicleType;

        /**
         * @var VehicleOwner $vehicleOwner The vehicle's owner
         */
        private $vehicleOwner;

        /**
         * Instantiates a new DataParserHandler class.
         *
         * @param VehicleType  $vehicleType  The vehicle type the data has to be parsed for
         * @param VehicleOwner $vehicleOwner The vehicle's owner
         */
        public function __construct(VehicleType $vehicleType, VehicleOwner $vehicleOwner) {
            $this->vehicleType  = $vehicleType;
            $this->vehicleOwner = $vehicleOwner;
        }

        /**
         * Retrieves the full qualified class names of every vehicle type data parser
         *
         * @return array The full qualified class names of every vehicle type data parser
         */
        public function resolveDataParsers() {
            $dataParsers = [];
            foreach (new \DirectoryIterator(__DIR__ . "\\DataParsers") as $dataParser) {
                if ($dataParser->isDot() || $dataParser->isDir()) {
                    continue;
                }
                $dataParsers[] = "{$this->getNamespace()}\\DataParsers\\{$dataParser->getBasename(".php")}";
            }
            return $dataParsers;
        }

        /**
         * Resolves the instance of the right data parser belonging to the selected vehicle type
         *
         * @param array $dataParsers The full qualified class names of every vehicle type data parser
         *
         * @return DataParser The resolved data parser belonging to the user selected vehicle type
         */
        public function resolveDataParser(array $dataParsers) {
            //Get the class of the chosen vehicle type without it's namespace
            $vehicleTypeClass = substr(get_class($this->vehicleType), strrpos(get_class($this->vehicleType), "\\") + 1);

            //The fully qualified class name of the data parser belonging to this selected vehicle type
            $vehicleTypeDataParser = "{$this->getNamespace()}\\DataParsers\\{$vehicleTypeClass}DataParser";

            //Loop through all the found (resolved) data parsers and select the right one out of it
            for ($dataParsersIndex = 0; $dataParsersIndex < count($dataParsers); $dataParsersIndex++) {
                if ($dataParsers[$dataParsersIndex] == $vehicleTypeDataParser) {
                    $dataParser = new \ReflectionClass($dataParsers[$dataParsersIndex]);
                    return $dataParser->newInstance();
                }
            }
            return null;
        }

        /**
         * Retrieves the data from the resolved data parser belonging to the user selected vehicle type
         *
         * @param DataParser $dataParser The resolved data parser belonging to the chosen vehicle type
         *
         * @return array|int The resolved vehicle data belonging to the user's choices such as the vehicle type, fuel
         *                   type, where the vehicle owner is living
         */
        public function getData(DataParser $dataParser) {
            $data = $dataParser->resolveData($this->vehicleType, $this->vehicleOwner);
            return $dataParser->parse($data, $this->vehicleType, $this->vehicleOwner);
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