<?php
/**
 * Created by PhpStorm.
 * User: mirkovoss
 * Date: 23.05.19
 * Time: 20:50
 */

namespace App\bundleoverwritten;


use Omines\DataTablesBundle\Column\TextColumn;


class HtmlcolorColumn extends TextColumn
{

    /**
     * {@inheritdoc}
     */
    public function normalize($value): string
    {
        $value = (string) $value;

        $this->isRaw() ? $value : htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE);

        if(preg_match('/^#[a-f0-9]{6}$/i', $value)){
              return '<div style="background:'.$value.';width:20px;height:20px;"></div>';

          }else {
              return false;

          }
    }


}