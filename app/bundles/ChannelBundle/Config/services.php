<?php

declare(strict_types=1);

use Mautic\CoreBundle\DependencyInjection\MauticCoreExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->public();

    $excludes = [
        'PreferenceBuilder/ChannelPreferences.php',
        'PreferenceBuilder/PreferenceBuilder.php',
    ];

    $services->load('Mautic\\ChannelBundle\\', '../')
        ->exclude('../{'.implode(',', array_merge(MauticCoreExtension::DEFAULT_EXCLUDES, $excludes)).'}');

    $services->load('Mautic\\ChannelBundle\\Entity\\', '../Entity/*Repository.php');
    $services->alias('mautic.channel.model.message', \Mautic\ChannelBundle\Model\MessageModel::class);
    $services->alias('mautic.channel.model.queue', \Mautic\ChannelBundle\Model\MessageQueueModel::class);
    $services->alias('mautic.channel.model.channel.action', \Mautic\ChannelBundle\Model\ChannelActionModel::class);
    $services->alias('mautic.channel.model.frequency.action', \Mautic\ChannelBundle\Model\FrequencyActionModel::class);
};
