<?php

use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table(Tables::STAGESHINE_EVENTS, function(Blueprint $table) {
			$table->foreign('channel_id')->references('id')->on(Tables::STAGESHINE_CHANNELS)
						->onDelete('no action')
						->onUpdate('restrict');
		});
		Schema::table(Tables::STAGESHINE_CHANNELS, function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on(Tables::STAGESHINE_CATEGORIES)
						->onDelete('set null')
						->onUpdate('restrict');
		});
		Schema::table(Tables::STAGESHINE_CHANNEL_FOLLOWERS, function(Blueprint $table) {
			$table->foreign('channel_id')->references('id')->on(Tables::STAGESHINE_CHANNELS)
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table(Tables::STAGESHINE_CHANNEL_FOLLOWERS, function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on(Tables::STAGESHINE_USERS)
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table(Tables::STAGESHINE_EVENT_COMMENTS, function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on(Tables::STAGESHINE_USERS)
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table(Tables::STAGESHINE_EVENT_COMMENTS, function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on(Tables::STAGESHINE_EVENTS)
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table(Tables::STAGESHINE_EVENT_STARS, function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on(Tables::STAGESHINE_EVENTS)
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table(Tables::STAGESHINE_EVENT_STARS, function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on(Tables::STAGESHINE_USERS)
						->onDelete('restrict')
						->onUpdate('restrict');
		});
        Schema::table(Tables::STAGESHINE_USER_ARCHIVED_EVENTS, function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on(Tables::STAGESHINE_USERS)
                ->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on(Tables::STAGESHINE_EVENTS)
                ->onDelete('cascade');
        });
        Schema::table(Tables::STAGESHINE_USER_EVENTS, function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on(Tables::STAGESHINE_USERS)
                ->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on(Tables::STAGESHINE_EVENTS)
                ->onDelete('cascade');
        });
	}

	public function down()
	{
		Schema::table(Tables::STAGESHINE_EVENTS, function(Blueprint $table) {
			$table->dropForeign('events_channel_id_foreign');
		});
		Schema::table(Tables::STAGESHINE_CHANNELS, function(Blueprint $table) {
			$table->dropForeign('channels_category_id_foreign');
		});
		Schema::table(Tables::STAGESHINE_CHANNEL_FOLLOWERS, function(Blueprint $table) {
			$table->dropForeign('channel_followers_channel_id_foreign');
		});
		Schema::table(Tables::STAGESHINE_CHANNEL_FOLLOWERS, function(Blueprint $table) {
			$table->dropForeign('channel_followers_user_id_foreign');
		});
		Schema::table(Tables::STAGESHINE_EVENT_COMMENTS, function(Blueprint $table) {
			$table->dropForeign('event_comments_user_id_foreign');
		});
		Schema::table(Tables::STAGESHINE_EVENT_COMMENTS, function(Blueprint $table) {
			$table->dropForeign('event_comments_event_id_foreign');
		});
		Schema::table(Tables::STAGESHINE_EVENT_STARS, function(Blueprint $table) {
			$table->dropForeign('event_stars_event_id_foreign');
		});
		Schema::table(Tables::STAGESHINE_EVENT_STARS, function(Blueprint $table) {
			$table->dropForeign('event_stars_user_id_foreign');
		});
		Schema::table(Tables::STAGESHINE_USER_EVENTS, function(Blueprint $table) {
			$table->dropForeign('user_events_user_id_foreign');
		});
		Schema::table(Tables::STAGESHINE_USER_EVENTS, function(Blueprint $table) {
			$table->dropForeign('user_events_event_id_foreign');
		});
	}
}
