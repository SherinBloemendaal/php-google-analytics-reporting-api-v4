<?php


namespace Serializer;

use Dimension\Dimension;
use Dimension\DimensionCollection;

class DimensionSerializer
{
    /**
     * @param DimensionCollection $dimensionCollection
     * @return array
     */
    public static function serialize(DimensionCollection $dimensionCollection): array
    {
        return $dimensionCollection->getDimensions()->forAll(function ($key, Dimension $dimension) {
            $googleDimension = new \Google_Service_AnalyticsReporting_Dimension();
            $googleDimension->setName($dimension->getDimension());
            return $googleDimension;
        });
    }
}
