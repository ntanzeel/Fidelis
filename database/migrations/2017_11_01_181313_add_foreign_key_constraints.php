<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyConstraints extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('followers', function (Blueprint $table) {
            $table->foreign('follower_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('following_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('category_tag', function (Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('post_tag', function (Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('votes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('images', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('notifiable_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('blocked', function (Blueprint $table) {
            $table->foreign('blocker_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('blocked_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('user_recommendations', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_recommendation')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('content_recommendations', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('content_recommendation')->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('name')->references('name')->on('default_settings')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropForeign('password_resets_email_foreign');
        });

        Schema::table('followers', function (Blueprint $table) {
            $table->dropForeign('followers_follower_id_foreign');
            $table->dropForeign('followers_following_id_foreign');
        });

        Schema::table('category_tag', function (Blueprint $table) {
            $table->dropForeign('category_tag_tag_id_foreign');
            $table->dropForeign('category_tag_category_id_foreign');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_user_id_foreign');
        });

        Schema::table('post_tag', function (Blueprint $table) {
            $table->dropForeign('post_tag_tag_id_foreign');
            $table->dropForeign('post_tag_post_id_foreign');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_post_id_foreign');
            $table->dropForeign('comments_user_id_foreign');
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign('subscriptions_user_id_foreign');
            $table->dropForeign('subscriptions_tag_id_foreign');
        });

        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign('votes_user_id_foreign');
            $table->dropForeign('votes_comment_id_foreign');
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_post_id_foreign');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign('notifications_notifiable_id_foreign');
        });

        Schema::table('blocked', function (Blueprint $table) {
            $table->dropForeign('blocked_blocker_id_foreign');
            $table->dropForeign('blocked_blocked_id_foreign');
        });

        Schema::table('user_recommendations', function (Blueprint $table) {
            $table->dropForeign('user_recommendations_user_id_foreign');
            $table->dropForeign('user_recommendations_user_recommendation_foreign');
            $table->dropForeign('user_recommendations_tag_id_foreign');
        });

        Schema::table('content_recommendations', function (Blueprint $table) {
            $table->dropForeign('content_recommendations_user_id_foreign');
            $table->dropForeign('content_recommendations_content_recommendation_foreign');
            $table->dropForeign('content_recommendations_tag_id_foreign');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign('reports_user_id_foreign');
            $table->dropForeign('reports_comment_id_foreign');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropForeign('settings_user_id_foreign');
            $table->dropForeign('settings_name_foreign');
        });
    }
}
