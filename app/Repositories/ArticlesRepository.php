<?php
/**
 */

namespace Corp\Repositories;

use Illuminate\Database\Eloquent\Model;
use Corp\Article;

class ArticlesRepository extends Repository
{
    public function __construct(Article $article)
    {
        parent::__construct($article);
    }
}