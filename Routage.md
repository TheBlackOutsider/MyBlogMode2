
Pourquoi un Router ?
Avant même de commencer pourquoi s'emmerder à créer un router en PHP ? Il est en effet tout à fait possible de gérer vos urls gràce au RewriteEngine d'apache ou le ngx_http_rewrite_module de nginx.
Le principal problème de cette méthode c'est que l'on va devoir adapter notre serveur à chaque déploiement pour y injecter les règles. En plus, on ne va pas se mentir la réécriture d'URL c'est chiant !

Le router va donc devenir le point d'entrée de notre application et on redirigera toutes les URLs vers ce fichier. Pour cela, on ne peut malheureusement pas y couper il nous faudra créer un fichier.htaccess ou créer la redirection dans notre configuration nginx.

RewriteEngine on

RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]

La classe Router
Pour commencer notre Router nous allons créer une première classe Router. Cette classe permettra d'ajouter des URLs à capturer, mais aussi le code à éxécuter.

class Router {

    private $url; // Contiendra l'URL sur laquelle on souhaite se rendre
    private $routes = []; // Contiendra la liste des routes

    public function __construct($url){
        $this->url = $url;
    }

}
On va ensuite créer des fonctions correspondantes aux différentes méthodes HTTP (GET, POST, PUT et DELETE). Nous allons commencer par la méthode get() qui prendra 2 paramètres

L'URL à capturer
La méthode à appeller lorsque cette URL est capturé. On va pour cela utiliser les fonctions anonymes qui ont fait leur apparition récemment.
Afin de ne pas se retrouver avec un code beaucoup trop volumineux, nous allons créer une nouvelle classe qui servira à instancier une route.

public function get($path, $callable){
    $route = new Route($path, $callable);
    $this->routes["GET"][] = $route;
    return $route; // On retourne la route pour "enchainer" les méthodes
}
Afin d'améliorer les performances lors du matching on groupera les routes par méthodes afin de ne pas tout se retaper lors du parcours des URLs. Enfin, il nous faudra une nouvelle méthode pour déclencher le matching.

public function run(){
    if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
        throw new RouterException('REQUEST_METHOD does not exist');
    }
    foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
        if($route->match($this->url)){
            return $route->call();
        }
    }
    throw new RouterException('No matching routes');
}
Cette fonction va parcourir les différentes routes préalablement enregistrées et vérifier si la route correspond à l'URL qui est passé au contructeur, ceci gràce à la fonction match() de notre Route. Si aucune route ne correspond à l'URL ou à la méthode alors nous allonrs renvoyer une Exception qui pourra ensuite être capturée pour gérer un affiche correcte des erreurs.

La classe Route
La classe Route va représenter une route et contiendra plusieurs méthodes dont notamment la méthode match($url) qui permettra de s'avoir si la route valide l'URL.

class Route {

    private $path;
    private $callable;
    private $matches = [];
    private $params = [];

    public function __construct($path, $callable){
        $this->path = trim($path, '/');  // On retire les / inutils
        $this->callable = $callable;
    }

    /**
    * Permettra de capturer l'url avec les paramètre 
    * get('/posts/:slug-:id') par exemple
    **/
    public function match($url){
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches)){
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;  // On sauvegarde les paramètre dans l'instance pour plus tard
        return true;
    }

}
Ensuite, on va ajouter une méthode permettant d'éxécuter la fonction anonyme en lui passant les paramètres récupérés lors du preg_match().

public function call(){
    return call_user_func_array($this->callable, $this->matches);
}
Utilisation
Maintenant que notre base est posée nous allons pouvoir créer nos premières routes dans notre index.php.

$router = new Router($_GET['url']); 
$router->get('/', function($id){ echo "Bienvenue sur ma homepage !"; }); 
$router->get('/posts/:id', function($id){ echo "Voila l'article $id"; }); 
$router->run(); 
Améliorations
Première amélioration, on va ajouter une méthode pour gérer l'expression régulière qui servira à capturer les paramètres. Pour cela on va ajouter une méthode with($param, $regex) à notre classe Route.

public function with($param, $regex){
    $this->params[$param] = str_replace('(', '(?:', $regex);
    return $this; // On retourne tjrs l'objet pour enchainer les arguments
}
Il faudra du coup modifier la fonction match() pour utiliser ces nouveaux paramètres.

public function match($url){
    $url = trim($url, '/');
    $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
    $regex = "#^$path$#i";
    if(!preg_match($regex, $url, $matches)){
        return false;
    }
    array_shift($matches);
    $this->matches = $matches;
    return true;
}

private function paramMatch($match){
    if(isset($this->params[$match[1]])){
        return '(' . $this->params[$match[1]] . ')';
    }
    return '([^/]+)';
}
On va aussi ajouter une méthode qui permettra de générer une url en passant les paramètres.

public function getUrl($params){
    $path = $this->path;
    foreach($params as $k => $v){
        $path = str_replace(":$k", $v, $path);
    }
    return $path;
}
Enfin, on va modifier notre méthode call() pour gérer un callback qui sera une chaine de caractère. Par exemple, on pourra faire appel à un controller en mettant Posts#show qui fera appel à la class PostsController et à la méthode show().

public function call(){
    if(is_string($this->callable)){
        $params = explode('#', $this->callable);
        $controller = "App\\Controller\\" . $params[0] . "Controller";
        $controller = new $controller();
        return call_user_func_array([$controller, $params[1]], $this->matches);
    } else {
        return call_user_func_array($this->callable, $this->matches);
    }
}
Il faudra du coup modifier notre class Router pour gérer ces nouveaux paramètres et on va en profiter pour pouvoir nommer nos routes

class Router {

    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url){
        $this->url = $url;
    }

    public function get($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method){
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null){
            $name = $callable;
        }
        if($name){
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run(){
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }
        }
        throw new RouterException('No matching routes');
    }

    public function url($name, $params = []){
        if(!isset($this->namedRoutes[$name])){
            throw new RouterException('No route matches this name');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

}








Xen0risDEV
Il y a 7 ans
Répondre
Les expressions régulières ne sont pas Tip top, pour un / ses logiquement /, et idem pour le regex de path /^posts/(\/)$/ on obtient une erreur et il faut donc ajouter à notre regex un \ pour être dans les normes de regex.

Pour les personnes intéressées régler ce petit souci et très simple.

Dans la fonction match(); de Route.php, il vous faut mettre après les premières variables qui sont :
$url = trim($url, '/');
$path = pregreplacecallback('/:([\w]+)/', [$this, 'paramMatch'], $this->path);

Ajouté en dessous : 
$path = str_replace('/', '/', $path);

Voilà

Dans router.php ont déclare une variable privé
private $GroupPattern = '';

dans la function add ont ajoute au dessus complètement les ligne suivante:

if(!empty($this->GroupPattern)){
     $path = $this->GroupPattern.$path;
 }

puis ont créer une function scope:

public function scope($GroupPattern, \Closure $routes){
        $this->GroupPattern = $GroupPattern;
        $routes($this);
        unset($this->GroupPattern);

}
du coup ont utilise comme sa:

$router->scope('/admin', function($router) { 
    $router->get('/delete/:slug/:id', 'Users#delete');
});

pour éviter des problemes(absence ou double slash entre le scope et le path), il serait preferable de faire plutot:
if(!empty($this->GroupPattern))
            $path = trim($this->GroupPattern,'/').'/'.ltrim($path,'/');



let data = Ajax.http('/getUsername', 'post', 'application/json', 'application/json', `${this.value}`);
            console.log("fromn app", data);




            1111AAaa@