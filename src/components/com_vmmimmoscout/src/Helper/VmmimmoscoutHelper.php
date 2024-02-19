<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/
//
    /**
     * @package      DigiNerds Immoscout24 Komponente
     *
     * @author       Christian Schuelling <info@diginerds.de>
     * @copyright    2024 diginerds.de - All rights reserved.
     * @license      GNU General Public License version 3 or later
     */

    namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper;

    \defined('_JEXEC') or die;

    use Joomla\CMS\Component\ComponentHelper;
    use Joomla\CMS\Factory;
    use Joomla\CMS\Helper\ContentHelper;

    /**
     * Vmmimmoscout component helper.
     *
     * @since  1.0.0
     */
    class VmmimmoscoutHelper extends ContentHelper
    {

        /**
         * Method to get a List or a single realestate
         *
         * @return  mixed  An array of objects on success, false on failure.
         */
        public static function realestatesAPIHelper($isSingle, $start, $limit)
        {

            $app   = Factory::getApplication();
            $input = $app->input;

            $paramsComponent = ComponentHelper::getParams('com_vmmimmoscout');

            $curl = curl_init();

            // Aktuelles Datum
            $today = time();

            // OAuth-Parameter definieren
            $consumerKey    = $paramsComponent->get('oauth_consumer_key');
            $consumerSecret = $paramsComponent->get('oauth_consumer_secret');
            $tokenSecret    = $paramsComponent->get('token_secret');
            $token          = $paramsComponent->get('oauth_token');
            $oauthVerifier  = $paramsComponent->get('oauth_verifier');
            $timestamp      = time(); // Dies sollte normalerweise die aktuelle Zeit sein
            $nonce          = self::_generateRandomString(11); // Dies sollte normalerweise ein einzigartiger Wert sein

            $params = [
                'pagesize'               => $limit,
                'oauth_consumer_key'     => $consumerKey,
                'oauth_token'            => $token,
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_timestamp'        => $timestamp,
                'oauth_nonce'            => $nonce,
                'oauth_version'          => '1.0',
                'oauth_verifier'         => $oauthVerifier,
            ];

            if(!$isSingle)
            {
                $params['pagesize'] = $limit;
                $params['pagenumber'] =  ($start / $limit) + 1;
            }

            ksort($params);
            $normalizedParams = http_build_query($params, '', '&', PHP_QUERY_RFC3986);

            $method = 'GET';

            if ($isSingle)
            {
                $realestateID = $input->get('realestateID', 0, 'INT');
                $url          = 'https://rest.immobilienscout24.de/restapi/api/offer/v1.0/user/me/realestate/' . $realestateID;
            }
            else
            {
                $url = 'https://rest.immobilienscout24.de/restapi/api/offer/v1.0/user/me/realestate';
            }

            $signatureBaseString = $method . '&' . rawurlencode($url) . '&' . rawurlencode($normalizedParams);

            $signatureKey = rawurlencode($consumerSecret) . '&' . rawurlencode($tokenSecret);

            $rawSignature   = hash_hmac('sha1', $signatureBaseString, $signatureKey, true);
            $oauthSignature = base64_encode($rawSignature);

            $oauthParams = http_build_query([
                    'oauth_signature' => $oauthSignature,
                ] + $params, '', '&', PHP_QUERY_RFC3986);

            $finalUrl = $url . '?' . $oauthParams;

            curl_setopt_array($curl, array(
                CURLOPT_URL            => $finalUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'GET',
                CURLOPT_HTTPHEADER     => array(
                    'Accept: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return $response;
        }


         /**
         * Method to get a List or a single realestate
         *
         * @return  mixed  An array of objects on success, false on failure.
         */
        public static function realestatesContactData()
        {

            $app   = Factory::getApplication();
            $input = $app->input;

            $paramsComponent = ComponentHelper::getParams('com_vmmimmoscout');

            $curl = curl_init();

            // Aktuelles Datum
            $today = time();

            // OAuth-Parameter definieren
            $consumerKey    = $paramsComponent->get('oauth_consumer_key');
            $consumerSecret = $paramsComponent->get('oauth_consumer_secret');
            $tokenSecret    = $paramsComponent->get('token_secret');
            $token          = $paramsComponent->get('oauth_token');
            $oauthVerifier  = $paramsComponent->get('oauth_verifier');
            $timestamp      = time(); // Dies sollte normalerweise die aktuelle Zeit sein
            $nonce          = self::_generateRandomString(11); // Dies sollte normalerweise ein einzigartiger Wert sein

            $params = [
                'oauth_consumer_key'     => $consumerKey,
                'oauth_token'            => $token,
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_timestamp'        => $timestamp,
                'oauth_nonce'            => $nonce,
                'oauth_version'          => '1.0',
                'oauth_verifier'         => $oauthVerifier,
            ];

            ksort($params);
            $normalizedParams = http_build_query($params, '', '&', PHP_QUERY_RFC3986);

            $method = 'GET';

            $url = 'https://rest.immobilienscout24.de/restapi/api/offer/v1.0/user/me/contact';

            $signatureBaseString = $method . '&' . rawurlencode($url) . '&' . rawurlencode($normalizedParams);

            $signatureKey = rawurlencode($consumerSecret) . '&' . rawurlencode($tokenSecret);

            $rawSignature   = hash_hmac('sha1', $signatureBaseString, $signatureKey, true);
            $oauthSignature = base64_encode($rawSignature);

            $oauthParams = http_build_query([
                    'oauth_signature' => $oauthSignature,
                ] + $params, '', '&', PHP_QUERY_RFC3986);

            $finalUrl = $url . '?' . $oauthParams;

            curl_setopt_array($curl, array(
                CURLOPT_URL            => $finalUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'GET',
                CURLOPT_HTTPHEADER     => array(
                    'Accept: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return $response;
        }


        protected static function _generateRandomString($length = 10)
        {
            // Entferne Zahlen aus dem Zeichensatz
            $characters       = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString     = '';
            for ($i = 0; $i < $length; $i++)
            {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            return $randomString;
        }

    }
