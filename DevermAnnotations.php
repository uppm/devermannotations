<?php
namespace modules\devermannotations;

use ReflectionClass;
use modules\phpdocannotations\AnnotationParser;
use modules\deverm\Router;

class DevermAnnotations {

    private $classes;
    private $router;

    public function __construct(Router $router){
        $this->classes = [];
        $this->router = $router;
    }

    public function addClass($clazz){
        array_push($this->classes, $clazz);
    }

    public function init(){
        foreach ($this->classes as $clazz) {
            $reflection = new ReflectionClass($clazz);
            foreach ($reflection->getMethods() as $method){
                $parser = new AnnotationParser($method->getDocComment(), true);
                if ($parser->hasAnnotation(Route::class)) {
                    $annotation = $parser->getAnnotation(Route::class);
                    $this->router->{\strtolower($annotation->method)}($annotation->route, function(...$args) use ($method, $reflection) {
                        $method->invoke($reflection, $args);
                    });
                    echo $annotation->route;
                }
            }
        }
    }
}