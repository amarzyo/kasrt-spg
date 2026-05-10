<?php

namespace App\Livewire\Tarikan;

use Flux\Flux;
use App\Models\Member;
use App\Models\Tarikan;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class ListTarikan extends Component
{
    use WithPagination;

    public $member_id = '';
    public $nominal = '';

    public $editId = null;
    public $deleteId = null;

    public $search = '';

    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $this->reset([
            'member_id',
            'nominal',
            'editId'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Save
    |--------------------------------------------------------------------------
    */
    public function save()
    {
        $this->validate([
            'member_id' => 'required',
            'nominal' => 'required|numeric|min:1',
        ]);

        Tarikan::updateOrCreate(
            [
                'id' => $this->editId
            ],
            [
                'member_id' => $this->member_id,
                'nominal' => $this->nominal,
            ]
        );

        Flux::toast(
            variant: 'success',
            text: $this->editId
                ? __('Tarikan updated.')
                : __('Tarikan created.')
        );

        $this->reset([
            'member_id',
            'nominal',
            'editId'
        ]);

        $this->dispatch('close-modal');
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $tarikan = Tarikan::findOrFail($id);

        $this->editId = $tarikan->id;
        $this->member_id = $tarikan->member_id;
        $this->nominal = $tarikan->nominal;
    }

    /*
    |--------------------------------------------------------------------------
    | Confirm Delete
    |--------------------------------------------------------------------------
    */
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */
    public function delete()
    {
        Tarikan::findOrFail($this->deleteId)->delete();

        Flux::toast(
            variant: 'success',
            text: __('Tarikan deleted.')
        );

        $this->reset('deleteId');

        $this->dispatch('close-modal');
    }

    /*
    |--------------------------------------------------------------------------
    | Reset page saat search
    |--------------------------------------------------------------------------
    */
    public function updatedSearch()
    {
        $this->resetPage();
    }

    /*
    |--------------------------------------------------------------------------
    | Data Tarikan
    |--------------------------------------------------------------------------
    */
    public function getTarikansProperty()
    {
        return Tarikan::with('member')

            ->whereHas('member', function ($query) {

                $query->where('nama', 'like', '%' . $this->search . '%');
            })

            ->orderBy($this->sortBy, $this->sortDirection)

            ->paginate(10);
    }

    /*
    |--------------------------------------------------------------------------
    | Members
    |--------------------------------------------------------------------------
    */
    public function getMembersProperty()
    {
        return Member::orderBy('nama')->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Sorting
    |--------------------------------------------------------------------------
    */
    public function sort($field)
    {
        if ($this->sortBy === $field) {

            $this->sortDirection =
                $this->sortDirection === 'asc'
                ? 'desc'
                : 'asc';
        } else {

            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    /*
    |--------------------------------------------------------------------------
    | Export pdf
    |--------------------------------------------------------------------------
    */
    public function exportPdf()
    {
        $tarikans = Tarikan::with('member')
            ->whereHas('member', function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->get();

        $total = $tarikans->sum('nominal');
        $pdf = Pdf::loadView('pdf.tarikans', [
            'tarikans' => $tarikans,
            'total' => $total,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'tarikans.pdf'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */
    public function render()
    {
        return view('livewire.tarikan.list-tarikan');
    }
}
