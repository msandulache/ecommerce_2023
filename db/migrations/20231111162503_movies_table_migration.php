<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MoviesTableMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('movies');

        $table->addColumn('tmdb_id', 'integer')
            ->addColumn('title', 'string')
            ->addColumn('original_language', 'string')
            ->addColumn('original_title', 'string')
            ->addColumn('overview', 'text')
            ->addColumn('genre_ids', 'string')
            ->addColumn('backdrop_path', 'string')
            ->addColumn('poster_path', 'string')
            ->addColumn('adult', 'boolean')
            ->addColumn('video', 'boolean')
            ->addColumn('popularity', 'decimal')
            ->addColumn('vote_average', 'decimal')
            ->addColumn('vote_count', 'integer')
            ->addColumn('category_id', 'integer')
            ->addColumn('release_date', 'date')
           /* ->addForeignKey('category_id', 'categories', ['id'],
                ['constraint' => 'movies_category_id']);*/
            ->addTimestamps();

        $table->create();
    }
}
