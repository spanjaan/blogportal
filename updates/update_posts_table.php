<?php

declare(strict_types=1);

namespace SpAnjaan\BlogPortal\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use System\Classes\PluginManager;

/**
 * CreateViewsTable Migration
 */
class CreateViewsTable extends Migration
{
    /**
     * @inheritDoc
     */
    public function up()
    {
        if (!PluginManager::instance()->hasPlugin('RainLab.Blog')) {
            return;
        }

        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            $table->integer('spanjaan_blogportal_views')->unsigned()->default(0);
            $table->integer('spanjaan_blogportal_unique_views')->unsigned()->default(0);
        });
    }

    /**
     * @inheritDoc
     */
    public function down()
    {
        if (method_exists(Schema::class, 'dropColumns')) {
            Schema::dropColumns('rainlab_blog_posts', ['spanjaan_blogportal_views', 'spanjaan_blogportal_unique_views']);
        } else {
            Schema::table('rainlab_blog_posts', function (Blueprint $table) {
                if (Schema::hasColumn('rainlab_blog_posts', 'spanjaan_blogportal_views')) {
                    $table->dropColumn('spanjaan_blogportal_views');
                }
            });
            Schema::table('rainlab_blog_posts', function (Blueprint $table) {
                if (Schema::hasColumn('rainlab_blog_posts', 'spanjaan_blogportal_unique_views')) {
                    $table->dropColumn('spanjaan_blogportal_unique_views');
                }
            });
        }
    }
}
