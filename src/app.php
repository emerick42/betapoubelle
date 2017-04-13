<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['config.api.key'] = '1988be26b106';

$app['app.api.client'] = function ($app) {
    return new App\Domain\Api\CurlClient(
        $app['config.api.key'],
        $app['session']
    );
};
$app['app.visits.reader'] = function () {
    return new App\Domain\Visit\StaticReader();
};

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->get('/', function () use ($app) {
    $user = $app['app.api.client']->getMemberInformations();
    $visits = $app['app.visits.reader']->getVisits();

    return $app['twig']->render('homepage.html.twig', [
        'user' => $user,
        'visits' => $visits,
    ]);
});

return $app;
