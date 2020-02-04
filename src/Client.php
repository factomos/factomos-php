<?php

/**
 * Class Client
 * v 1.0.4 - 2019-12-19
 * @package Factomos
 */

namespace Factomos;

class Client {

    public $client;
    public $factomos_api_version;
    public $factomos_api_url;
    public $factomos_api_token;
    public $headers;

    public function __construct($params) {

        // default values
        $this->factomos_api_version = '1';
        $this->factomos_api_url = 'https://api.factomos.com';

        if(isset($params['FACTOMOS_API_VERSION'])) {
            $this->factomos_api_version = $params['FACTOMOS_API_VERSION'];
        }

        if(isset($params['FACTOMOS_API_URL'])) {
            $this->factomos_api_url = $params['FACTOMOS_API_URL'];
        }

        $this->factomos_api_token = $params['FACTOMOS_API_TOKEN'];

        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->factomos_api_url,
        ]);
        $this->headers = [
            'Accept' => 'application/vnd.status+json; version=' . $this->factomos_api_version,
            'Authorization' => 'Bearer ' . $this->factomos_api_token,
            'Content-Length' => 0,

        ];
    }

    public function get($url, $body = false) {
        $response = $this->client->request('GET', $url, ['headers' => $this->headers, 'json' => $body]);
        return $response;
    }

    public function post($url, $body = false) {
        $response = $this->client->request('POST', $url, ['headers' => $this->headers, 'json' => $body]);
        return $response;
    }

    public function delete($url, $body = false) {
        $response = $this->client->request('DELETE', $url, ['headers' => $this->headers, 'json' => $body]);
        return $response;
    }


    /* ARTICLES */
    public function listArticles($url = '/articles'){
        $response = $this->get($url);
        return json_decode((string)$response->getBody());
    }


    /* INVOICE */
    public function listInvoices($url = '/invoices'){
        $response = $this->get($url);
        return json_decode((string)$response->getBody());
    }

    public function createInvoice($body){
        $response = $this->post('/invoices', $body);
        return json_decode((string)$response->getBody());
    }

    public function getInvoice($invoice_pid){
        $response = $this->get('/invoices/'.$invoice_pid);
        return json_decode((string)$response->getBody());
    }

    public function getInvoicePDF($invoice_pid){
        $response = $this->get('/invoices/'.$invoice_pid.'/pdf');
        return $response->getBody();
    }
    

    /* ESTIMATE */
    public function listEstimates($url = '/estimates'){
        $response = $this->get($url);
        return json_decode((string)$response->getBody());
    }

    public function createEstimate($body){
        $response = $this->post('/estimates', $body);
        return json_decode((string)$response->getBody());
    }

    public function getEstimate($estimate_pid){
        $response = $this->get('/estimates/'.$estimate_pid);
        return json_decode((string)$response->getBody());
    }

    public function getEstimatePDF($estimate_pid){
        $response = $this->get('/estimates/'.$estimate_pid.'/pdf');
        return $response->getBody();
    }


    /// CONTACT
    public function getContact($contact_pid){
        $response = $this->get('/contacts/'.$contact_pid);
        return json_decode((string)$response->getBody());
    }
    public function listContacts($keyword = ''){
        $response = $this->get('/contacts?keyword='.urlencode($keyword));
        return json_decode((string)$response->getBody());
    }
    
    public function deleteContact($contact_pid){
        $response = $this->delete('/contacts/'.$contact_pid);
        return json_decode((string)$response->getBody());
    }

    public function createContact($body){
        $response = $this->post('/contacts', $body);
        return json_decode((string)$response->getBody());
    }


}
