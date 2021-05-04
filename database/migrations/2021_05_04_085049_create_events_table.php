<?php

use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration {

    /**
     * @var string
     */
    protected $table = Tables::STAGESHINE_EVENTS;

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
            $table->bigInteger('id', true);

			$table->string('name', 512)->index();
			$table->enum('language', array('English', 'French', 'Spanish', 'Russian', 'Arabic', 'Chinese', 'Persian'))->nullable()->index();
			$table->datetimeTz('start')->nullable();
			$table->bigInteger('duration')->nullable();
			$table->string('file_name', 1024)->nullable();
			$table->string('link', 2048)->nullable();
			$table->longText('description')->nullable();
			$table->string('event_cover', 1024)->nullable();
			$table->bigInteger('channel_id')->nullable();
			$table->integer('rate')->unsigned()->nullable()->index()->default('0');
			$table->integer('limit')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop($this->table);
	}
}
