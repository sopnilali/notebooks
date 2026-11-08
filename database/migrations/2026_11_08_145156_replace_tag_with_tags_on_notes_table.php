<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->json('tags')->nullable()->after('title');
        });

        DB::table('notes')->whereNotNull('tag')->get(['id', 'tag'])->each(function ($note) {
            DB::table('notes')->where('id', $note->id)->update([
                'tags' => json_encode([$note->tag]),
            ]);
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('tag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->string('tag')->nullable()->after('title');
        });

        DB::table('notes')->whereNotNull('tags')->get(['id', 'tags'])->each(function ($note) {
            $tags = json_decode($note->tags, true);

            DB::table('notes')->where('id', $note->id)->update([
                'tag' => $tags[0] ?? null,
            ]);
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('tags');
        });
    }
};
