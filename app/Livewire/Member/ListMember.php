<?php

namespace App\Livewire\Member;

use Flux\Flux;
use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class ListMember extends Component
{
    use WithPagination;

    public $editId = null;
    public $deleteId = null;

    public $nama = '';
    public $whatsapp = '';
    public $search = '';

    public $sortBy = 'nama';
    public $sortDirection = 'asc';

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $this->reset([
            'nama',
            'whatsapp',
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
            'nama' => 'required',
            'whatsapp' => 'required'
        ]);

        Member::updateOrCreate(
            ['id' => $this->editId],
            [
                'nama' => $this->nama,
                'whatsapp' => $this->whatsapp,
            ]
        );

        Flux::toast(
            variant: 'success',
            text: $this->editId
                ? __('Member updated.')
                : __('Member created.')
        );

        $this->reset([
            'nama',
            'whatsapp',
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
        $member = Member::findOrFail($id);

        $this->editId = $member->id;
        $this->nama = $member->nama;
        $this->whatsapp = $member->whatsapp;
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
        Member::findOrFail($this->deleteId)->delete();

        Flux::toast(
            variant: 'success',
            text: __('Member deleted.')
        );

        $this->reset('deleteId');
        $this->dispatch('close-modal');
    }

    /*
    |--------------------------------------------------------------------------
    | Reset pagination saat search
    |--------------------------------------------------------------------------
    */
    public function updatedSearch()
    {
        $this->resetPage();
    }

    /*
    |--------------------------------------------------------------------------
    | Members Data
    |--------------------------------------------------------------------------
    */
    public function getMembersProperty()
    {
        return Member::where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('whatsapp', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(5);
    }

    /*
    |--------------------------------------------------------------------------
    | Sort
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
    }

    /*
    |--------------------------------------------------------------------------
    | Export PDF
    |--------------------------------------------------------------------------
    */
    public function exportPdf()
    {
        $members = Member::where(function ($query) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('whatsapp', 'like', '%' . $this->search . '%');
        })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->get();

        $pdf = Pdf::loadView('pdf.members', [
            'members' => $members
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'members.pdf'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */
    public function render()
    {
        return view('livewire.member.list-member');
    }
}
