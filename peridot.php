<?php

use Evenement\EventEmitterInterface;
use Peridot\Plugin\Watcher\WatcherPlugin;
use Peridot\Reporter\CodeCoverageReporters;
use Peridot\Reporter\Dot\DotReporterPlugin;
use Peridot\Reporter\ListReporter\ListReporterPlugin;
use Peridot\Concurrency\ConcurrencyPlugin;
use Symfony\Component\Console\Input\InputInterface;
use Peridot\Console\Environment;

return function(EventEmitterInterface $emitter) {
    $watcher = new WatcherPlugin($emitter);
    $dot = new DotReporterPlugin($emitter);
    $list = new ListReporterPlugin($emitter);
    $concurrency = new ConcurrencyPlugin($emitter);

    // disable watcher for concurrency workers
    $emitter->on('peridot.execute', function (InputInterface $input) {
        $token = getenv('PERIDOT_TEST_TOKEN');
        if ($token) {
            $input->setOption('watch', false);
        }
    });

    $coverage = new CodeCoverageReporters($emitter);
    $coverage->register();

    $emitter->on('peridot.start', function (Environment $env) {
        $env->getDefinition()->getArgument('path')->setDefault('specs');
    });
};
