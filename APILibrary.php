<?php

function getAPIDataCurl( $url )
{
    $option = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 3
    ];

    $ch = curl_init( $url );
    curl_setopt_array( $ch, $option );

    $res = curl_exec( $ch );
    $info = curl_getinfo( $ch );
    $error = curl_errno( $ch );

    if ( $error !== CURLE_OK )
    {
        echo "Error:" . error;
        return "";
    }

    if ( $info['http_code'] !== 200 )
    {
        echo "Status code is not OK: " . $info['http_code'];
        return "";
    }

    return $res;
}

function xmlToArray( $xml )
{
    $parser = xml_parser_create();

    xml_parse( $parser, $xml );

    xml_parser_free( $parser );
}

?>