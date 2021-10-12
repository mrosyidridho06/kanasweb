<?php

namespace App\DataTables;

use App\Models\Karyawan;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KaryawanDataTable extends DataTable
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
            ->addColumn('foto', function($data){
                return;
            })
            ->addColumn('action', '<button class="btn btn-primary">Hapus</button>')
            ->rawColumns(['foto', 'action']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Karyawan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Karyawan $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('karyawan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('csv'),
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('nama_karyawan'),
            Column::make('alamat_karyawan'),
            Column::make('hp_karyawan'),
            Column::make('agama'),
            Column::make('jabatan'),
            Column::computed('foto'),
            Column::make('tanggal'),
            Column::computed('action')
                  ->exportable(true)
                  ->printable(true)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Karyawan_' . date('YmdHis');
    }
}
