<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('generated_posts', function (Blueprint $table) {
            $table->dropColumn(['hook', 'body', 'status']);
        });

        Schema::table('generated_posts', function (Blueprint $table) {
            $table->string('hook_propose');
            $table->longText('body_points');
            $table->integer('technical_readability_score');
            $table->longText('suggested_hashtags');
            $table->longText('tone_compliance_justification');
            $table->longText('payload_brut');
        });
    }

    public function down(): void
    {
        Schema::table('generated_posts', function (Blueprint $table) {
            $table->dropColumn([
                'hook_propose',
                'body_points',
                'technical_readability_score',
                'suggested_hashtags',
                'tone_compliance_justification',
                'payload_brut',
            ]);
        });

        Schema::table('generated_posts', function (Blueprint $table) {
            $table->string('hook');
            $table->longText('body');
            $table->enum('status', ['draft', 'posted', 'archived'])->default('draft');
        });
    }
};
