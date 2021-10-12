<?php

namespace App\DataTables;

use App\Models\Bahan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BahanDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="/supplier/edit" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                $btn = $btn.' <a href="/supplier/destroy" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                return $btn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Bahan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Bahan $model)
    {
        return $model->newQuery()->with(['supplier']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('bahan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'nama_bahan',
            'nama_supplier' => new \Yajra\DataTables\Html\Column(['title' => 'Nama Supplier','data' => 'supplier.nama_supplier', 'name' => 'supplier.nama_supplier']),
            'jumlah_bahan',
            'satuan_bahan',
            'harga_bahan',
            'action'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Bahan_' . date('YmdHis');
    }
}
