<?php

namespace Laraflat\Laraflat\Laraflat\Traits;



use Laraflat\Laraflat\Laraflat\Models\Column;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait MigrationTrait
{


    use MigrationRelationTrait;

   /*
    * generate migration file based on column
    * sored on columns table
    */

   protected function generateMigration($module_id){

       /*
         * get supported language
         * to add multi language fields
         */

       $languages = LaravelLocalization::getSupportedLanguagesKeys();

       /*
        * get All Columns to generate
        * file
        */

       $columns =  Column::where('module_id' , $module_id)->get();

       /*
        * generate data
        */

       $data = '';
       $data .= "\t\t\t\t"."//////start fields with laraflat"."\n";
       foreach ($columns as $column){
           if($column->multi_lang == 1){
               foreach ($languages as $lang){
                   $data .= $this->tableLine($column , $column->name.'_'.$lang);
               }
           }else{
               $data .= $this->tableLine($column);
           }
       }

       $data .= $this->appendRelationMigration($module_id);

       $data .= "\t\t\t\t"."//////end fields with laraflat";

       return $data;
   }


   /*
    * generate line of file
    */

    protected function tableLine($column , $name = null){
        $data = '';
        $nameAfterCheckLang = $name ? $name : $column->name;
        $data .= "\t\t\t\t".'$table->'.$column->column.'("'.$nameAfterCheckLang.'")';
        if($column->modifiers){
            $data .= '->'.$column->modifiers.'()';
        }
        $data .= ";"."\n";
        return $data;
    }

}