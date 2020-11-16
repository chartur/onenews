<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = file_get_contents('http://localhost:8000/posts/wp-data');
        $data = json_decode($data);
        $count = count($data);
        $cat_counts = Category::count();

        $k = $count / $cat_counts;
        $index = 1;

        for ($i=0; $i <= $count - 1; $i++) {
            $post = new Post();
            $post->hy_title = $data[$i]->hy_title;
            $post->hy_content = $data[$i]->hy_content;
            $post->created_at = $data[$i]->created_at;
            $post->image = '/upload/default.jpg';
            if(!$i) {
                $post->is_general = true;
            }
            $post->has_video = rand(0,1) == 1; // Random true or false
            if($i >= $k * $index) {
                $index++;
            }
            $post->category_id = $index;
            $post->save();
        }
    }
}
