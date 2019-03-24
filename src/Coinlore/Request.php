<?php
namespace Coinlore;

class Request {
    public function getcoin($id) {
        return $this->curl("https://api.coinlore.com/api/ticker/?id=".$id);
    }

    public function getcoins($start, $limit) {
        if(empty($limit) || !is_numeric($limit)){
            $limit = 100;
        }
        if(empty($start) || !is_numeric($start)){
            $start = 0;
        }
        return $this->curl("https://api.coinlore.com/api/tickers/?start=".$start."&limit=".$limit."");
    }

    private function curl($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_VERBOSE => false,
            CURLOPT_USERAGENT => 'Coinlore PHP/API',
            CURLOPT_POST => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 65
        ));
        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }
}
?>