<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up()
{
Schema::create('messages', function (Blueprint $table) {
$table->id();
$table->foreignId('ticket_id')->constrained()->onDelete('cascade');
$table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
$table->text('message');
$table->boolean('is_agent')->default(false);
$table->timestamps();
});
}

public function down()
{
Schema::dropIfExists('messages');
}
};
