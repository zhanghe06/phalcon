<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            return $volt;
        },
        '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    return new DbAdapter($config->database->toArray());
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * add routing capabilities
 * 参考：http://docs.phalconphp.com/zh/latest/reference/routing.html#defining-routes
 */
$di->set('router', function(){
    $router = new \Phalcon\Mvc\Router();
    //设置默认路由(如果同nginx，可以不用设置)
    $router->add("/", array(
        'controller' => 'index',
        'action' => 'index'
    ));
    //Set 404 paths
    $router->notFound(array(
        "controller" => "index",
        "action" => "route404"
    ));
    return $router;
});

/**
 * 配置对称加密服务（Setting up an Encryption service）
 */
$di->set('crypt', function() {

    $crypt = new Phalcon\Crypt();

    //设置全局加密密钥
    $crypt->setKey('%31.1e$i86e$f!8jz');

    return $crypt;
}, true);

/**
 * Redis connection is created based in the parameters defined in the configuration file
 */
$di->set('redis', function () use ($config) {
    $host = $config->redis->host;
    $port = $config->redis->port;
    $redis = new Redis();
    $redis->connect($host, $port);
    return $redis;
});