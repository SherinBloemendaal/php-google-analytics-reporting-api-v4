<?php


namespace sherin\google\analytics\Serializer;

use sherin\google\analytics\Dimension\DimensionCollection;

class DimensionSerializer
{
    /**
     * @param DimensionCollection $dimensionCollection
     * @return array
     */
    public static function deserialize(DimensionCollection $dimensionCollection): array
    {
        $dimensions = $dimensionCollection->getDimensions()->toArray();
        $googleDimensions = [];
        foreach ($dimensions as $dimension) {
            $googleDimension = new \Google_Service_AnalyticsReporting_Dimension();
            $googleDimension->setName($dimension->getDimension());
            $googleDimensions[] = $googleDimension;
        }
        return $googleDimensions;
    }
}
