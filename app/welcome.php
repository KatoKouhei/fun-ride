<?php

namespace App;

use cebe\markdown\Markdown as Markdown; ←追加

class Welcome extends Model
{
  public function parse() {
        //newでインスタンスを作る
        $parser = new Markdown();
        //bodyをパースする
        return $parser->parse($this->body);
    }

  public function getMarkBodyAttribute() {
        return $this->parse();
  }
}