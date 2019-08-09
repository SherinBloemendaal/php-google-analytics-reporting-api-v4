<?php

namespace sherin\google\analytics\Query;

use DateTime;
use Google_Service_AnalyticsReporting_ReportRequest;
use sherin\google\analytics\Dimension\Dimension;
use sherin\google\analytics\Dimension\DimensionCollection;
use sherin\google\analytics\Filter\DimensionFilter;
use sherin\google\analytics\Filter\DimensionFilterCollection;
use sherin\google\analytics\Filter\MetricFilter;
use sherin\google\analytics\Filter\MetricFilterCollection;
use sherin\google\analytics\Metric\Metric;
use sherin\google\analytics\Metric\MetricCollection;
use sherin\google\analytics\Order\Order;
use sherin\google\analytics\Order\OrderCollection;
use sherin\google\analytics\Segment\SegmentCollection;
use sherin\google\analytics\Serializer\DateRangeSerializer;
use sherin\google\analytics\Serializer\DimensionFilterSerializer;
use sherin\google\analytics\Serializer\DimensionSerializer;
use sherin\google\analytics\Serializer\MetricFilterSerializer;
use sherin\google\analytics\Serializer\MetricSerializer;
use sherin\google\analytics\Serializer\OrderSerializer;
use sherin\google\analytics\Serializer\SegmentSerializer;

class QueryBuilder
{
    //Initialized by constructor
    private $metrics;
    private $dimensions;
    private $dimensionFilters;
    private $metricFilters;
    private $orderBys;
    private $segments;
    //Default null
    private $viewId;
    private $startDate;
    private $endDate;
    private $query;
    //Default value set
    private $maxResults = 1000;
    private $includeEmptyRows = true;

    /**
     * QueryBuilder constructor.
     * @param QueryBuilder|null $queryBuilder
     * @param bool $inheritFully
     */
    public function __construct(QueryBuilder $queryBuilder = null, $inheritFully = false)
    {

        if (!is_null($queryBuilder)) {
            $this->setViewId($queryBuilder->getViewId());
            $this->setDateRange($queryBuilder->getStartDate(), $queryBuilder->getEndDate());

            if ($inheritFully) {
                $this->metrics = clone($queryBuilder->getMetrics());
                $this->dimensions = clone($queryBuilder->getDimensions());
                $this->dimensionFilters = clone($queryBuilder->getDimensionFilters());
                $this->metricFilters = clone($queryBuilder->getMetricFilters());
                $this->orderBys = clone($queryBuilder->getOrderBys());
                $this->segments = clone($queryBuilder->getSegments());
                $this->includeEmptyRows = $queryBuilder->isIncludeEmptyRows();
                $this->maxResults = $queryBuilder->getMaxResults();
//                dd(spl_object_hash($queryBuilder->getMetrics()), spl_object_hash($this->getMetrics()));
            } else {
                $this->metrics = new MetricCollection();
                $this->dimensions = new DimensionCollection();
                $this->orderBys = new OrderCollection();
                $this->segments = new SegmentCollection();
                $this->dimensionFilters = new DimensionFilterCollection();
                $this->metricFilters = new MetricFilterCollection();
            }
        } else {
            $this->metrics = new MetricCollection();
            $this->dimensions = new DimensionCollection();
            $this->orderBys = new OrderCollection();
            $this->segments = new SegmentCollection();
            $this->dimensionFilters = new DimensionFilterCollection();
            $this->metricFilters = new MetricFilterCollection();
        }
    }

    public function addMetric(Metric $metric)
    {
        $this->metrics->addMetric($metric);
        return $this;
    }

    public function setMetrics(MetricCollection $metricCollection)
    {
        $this->metrics = $metricCollection;
        return $this;
    }

    public function addDimension(Dimension $dimension)
    {
        $this->dimensions->addDimension($dimension);
        return $this;
    }

