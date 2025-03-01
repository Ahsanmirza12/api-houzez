<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentContactSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('agent_contact_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->string('setting_type')->comment('author, agent, or none')->nullable();
            $table->json('agents')->nullable()->comment('List of selected agents');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agent_contact_settings');
    }
}
