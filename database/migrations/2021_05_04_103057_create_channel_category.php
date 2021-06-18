<?php

use App\Constants\Tables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelCategory extends Migration
{
    /**
     * @var string
     */
    protected $table = Tables::STAGESHINE_CHANNEL_CATEGORY;

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
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigInteger('id', true);

            $table->bigInteger('category_id')->nullable()->index($this->table . '_category_id');
            $table->bigInteger('channel_id')->nullable()->index($this->table . '_channel_id');

            $table->foreign('category_id')->references('id')->on(Tables::STAGESHINE_CATEGORIES)
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('channel_id')->references('id')->on(Tables::STAGESHINE_CHANNELS)
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
