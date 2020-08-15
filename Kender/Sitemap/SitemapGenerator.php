<?php

namespace Kender\Sitemap;


class SitemapGenerator{

    private $url;

    function __construct(String $url)
    {
        $this->url = $url;
    }

    function getAllLinks($html)
    {
        $matches = [];
        preg_match_all('/<a.*href=".*" /',$html,$matches,PREG_OFFSET_CAPTURE);
        return  $matches;
    }

    function getUrlsFromLinks($links)
    {
        $urls = [];

        if(!empty($links))
        {
            foreach($links as $link)
            {   
                $match = [];
                preg_match('/".*" /',$link,$match,PREG_OFFSET_CAPTURE);
                $urls [] = str_replace(['"',' '],'',$match);
            }
        }

        return $urls;
        
    }

    function exec()
    {
        $ch =curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url );
        curl_setopt($ch, CURLOPT_HEADER, FALSE); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        
        $execUrls [$this->url] = 1;
        
        $html = curl_exec($ch);
        $links = $this->getAllLinks($html)[0];
        $urls = $this->getUrlsFromLinks($links);

        curl_close($ch);

        

        
        return $html;
    }


}