<?php

use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventCommentsTable extends Migration {

    /**
     * @var string
     */
    protected $table = Tables::STAGESHINE_EVENT_COMMENTS;

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

			$table->string('comment', 128);
			$table->bigInteger('user_id')->nullable();
			$table->bigInteger('event_id')->nullable()->index();

            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop($this->table);
	}
}
