# Deverm-Annotations
```php
class TestingController {
    /**
     * @modules\devermannotations\Route(route = "/hi", method = "GET")
     */
    public static function hello(){
        echo "HIII";
    }
}

$deverm = new modules\devermannotations\DevermAnnotations($router);
$deverm->addClass(TestingController::class);
$deverm->init();
```