<?php


namespace sherin\google\analytics\Serializer;

use sherin\google\analytics\Dimension\Dimension;
use sherin\google\analytics\Dimension\DimensionCollection;

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
