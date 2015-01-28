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

    spl_autoload_register(function ($class) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        require __DIR__ . '/src/' . $class . '.php';
    });

    use Bas\VehicleRunningCostCalculator\Vehicle\FuelType;
    use Bas\VehicleRunningCostCalculator\VehicleOwner\Province;
    use Bas\VehicleRunningCostCalculator\Vehicle\Vehicles\Van\Vans\DeliveryVan;
    use Bas\VehicleRunningCostCalculator\VehicleOwner\VehicleOwner;
    use Bas\VehicleRunningCostCalculator\DataParser\DataParserFactory;

    $vehicle      = new DeliveryVan(FuelType::BENZINE, 900, false);
    $vehicleOwner = new VehicleOwner($vehicle, Province::GELDERLAND, false);

    $dataParser = DataParserFactory::resolve($vehicle);
    $data       = $dataParser->getData($vehicle, $vehicleOwner);

    var_dump($data);
