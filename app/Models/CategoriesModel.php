<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriesModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "categories";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Adds New Category to Table
     *
     * @param  stdClass $category
     *
     * Category standart class will contains this elements
     *
     * @param string $category->name
     * Category name
     *
     * @param string $category->explanation
     * Category explanation
     *
     * @return void
     */
    public function add_new_category($category) {
        $category->date = new DateTime();
        DB::table("categories")->insert([
            "name" => $category->name,
            "explanation" => $category->explanation,
            "last_activity" => $category->date->getTimestamp(),
        ]);
    }

    /**
     * Delete'selected category
     *
     * @param  integer $id
     * Category Id
     *
     * @return void
     */
    public function delete_category(int $id) {
        DB::table("categories")
        ->where("id", $id)
        ->delete();
    }

    /**
     * Gets all categories
     *
     * @return Illuminate\Support\Collection
     */
    public function get_all_categories(){
        return DB::table("categories")->get();
    }

    /**
     * Edits a category from table
     *
     * @param  stdClass $category
     *
     * Category standart class will contains this elements
     *
     * @param string $category->old_name
     * Old category name
     *
     * @param string $category->new_name
     * (default = old category name) New category name
     *
     * @param string $category->explanation
     * (default= old category explanation) New category explanation
     *
     * @return bool
     */
    public function edit_category($category){
        if(isset($category->explanation) && isset($category->new_name))
        {
            DB::table("categories")
                ->where("name", $category->old_name)
                ->update([
                    "name" => $category->new_name,
                    "explanation" => $category->explanation
                ]);
        }
        elseif(isset($category->explanation))
        {
            DB::table("categories")
                ->where("category_name", $category->old_name)
                ->update([
                    "category_explanation" => $category->explanation
                ]);
        }
        elseif(isset($category->new_name))
        {
            DB::table("categories")
                ->where("category_name", $category->old_name)
                ->update([
                    "category_name" => $category->new_name
                ]);
        }
    }
}
