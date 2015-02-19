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
    $emitter->on('peridot.start', function (Environment $env) {
        $env->getDefinition()->getArgument('path')->setDefault('specs');
    });
};
