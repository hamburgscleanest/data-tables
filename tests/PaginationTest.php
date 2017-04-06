<?php

namespace hamburgscleanest\DataTables\Tests;

use hamburgscleanest\DataTables\Facades\DataTable;
use hamburgscleanest\DataTables\Models\DataComponents\Paginator;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class PaginationTest
 * @package hamburgscleanest\DataTables\Tests
 */
class PaginationTest extends TestCase {

    use DatabaseMigrations;

    /**
     * @test
     */
    public function pagination_is_rendered_correctly_for_first_page()
    {
        /** @var Paginator $paginator */
        $paginator = new Paginator();

        /** @var \hamburgscleanest\DataTables\Models\DataTable $dataTable */
        DataTable::query(TestModel::select(['id', 'created_at', 'name']))->addComponent($paginator);

        $this->assertEquals(
            '<ul><li><a href="' . $this->baseUrl . '?page=2">→</a></li></ul>',
            $paginator->render()
        );
    }

    /**
     * @test
     */
    public function pagination_is_rendered_correctly_for_last_page()
    {
        /** @var Paginator $paginator */
        $paginator = new Paginator();

        /** @var \hamburgscleanest\DataTables\Models\DataTable $dataTable */
        DataTable::query(TestModel::select(['id', 'created_at', 'name']))->addComponent($paginator);

        $pageCount = $paginator->pageCount();

        $this->get($this->baseUrl . '?page=' . $pageCount);

        $this->assertEquals(
            '<ul><li><a href="' . $this->baseUrl . '?page="' . ($pageCount - 1) . '>←</a></li></ul>',
            $paginator->render()
        );
    }

    /**
     * @test
     */
    public function pagination_is_rendered_correctly_for_other_pages()
    {
        /** @var Paginator $paginator */
        $paginator = new Paginator();

        /** @var \hamburgscleanest\DataTables\Models\DataTable $dataTable */
        DataTable::query(TestModel::select(['id', 'created_at', 'name']))->addComponent($paginator);

        $this->get($this->baseUrl . '?page=2');

        $this->assertEquals(
            '<ul><li><a href="' . $this->baseUrl . '?page=1">←</a></li><li><a href="' . $this->baseUrl . '?page=3">→</a></li></ul>',
            $paginator->render()
        );
    }
}