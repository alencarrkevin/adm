<?php

//require './core/Config.php';

namespace Core;

class ConfigController extends Config
{

    private string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlMetodo;
    private string $urlParameter;
    private string $classLoad; 
    private array $format;
    private string $urlSlugController;
    private string $urlSlugMetodo;


    public function __construct()
    {
        $this->configAdm();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            //var_dump($this->url);
            $this->clearUrl();
            $this->urlArray = explode("/", $this->url);
           // var_dump($this->urlArray);

            if (isset($this->urlArray[0])) {
                $this->urlController = $this->slugController($this->urlArray[0]);
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
            }

            if (isset($this->urlArray[1])) {
                $this->urlMetodo = $this->slugMetodo($this->urlArray[1]);
            } else {
                $this->urlMetodo = $this->slugMetodo(METODO);
            }

            if (isset($this->urlArray[2])) {
                $this->urlParameter = $this->urlArray[2];
            } else {
                $this->urlParameter = "";
            }
        } else {
            $this->urlController = $this->slugController(CONTROLLERERRO);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParameter = "";
        }
      //  echo "Controller: {$this->urlController} <br>";
       // echo "Metodo: {$this->urlMetodo} <br>";
      //  echo "Paramentro: {$this->urlParameter} <br>";
    }

    private function clearUrl(): void
    {
        //Eliminar as tag
        $this->url = strip_tags($this->url);
        //Eliminar espaços em branco
        $this->url = trim($this->url);
        //Eliminar a barra no final da URL
        $this->url = rtrim($this->url, "/");
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuyouuuuuybsaaaaaaaceeeeiiiidnoooooouuuuuyouuuuuyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(mb_strtolower($this->url), $this->format['a'], $this->format['b']);

    }

    private function slugController($slugController): string
    {
        // Verificar se o nome do controller é uma palavra reservada
        if (in_array(strtolower($slugController), ['class', 'function'])) {
            $slugController .= 'Controller'; // Adicionar 'Controller' ao final para evitar conflitos
        }

        $this->urlSlugController = $slugController;
        // Converter para minusculo
        $this->urlSlugController = strtolower($this->urlSlugController);
        // Converter o traco para espaco em braco
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        // Converter a primeira letra de cada palavra para maiusculo
        $this->urlSlugController = ucwords($this->urlSlugController);
        // Retirar espaco em branco        
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);
      //  var_dump($this->urlSlugController);
        return $this->urlSlugController;
    }

    private function slugMetodo($urlSlugMetodo): string
    {
        // Verificar se o nome do método é uma palavra reservada
        if (in_array(strtolower($urlSlugMetodo), ['class', 'function'])) {
            $urlSlugMetodo .= 'Method'; // Adicionar 'Method' ao final para evitar conflitos
        }

        $this->urlSlugMetodo = $urlSlugMetodo;
        //Converter para minusculo a primeira letra
        $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo);
        //var_dump($this->urlSlugMetodo);
        return $this->urlSlugMetodo;
    }

   /**
     * Carregar as Controllers
     * Instanciar as classes da controller e carregar o método 
     *
     * @return void
     */
    public function loadPage(): void
    {
        //echo "Carregar Pagina: {$this->urlController}<br>";

        //$this->urlController = ucwords($this->urlController);
        //echo "Carregar Pagina corrigida: {$this->urlController}<br>";

        //$this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;
        //$classePage = new $this->classLoad();
        //$classePage->{$this->urlMetodo}();

        $loadPgAdm = new \Core\CarregarPgAdm();
        $loadPgAdm->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter);
    }
}
