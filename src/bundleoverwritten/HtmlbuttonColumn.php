<?php
/**
 * Created by PhpStorm.
 * User: mirkovoss
 * Date: 23.05.19
 * Time: 20:50
 */

namespace App\bundleoverwritten;


use http\Env\Request;
use Omines\DataTablesBundle\Column\TextColumn;


class HtmlbuttonColumn extends TextColumn
{

    /**
     * {@inheritdoc}
     */
    public function normalize($value): string
    {
        $value = (string) $value;
        $this->isRaw() ? $value : htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE);

          if(is_numeric($value)) {
              return '<a href="?clear='.$value.'" data-toggle="modal" data-target="#clear"> <i class="btn-outline-primary btn pe-7s-close "></i></a>
               <a href="?edit='.$value.'" data-toggle="modal" data-target="#editfrom"> <i class="btn-outline-primary btn pe-7s-edit"></i></a>';

          }else {
              return false;

          }
    }


}