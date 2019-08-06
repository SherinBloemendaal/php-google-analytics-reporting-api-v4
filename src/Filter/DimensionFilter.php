<?php


namespace Filter;

class DimensionFilter extends Filter
{
    const EQUAL = "==";
    const NOT_EQUAL = "!=";
    const CONTAINS = "=@";
    const NOT_CONTAINS = "!@";
    const MATCH_REGEX = "=~";
    const NOT_MATCH_REGEX = "!~";
}
