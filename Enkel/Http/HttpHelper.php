<?

namespace Enkel\Http;

use App\Config;

class HttpHelper
{


    static function getRootDirPath()
    {
        $root = str_replace(Config::SERVER_ROOT_PATH, '/', BASEPATH . "/");
        $root = str_replace("\\", "/", $root);


        return $root;
    }



    public static function getRequestUrl()
    {
        $root = self::getRootDirPath();
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = str_replace($root, "/", $url);
        return $url;
    }
}
