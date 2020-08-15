<?

namespace Kender\TemplateModel;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment as Twig;
use Kender\Config;

class TwigTemplate extends Twig{


    function __construct(){

        $loader = new FilesystemLoader(BASEPATH."\\".Config::PUBLIC_PATH);
        parent::__construct($loader,/*[ 'cache' => BASEPATH."\Kender\Cache\compilation_cache",]*/);
    }

  

 

}