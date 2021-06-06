<?php


namespace App\Constants;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\ChannelFollowersController;
use App\Http\Controllers\EventController;

abstract class Endpoints
{
    const HTTP_API_SUBSCRIPTION = [
        'name'          => 'core.api.subscription',
        'description'   => 'crude of subscription package',
        'endpoint'      => 'subscription',
        'method'        => 'api_resource',
        'class'         => 'SubscriptionController'
    ];

    const HTTP_API_SUBSCRIPTION_ENTITY = [
        'name'          => 'core.api.subscription.entities',
        'description'   => 'crude of settlement_test_creator subscription entities package',
        'endpoint'      => 'subscription_entities',
        'method'        => 'api_resource',
        'class'         => 'EntityController'
    ];

    const HTTP_API_SINGLE_SUBSCRIPTION_ENTITY = [
        'name'          => 'core.api.subscription.single_entities',
        'description'   => 'crude of  subscription entities package',
        'endpoint'      => 'subscription_entities/single/{subscriptionId}',
        'method'        => 'get',
        'class'         => 'EntityController@single',
    ];

    public const STAGESHINE_EVENTS = [
        'name'          => 'core.api.stage-shine.event',
        'description'   => 'crud of stage-shine events',
        'endpoint'      => 'events',
        'class'         => "EventController",
    ];

    public const STAGESHINE_EVENTS_PANEL_INDEX = [
        'name'          => 'core.api.stage-shine.event',
        'description'   => 'crud of stage-shine events',
        'endpoint'      => 'events/panel_index',
        'class'         => [EventController::class, "panel_index"],
    ];

    public const STAGESHINE_CATEGORIES = [
        'name'          => 'core.api.stage-shine.event',
        'description'   => 'crud of stage-shine events',
        'endpoint'      => 'categories',
        'class'         => "CategoryController",
    ];

    public const STAGESHINE_CATEGORIES_PANEL_INDEX = [
        'name'          => 'core.api.stage-shine.category',
        'description'   => 'crud of stage-shine categories',
        'endpoint'      => 'categories/panel_index',
        'class'         => [CategoryController::class, "panel_index"],
    ];

    public const STAGESHINE_CHANNELS = [
        'name'          => 'core.api.stage-shine.channels',
        'description'   => 'crud of stage-shine channels',
        'endpoint'      => 'channels',
        'class'         => "ChannelController",
    ];

    public const STAGESHINE_CHANNELS_PANEL_INDEX = [
        'name'          => 'core.api.stage-shine.channels',
        'description'   => 'crud of stage-shine channels',
        'endpoint'      => 'channels/panel_index',
        'class'         => [ChannelController::class, "panel_index"],
    ];

    public const STAGESHINE_CHANNEL_FOLLOWERS = [
        'name'          => 'core.api.stage-shine.channel_followers',
        'description'   => 'crud of stage-shine channel_followers',
        'endpoint'      => 'channel_followers',
        'class'         => "ChannelFollowersController",
    ];

    public const STAGESHINE_CHANNEL_FOLLOWERS_PANEL_INDEX = [
        'name'          => 'core.api.stage-shine.channel_followers',
        'description'   => 'crud of stage-shine channel_followers',
        'endpoint'      => 'channel_followers/panel_index',
        'class'         => [ChannelFollowersController::class, "panel_index"],
    ];

}
