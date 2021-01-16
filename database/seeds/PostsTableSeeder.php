<?php

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CATEGORIES
        $category1 = Category::create([
            'name' => 'News'
        ]);
        $category2 = Category::create([
            'name' => 'National Security'
        ]);
        // POSTS
        $post1 = Post::create([
            'title' => 'Blockchain Developers',
            'description' => 'Information about jobs',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg'
        ]);
        $post2 = Post::create([
            'title' => 'Security Breach at RedHat',
            'description' => 'News about hacking',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg'
        ]);
        $post3 = Post::create([
            'title' => 'Bitcoin sky rockets',
            'description' => 'Information about the BTC Price',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'category_id' => $category1->id,
            'image' => 'posts/3.jpg'
        ]);
        $post4 = Post::create([
            'title' => 'Laravel 8',
            'description' => 'Features about Laravel 8',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'category_id' => $category1->id,
            'image' => 'posts/4.jpg'
        ]);
        // TAGS
        $tag1 = Tag::create([
            'name' => 'Jobs'
        ]);
        $tag2 = Tag::create([
            'name' => 'Marketing'
        ]);
        $tag3 = Tag::create([
            'name' => 'Networking'
        ]);
        // ASIGN TAGS TO THE POSTS
        $post1->tags()->attach([$tag2->id]);
        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post1->tags()->attach([$tag3->id]);
        $post1->tags()->attach([$tag3->id, $tag1->id]);
    }
}
