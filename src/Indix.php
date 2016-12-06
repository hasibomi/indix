<?php namespace HasibOmi\Indix;

class Indix extends Base
{
    /**
     * Lists all stores, along with their IDs, matching the query term.
     * Does not support wildcards.
     * Limit 10 results per query.
     *
     * @param $store_name
     * @return mixed
     */
    public function searchStores($store_name)
    {
        return $this->call("stores?q=" . $store_name . "&");
    }

    /**
     * Lists all brands, along with their IDs, matching query term.
     * Does not support wildcards.
     * Limit is 10 results per query.
     *
     * @param $brand_name
     * @return mixed
     */
    public function searchBrands($brand_name)
    {
        return $this->call("brands?q=" . $brand_name . "&");
    }

    /**
     * Lists all categories along with their IDs and ancestry.
     *
     * @return mixed
     */
    public function categories()
    {
        return $this->call("categories?");
    }

    /**
     * Search a product using the specified types.
     * Types are: summary, offersStandard, offersPremium, catalogStandard, catalogPremium, universal
     *
     * @param $type
     * @param array $query
     * @param string $country_code
     * @return mixed
     */
    public function searchProducts($type, array $query = array(), $country_code = "US")
    {
        $query = $this->buildQuery($query);
        $url = $type . "/products?countryCode=" . $country_code . $query;

        return $this->call($url);
    }

    /**
     * Get details of the specified product using mpid & the specified types.
     * MPID refers to "The Indix product identifier".
     * Types are: summary, offersStandard, offersPremium, catalogStandard, catalogPremium, universal
     *
     * @param $type
     * @param $mpid
     * @param array $query
     * @param string $country_code
     * @return mixed
     */
    public function productLookup($type, $mpid, array $query = array(), $country_code = "US")
    {
        $query = $this->buildQuery($query);
        $url = $type . "/products/{$mpid}?countryCode=" . $country_code . $query;

        return $this->call($url);
    }
}