<?php

namespace Tests\Feature\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ReviewsTableMigrationTest extends TestCase
{
    use RefreshDatabase;

    public static function expectedSchemaProvider(): array
    {
        return [
            'id' => ['id', 'integer'],
            'author' => ['author', 'string'],
            'body' => ['body', 'text'],
            'movie_id' => ['movie_id', 'integer'],
            'created_at' => ['created_at', 'datetime'],
            'updated_at' => ['updated_at', 'datetime'],
        ];
    }

    /** @group migrations:reviews */
    public function test_the_database_has_a_reviews_table()
    {
        $this->assertTrue(
            Schema::hasTable('reviews'),
            'The [reviews] table does not exist on the database. Did you create the corresponding migration ?'
        );
    }

    /**
     * @group migrations:reviews
     * @dataProvider expectedSchemaProvider
     */
    public function test_the_reviews_table_has_all_columns(string $column)
    {
        $this->assertTrue(
            Schema::hasColumn('reviews', $column),
            "The [reviews] table is missing an expected [$column] column."
        );
    }

    /**
     * @group migrations:reviews
     * @dataProvider expectedSchemaProvider
     */
    public function test_the_reviews_table_columns_are_of_the_expected_type($column, $expectedType)
    {
        $type = Schema::connection('sqlite')
            ->getColumnType('reviews', $column);

        $this->assertEquals(
            $expectedType, $type,
            "Column [$column] is of type [$type] but was expected to be of type [$expectedType]"
        );
    }
}
