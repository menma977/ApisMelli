<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   *
   * * Status
   * * * 0: Danger -> #007bff
   * * * 0: Warning -> #ffc107
   * * * 0: Info -> #17a2b8
   */
  public function up()
  {
    Schema::create('notifications', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer("status");
      $table->string("rbg");
      $table->string("description");
      $table->text("full_description");
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
    Schema::dropIfExists('notifications');
  }
}
