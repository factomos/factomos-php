<?php

/**
 * Class Client
 * v 1.0.2 - 2016-06-13
 * @package Factomos
 */
class Factomos {

    public $client;
    public $factomos_api_version;
    public $factomos_api_domain;
    public $factomos_api_token;
    public $headers;

    public function __construct($params) {

        $this->factomos_api_version = $params['FACTOMOS_API_VERSION'];
        $this->factomos_api_domain = $params['FACTOMOS_API_DOMAIN'];
        $this->factomos_api_token = $params['FACTOMOS_API_TOKEN'];

        $this->client = new GuzzleHttp\Client([
            'base_uri' => $this->factomos_api_domain,
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





    /* INVOICE */
    public function listInvoices($url = '/invoices',  $body){
        $response = $this->get($url, $body);
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
    public function listEstimates($url = '/estimates',  $body){
        $response = $this->get($url, $body);
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
    
    public function deleteContact($contact_pid){
        $response = $this->delete('/contacts/'.$contact_pid);
        return json_decode((string)$response->getBody());
    }

    public function createContact($body){
        $response = $this->post('/contacts', $body);
        return json_decode((string)$response->getBody());
    }


}
