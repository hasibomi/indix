<?php namespace HasibOmi\Indix;


class Base
{
    private $app_key;
    private $version;
    private $url;

    /**
     * Base constructor.
     *
     * @param $app_key
     * @param $version
     */
    public function __construct($app_key, $version = "v2")
    {
        $this->app_key = $app_key;
        $this->version = $version;
        $this->url = "https://api.indix.com/" . $this->version . "/";
    }

    /**
     * Set CURL.
     *
     * @param $url
     * @return mixed
     */
    protected function call($url)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->url . $url . "app_key=" . $this->app_key);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($curl);

        curl_close($curl);

        return $output;
    }

    /**
     * Build the query string for api call.
     *
     * @param array $query
     * @return string
     */
    protected function buildQuery(array $query)
    {
        $query_strings = "";

        # Query Strings.
        if (! is_null($query)) {
            foreach ($query as $key => $item) {
                $query_strings .= "&" . $key . "=" . $item;
            }
        }

        $query_strings = $query_strings . "&";

        return $query_strings;
    }
}