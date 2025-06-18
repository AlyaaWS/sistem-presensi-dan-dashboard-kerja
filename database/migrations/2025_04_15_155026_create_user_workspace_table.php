<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('workspace_user', function (Blueprint $table) {
        $table->id(); // optional, lebih baik pakai id auto
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('id_workspace');
        $table->string('role_in_workspace')->default('member'); // default = member
        $table->timestamps();

        // Foreign key constraint
        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('id_workspace')->references('id_workspace')->on('workspaces')->onDelete('cascade');

        // Optional: mencegah duplicate
        $table->unique(['id_user', 'id_workspace']);
    });
}

public function down(): void
{
    Schema::dropIfExists('workspace_user');
}

};