    public function setDimensions(DimensionCollection $dimensionCollection)
    {
        $this->dimensions = $dimensionCollection;
        return $this;
    }

    public function addSegment($segment)
    {
        $this->segments->addSegment($segment);
        return $this;
    }

    public function setSegments(SegmentCollection $segmentCollection)
    {
        $this->segments = $segmentCollection;
        return $this;
    }

    public function setMetricFilters(MetricFilterCollection $filterCollection)
    {
        $this->metricFilters = $filterCollection;
        return $this;
    }

    public function addMetricFilter(MetricFilter $filter)
    {
        $this->metricFilters->addFilter($filter);
        return $this;
    }

    public function setDimensionFilters(DimensionFilterCollection $filterCollection)
    {
        $this->dimensionFilters = $filterCollection;
        return $this;
    }

    public function addDimensionFilter(DimensionFilter $filter)
    {
        $this->dimensionFilters->addFilter($filter);
        return $this;
    }

    public function addOrderBy(Order $order)
    {
        $this->orderBys->addOrder($order);
        return $this;
    }

    public function setOrderBys(OrderCollection $orderBys)
    {
        $this->orderBys = $orderBys;
        return $this;
    }

    public function setViewId(int $viewId)
    {
        $this->viewId = $viewId;
        return $this;
    }

    public function setDateRange(DateTime $startDate, DateTime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        return $this;
    }

    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
        return $this;
    }

    public function setIncludeEmptyRows($includeEmptyRows)
    {
        $this->includeEmptyRows = $includeEmptyRows;
        return $this;
    }

    public function getViewId(): int
    {
        return $this->viewId;
    }

    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    public function getMetrics(): MetricCollection
    {
        return $this->metrics;
    }

    public function getDimensions(): DimensionCollection
    {
        return $this->dimensions;
    }

    public function getDimensionFilters(): DimensionFilterCollection
    {
        return $this->dimensionFilters;
    }

    public function getMetricFilters(): MetricFilterCollection
    {
        return $this->metricFilters;
    }

    public function getOrderBys(): OrderCollection
    {
        return $this->orderBys;
    }

    public function getSegments(): SegmentCollection
    {
        return $this->segments;
    }

    public function getMaxResults(): int
    {
        return $this->maxResults;
    }

    public function isIncludeEmptyRows(): bool
    {
        return $this->includeEmptyRows;
    }

    public function getQuery()
    {
        $googleQuery = new Google_Service_AnalyticsReporting_ReportRequest();
        $googleQuery->setViewId((String)$this->viewId);
        $googleQuery->setDateRanges(DateRangeSerializer::deserialize($this->startDate, $this->endDate));
        // Suppress because wrong @param in the Google api
        /* @phan-suppress-next-line PhanTypeMismatchArgument */
        $googleQuery->setMetrics(MetricSerializer::deserialize($this->metrics));
        // Suppress because wrong @param in the Google api
        /* @phan-suppress-next-line PhanTypeMismatchArgument */
        $googleQuery->setDimensions(DimensionSerializer::deserialize($this->dimensions));
        // Suppress because wrong @param in the Google api
        /* @phan-suppress-next-line PhanTypeMismatchArgument */
        $googleQuery->setOrderBys(OrderSerializer::deserialize($this->orderBys));
        $googleQuery->setIncludeEmptyRows($this->includeEmptyRows);

        if (!empty($this->dimensionFilters)) {
            $googleQuery->setDimensionFilterClauses(DimensionFilterSerializer::deserialize($this->dimensionFilters));
        }

        if (!empty($this->metricFilters)) {
            $googleQuery->setMetricFilterClauses(MetricFilterSerializer::deserialize($this->metricFilters));
        }

        if (!empty($this->segments)) {
            $googleQuery->setSegments(SegmentSerializer::deserialize($this->segments));
        }

        $this->query = new Query($googleQuery);
        return $this->query;
    }
}
