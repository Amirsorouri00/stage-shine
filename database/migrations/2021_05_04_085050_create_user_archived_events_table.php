<?php

use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserArchivedEventsTable extends Migration {

    /**
     * @var string
     */
    protected $table = Tables::STAGESHINE_USER_ARCHIVED_EVENTS;

    /**
     * The database schema.
     *
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

    /**
     * Create a new migration instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->schema = Schema::connection($this->getConnection());
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create($this->table, function(Blueprint $table) {
            $table->integer('id', true);

            $table->bigInteger('user_id')->nullable()->index($this->table . '_user_id');
            $table->bigInteger('event_id')->nullable()->index($this->table . '_event_id');

            // FOREIGN KEY CONSTRAINTS
//            $table->foreign('user_id')->references('id')->on(Tables::STAGESHINE_USERS)
//                ->onDelete('cascade');
//            $table->foreign('event_id')->references('id')->on(Tables::STAGESHINE_EVENTS)
//                ->onDelete('cascade');

			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop($this->table);
	}
}
