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

    namespace Bas\VehicleRunningCostCalculator\VehicleOwner\Province;

    /**
     * Defines all the provinces as integer format in constants and it's utility methods.
     *
     * @package   Bas\VehicleRunningCostCalculator\VehicleOwner\Province
     *
     * @author    Bas van Driel <basvandriel94@gmail.com>
     * @copyright 2015 Bas van Driel
     * @license   MIT
     */
    final class Province
    {
        /**
         * Defines the province Noord Holland
         */
        const NOORD_HOLLAND = 0;

        /**
         * Defines the province Utrecht
         */
        const UTRECHT = 1;

        /**
         * Defines the province Noord Brabant
         */
        const NOORD_BRABANT = 2;

        /**
         * Defines the province Limburg
         */
        const LIMBURG = 4;

        /**
         * Defines the province Flevoland
         */
        const FLEVOLAND = 8;

        /**
         * Defines the province Zeeland
         */
        const ZEELAND = 16;

        /**
         * Defines the province Overijssel
         */
        const OVERIJSSEL = 32;

        /**
         * Defines the province Groningen
         */
        const GRONINGEN = 64;

        /**
         * Defines the province Gelderland
         */
        const GELDERLAND = 128;

        /**
         * Defines the province Drenthe
         */
        const DRENTHE = 256;

        /**
         * Defines the province Friesland
         */
        const FRIESLAND = 512;

        /**
         * Defines the province Zuid Holland
         */
        const ZUID_HOLLAND = 1024;

        /**
         * Resolves the province name by selecting a constant out of this class
         *
         * @param int $province The province constant
         *
         * @return string The province name
         */
        public static function getProvinceName($province) {
            return array_flip((new \ReflectionClass(new self))->getConstants())[$province];
        }
    }