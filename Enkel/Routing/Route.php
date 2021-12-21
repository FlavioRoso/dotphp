<?
namespace Enkel\Routing;

class Route
{

    protected $url;
    protected $controller;
    protected $method;
    protected $data;


    function __construct($url)
    {
        $this->url = $url;
    }

    public function getUrl() { return $this->url; }
    public function setUrl($url) { 
        $this->url = $url; 
        return $this;
    }

    public function getController() { return $this->controller; }
    public function setController($controller) { 
        $this->controller = $controller; 
        return $this;
    }

    public function getMethod() { return $this->method; }
    public function setMethod($method) { 
        $this->method = $method;
        return $this;
    }

    public function getData() { return $this->data; }
    public function setData($name,$data) { 
        $this->data [$name] = $data;
        return $this; 
    }

    
    public function hasData()
    {
        return isset($this->data);
    }



    public function getQtdRequiredUrl() {

        $data = explode("/",$this->getUrl());

        $countRequired = 0;

        foreach($data as $param)
        {
            if(!$this->isDataUrl($param))
            {
                $countRequired++;
            }
            else
            {
                $countRequired += $this->verifyRequeiredParam($param);
            }
        }

        return $countRequired;
        
    }

    /**
     * 
     * "@" Is a identify to required's paramters, the route shoud not be found if not contein a required paramter
     * 
     */
    public function verifyRequeiredParam($param)
    {
        trim($param);

        return preg_match('/@[ {]\D.*[}]/',$param);
    }


    /**
     * 
     * 
     * Verify's if the part of url is a data patern
     * 
     * @param string $param remove all indentify caracters to a data paramter and retorn only te variable name
     * @return bool 
     * 
     */
    public function isDataUrl(String $param) : bool
    {
        trim($param);

        return preg_match('/(@|)[ {]\D.*[}]/',$param) ;
    }

    /**
     * 
     * Removes extra string to indentify the data parameter and get only the data name
     * @param string $param remove all indentify caracters to a data paramter and retorn only te variable name
     * @return string 
     */

    public function getNameFromDataUrl(String $param) : String
    {
        $data = null;

        if($this->isDataUrl($param))
        {
            $param = str_replace(['{','}',' ','@'],'',$param);
            $data = $param;
        }

        return $data;
    }


    /**
     * the data from the url requested, and put on the data using the name on the router url
     * 
     * @param string $url Get the dynamic data from que request url, and put on the data attribute 
     * @return null 
     * 
     * 
     */

    public function setDataFromUrl(String $url) 
    {
        $request = explode("/",$url);
        $data = explode("/",$this->getUrl());
        $size = count($data);
        for($i = 0; $i < $size; $i++)
        {
            if($this->isDataUrl($data[$i]))
            {
                $name = $this->getNameFromDataUrl($data[$i]);
                if(isset($request[$i]))
                {
                    $value = $request[$i];
                    $this->setData($name,$value);
                }
            }
        }
    }

    public function matchUrl(String $requestURL)
    {
        
        //Initiate variables
        $match = false;
        $paramMatches = [];

        //brekes request and route url by dashes
        $paramRequest =  explode('/', $requestURL);
        $paramRoute =  explode('/', $this->getUrl());

        //Remove the first "" from explode return
        array_shift($paramRequest);
        array_shift($paramRoute);
        
        

        //If the quantity of paramters request is iquals or lower them the route param's
        if( count($paramRoute) >= count($paramRequest) )
        {

            $qtd = count($paramRoute);
            //For each param route 
            for($i = 0; $i < $qtd ; $i++)
            {

                if(!$this->isDataUrl($paramRoute[$i]))
                {
                    //If the paramter is static, them verify if is iquals to param route
                    $paramMatches [$i] = isset($paramRequest[$i]) && $paramRoute[$i] == $paramRequest[$i];
                }
                else
                {
                    //If the paramter is dynamic, them verify if the paramter is required
                    $paramMatches [$i] = isset($paramRequest[$i]) || !$this->verifyRequeiredParam($paramRoute[$i]);
                }
            }

            //Verify if all matches is true
            if(count(array_unique($paramMatches)) === 1)  
                $match = current($paramMatches);
        }

        return $match;
    }

    /**
     * 
     * 
     * Execute the router criating a nex instance of the controler, calling the method
     * 
     */

    public function addRouteDataToController($controller)
    {
        $reflect = new \ReflectionClass($controller);
        $controller->controlerName = $reflect->getShortName();
        $controller->methodName = $this->method;
    }

    public function execute()
    {
        $controller = new $this->controller;
        $this->addRouteDataToController($controller);
        $method = $this->method;

        
        if($this->hasData()) 
        {
            echo $controller->$method($this->getData());
        }
        else
        {
            echo $controller->$method();
        }
        
    }


    

}