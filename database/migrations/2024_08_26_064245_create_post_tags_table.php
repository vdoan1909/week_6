<?php

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('post_tags', function (Blueprint $table) {
            $table->foreignIdFor(Post::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Tag::class)->constrained()->onDelete('cascade');
            $table->primary(['post_id', 'tag_id']);
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('post_tags');
    }
};
