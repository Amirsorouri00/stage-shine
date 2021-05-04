<?php

use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventStarsTable extends Migration {

    /**
     * @var string
     */
    protected $table = Tables::STAGESHINE_EVENT_STARS;

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

			$table->bigInteger('event_id')->nullable();
			$table->bigInteger('user_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop($this->table);
	}
}
