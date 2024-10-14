<?php

namespace Tests\Feature\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MoviesTableMigrationTest extends TestCase
{
    use RefreshDatabase;

    public static function expectedSchemaProvider(): array
    {
        return [
            'id' => ['id', 'integer'],
            'title' => ['title', 'string'],
            'year' => ['year', 'integer'],
            'poster' => ['poster', 'string'],
            'created_at' => ['created_at', 'datetime'],
            'updated_at' => ['updated_at', 'datetime'],
        ];
    }

    /** @group migrations:movies */
    public function test_the_database_has_a_movies_table()
    {
        $this->assertTrue(
            Schema::hasTable('movies'),
            'The [movies] table does not exist on the database. Did you create the corresponding migration ?'
        );
    }

    /**
     * @group migrations:movies
     * @dataProvider expectedSchemaProvider
     */
    public function test_the_movies_table_has_all_columns(string $column)
    {
        $this->assertTrue(
            Schema::hasColumn('movies', $column),
            "The [movies] table is missing an expected [$column] column."
        );
    }

    /**
     * @group migrations:movies
     * @dataProvider expectedSchemaProvider
     */
    public function test_the_movies_table_columns_are_of_the_expected_type($column, $expectedType)
    {
        $type = Schema::connection('sqlite')
            ->getColumnType('movies', $column);

        $this->assertEquals(
            $expectedType, $type,
            "Column [$column] is of type [$type] but was expected to be of type [$expectedType]"
        );
    }
}
