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
     * @param string $category->category_name
     * Category name
     *
     * @param string category_explanation
     * Category explanation
     *
     * @return void
     */
    public function add_new_category($category) {
        $category->date = new DateTime();
        DB::table("categories")->insert([
            "category_name" => $category->category_name,
            "category_explanation" => $category->category_explanation,
            "category_last_activity" => $category->date->getTimestamp(),
        ]);
    }

    /**
     * Delete'selected category
     *
     * @param  integer $categoryid
     * Category Id
     *
     * @return void
     */
    public function delete_category(int $categoryid) {
        DB::table("categories")
        ->where("id", $categoryid)
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
     * @param string $category->old_category_name
     * Old category name
     *
     * @param string $category->new_category_name
     * (default = old category name) New category name
     *
     * @param string $category->category_explanation
     * (default= old category explanation) New category explanation
     *
     * @return bool
     */
    public function edit_category($category){
        if(isset($category->category_explanation) && isset($category->new_category_name))
        {
            DB::table("categories")
                ->where("category_name", $category->old_category_name)
                ->update([
                    "category_name" => $category->new_category_name,
                    "category_explanation" => $category->category_explanation
                ]);
        }
        elseif(isset($category->category_explanation))
        {
            DB::table("categories")
                ->where("category_name", $category->old_category_name)
                ->update([
                    "category_explanation" => $category->category_explanation
                ]);
        }
        elseif(isset($category->new_category_name))
        {
            DB::table("categories")
                ->where("category_name", $category->old_category_name)
                ->update([
                    "category_name" => $category->new_category_name
                ]);
        }

    }
}
