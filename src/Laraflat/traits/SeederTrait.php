<?php

namespace Laraflat\Laraflat\Laraflat\Traits;


use Laraflat\Laraflat\Laraflat\Models\Relation;

trait SeederTrait
{

   /*
    * generate seeder file based on column
    * module data store in database
    */

   protected function getModuleText($module){

       $data = '';

       $data .= "\t\t".'$array = ['."\n";

       $data .= $this->moduleLine('id' ,$module);

        foreach ($module->getFillable() as $field){

            $data .= $this->moduleLine($field ,$module);

        }

       $data .= "\t\t".'];'."\n";

        return $data;

   }

   /*
    * generate line for module
    */

   protected function moduleLine($field , $module){

       return "\t\t\t"."'".$field."' => '".$module->{$field}."',"."\n";

   }

    /*
     * generate seeder file based on column
     *  data store in database
     */

    protected function getColumnText($columns){

        $data = '';

        $data .= "\t\t".'$array = ['."\n";

        foreach ($columns as  $column){

            $data .= "\t\t\t".'['."\n";

            $data .= $this->columnLine('id' , $column);

            foreach ($column->getFillable() as $field){

                $data .= $this->columnLine($field , $column);

            }

            $data .= "\t\t\t".'],'."\n";

        }

        $data .= "\t\t".'];'."\n";
        return $data;

    }


    /*
     * generate line for column
     */

    protected function columnLine($field , $column){

        return "\t\t\t\t"."'".$field."' => '".$column->{$field}."',"."\n";

    }

    /*
     * generate seeder file based on column
     * details data store in database
     */

    protected function getColumnDetailsText($columns){

        $data = '';

        $data .= "\t\t".'$array = ['."\n";

        foreach ($columns as  $column){

            $data .= "\t\t\t".'['."\n";

            $data .= $this->detailLine('id' , $column->details);

            foreach ($column->details->getFillable() as $detail){

                $data .= $this->detailLine($detail , $column->details);

            }

            $data .= "\t\t\t".'],'."\n";

        }

        $data .= "\t\t".'];'."\n";

        return $data;

    }

    /*
  * generate line for column
  */

    protected function detailLine($field , $column){

        return "\t\t\t\t"."'".$field."' => '".$column->{$field}."',"."\n";

    }


    /*
    * generate seeder file based on module
    * relation data store in database
    */

    protected function getModuleRelation($module_id){

        $relations = Relation::where('module_from_id' , $module_id)->get();

        $data = '';

        $data .= "\t\t".'$array = ['."\n";

        foreach ($relations as  $relation){

            $data .= "\t\t\t".'['."\n";

            $data .= $this->detailLine('id' , $relation);

            foreach ($relation->getFillable() as $detail){

                $data .= $this->detailLine($detail , $relation);

            }

            $data .= "\t\t\t".'],'."\n";

        }

        $data .= "\t\t".'];'."\n";

        return $data;

    }



}