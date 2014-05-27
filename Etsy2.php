<?php

namespace OAuth\OAuth1\Service;

use OAuth\OAuth1\Signature\SignatureInterface;
use OAuth\Common\Http\Uri\Uri;
use OAuth\Common\Consumer\CredentialsInterface;
use OAuth\Common\Http\Uri\UriInterface;
use OAuth\Common\Storage\TokenStorageInterface;
use OAuth\Common\Http\Client\ClientInterface;

class Etsy2 extends Etsy {

    protected $scopes;

    /**
     * Defined scopes
     * @link https://www.etsy.com/developers/documentation/getting_started/oauth#section_permission_scopes
     */
    const EMAIL_R           = "email_r";
    const LISTINGS_R        = "listings_r";
    const LISTINGS_W        = "listings_w";
    const LISTINGS_D        = "listings_d";
    const TRANSACTIONS_R    = "transactions_r";
    const TRANSACTIONS_W    = "transactions_w";
    const BILLING_R         = "billing_r";
    const PROFILE_R         = "profile_r";
    const PROFILE_W         = "profile_w";
    const ADDRESS_R         = "address_r";
    const ADDRESS_W         = "address_w";
    const FAVORITES_RW      = "favorites_rw";
    const SHOPS_RW          = "shops_rw";
    const CART_RW           = "cart_rw";
    const RECOMMEND_RW      = "recommend_rw";
    const FEEDBACK_R        = "feedback_r";
    const TREASURY_R        = "treasury_r";
    const TREASURY_W        = "treasury_w";

    public function __construct(
            CredentialsInterface $credentials, 
            ClientInterface $httpClient, 
            TokenStorageInterface $storage, 
            SignatureInterface $signature,             
            UriInterface $baseApiUri = null
    ) {
        parent::__construct($credentials, $httpClient, $storage, $signature, $baseApiUri);

        if (null === $baseApiUri) {
            $this->baseApiUri = new Uri('https://openapi.etsy.com/v2/');
        }     
    }

    public function setScopes($request_scopes = array()) {
        
        if ($request_scopes) {
            $this->scopes = '?scope=' . implode('%20', $request_scopes);
        }
    }
    
    public function getRequestTokenEndpoint() {        
        return new Uri($this->baseApiUri . 'oauth/request_token' . $this->scopes);
    }

}


