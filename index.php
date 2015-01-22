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

    use Bas\VehicleRunningCostCalculator\Vehicle\FuelType;
    use Bas\VehicleRunningCostCalculator\VehicleOwner\Province;

    require_once "src/Bas/VehicleRunningCostCalculator/DataParser/DataParser.php";
    require_once "src/Bas/VehicleRunningCostCalculator/DataParser/DataParserHandler.php";
    require_once "src/Bas/VehicleRunningCostCalculator/DataParser/DataPropertyResolver.php";
    require_once "src/Bas/VehicleRunningCostCalculator/DataParser/DataParsers/PassengerCarDataParser.php";
    require_once "src/Bas/VehicleRunningCostCalculator/DataParser/DataParsers/MotorcycleDataParser.php";
    require_once "src/Bas/VehicleRunningCostCalculator/DataParser/DataParsers/DeliveryVanDataParser.php";

    require_once "src/Bas/VehicleRunningCostCalculator/VehicleOwner/VehicleOwner.php";
    require_once "src/Bas/VehicleRunningCostCalculator/VehicleOwner/Province.php";

    require_once "src/Bas/VehicleRunningCostCalculator/Vehicle/VehicleType.php";
    require_once "src/Bas/VehicleRunningCostCalculator/Vehicle/FuelType.php";
    require_once "src/Bas/VehicleRunningCostCalculator/Vehicle/Vehicles/Car/Car.php";
    require_once "src/Bas/VehicleRunningCostCalculator/Vehicle/Vehicles/Car/Cars/PassengerCar.php";
    require_once "src/Bas/VehicleRunningCostCalculator/Vehicle/Vehicles/Van/Van.php";
    require_once "src/Bas/VehicleRunningCostCalculator/Vehicle/Vehicles/Van/Vans/DeliveryVan.php";
    require_once "src/Bas/VehicleRunningCostCalculator/Vehicle/Vehicles/MotorCycle/Motorcycle.php";

    $vehicle = new \Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\Van\Vans\DeliveryVan(FuelType::BENZINE,
                                                                                           800,
                                                                                           false);

    $vehicleOwner = new \Bas\VehicleRunningCostCalculator\VehicleOwner\VehicleOwner($vehicle,
                                                                                    Province::GELDERLAND,
                                                                                    false);

    $parser      = new \Bas\VehicleRunningCostCalculator\DataParser\DataParserHandler($vehicle, $vehicleOwner);
    $dataParsers = $parser->resolveDataParsers();

    $dataParser = $parser->resolveDataParser($dataParsers);
    $data       = $parser->getData($dataParser);

    var_dump($data);

