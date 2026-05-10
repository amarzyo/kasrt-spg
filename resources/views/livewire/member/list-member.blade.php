<div class="relative mb-6 w-full">
    {{-- Heading --}}
    <flux:heading size="xl" level="1">{{ __('Members') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage members') }}</flux:subheading>
    <flux:separator variant="subtle" class="my-6" />

    {{-- Control --}}
    <div class="flex w-full items-center justify-end gap-3 md:w-auto">

        <!-- Search -->
        <flux:input icon="magnifying-glass" placeholder="Search members" size="sm" wire:model.live.debounce.300ms="search" class="w-full" />

        {{-- Export button --}}
        <flux:button variant="primary" color="rose" size="sm" wire:click="exportPdf">
            Export
        </flux:button>

        <!-- Add button -->
        <flux:modal.trigger name="modals-member">
            <flux:button variant="primary" color="blue" size="sm" wire:click="create">
                + Add
            </flux:button>
        </flux:modal.trigger>

    </div>

    {{-- Separator --}}
    <flux:separator variant="subtle" class="mt-6" />

    {{-- Table Members --}}
    <flux:table :paginate="$this->members">

        <flux:table.columns>
            <flux:table.column>#</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'nama'" :direction="$sortDirection" wire:click="sort('nama')">
                Nama
            </flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'whatsapp'" :direction="$sortDirection" wire:click="sort('whatsapp')">
                WhatsApp
            </flux:table.column>
            <flux:table.column>Action</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>

            @forelse ($this->members as $row)
                <flux:table.row>

                    <flux:table.cell>
                        {{ ($this->members->currentPage() - 1) * $this->members->perPage() + $loop->iteration }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ ucwords($row->nama) }}
                    </flux:table.cell>

                    <flux:table.cell>
                        <flux:badge color="green" size="sm">
                            <flux:link href="https://wa.me/{{ $row->whatsapp }}" target="_blank">
                                {{ '+' . $row->whatsapp }}
                            </flux:link>
                        </flux:badge>
                    </flux:table.cell>

                    <flux:table.cell>
                        <div class="flex gap-2">

                            {{-- Edit --}}
                            <flux:modal.trigger name="modals-member">
                                <flux:button size="sm" variant="filled" wire:click="edit({{ $row->id }})">
                                    Edit
                                </flux:button>
                            </flux:modal.trigger>

                            {{-- Delete --}}
                            <flux:modal.trigger name="delete-member">
                                <flux:button size="sm" variant="danger" wire:click="confirmDelete({{ $row->id }})">
                                    Delete
                                </flux:button>
                            </flux:modal.trigger>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="4">
                        <div class="py-3 text-center text-sm text-zinc-500">
                            Data member tidak ditemukan.
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    {{-- Modal add and edit --}}
    <flux:modal name="modals-member" class="md:w-96" x-on:close-modal.window="$flux.modal('modals-member').close()">
        <div class="space-y-6">

            {{-- Heading modal --}}
            <div>
                <flux:heading size="lg">
                    {{ $editId ? 'Edit Member' : 'Tambah Member' }}
                </flux:heading>
                <flux:text class="mt-2">
                    Manage member details.
                </flux:text>
            </div>

            {{-- Form input --}}
            <flux:input label="Nama" placeholder="Masukkan nama" size="sm" wire:model="nama" />
            <flux:input label="Whatsapp" mask="6299999999995" placeholder="8xxxxxxxxxx" size="sm" wire:model="whatsapp" />

            {{-- Control input --}}
            <div class="flex items-center gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost" size="sm">
                        Cancel
                    </flux:button>
                </flux:modal.close>
                <flux:button wire:click="save" wire:loading.attr="disabled" variant="primary" color="blue" size="sm" class="w-full">
                    <span wire:loading.remove wire:target="save">
                        {{ $editId ? 'Update' : 'Save' }}
                    </span>
                    <span wire:loading wire:target="save">
                        Saving...
                    </span>
                </flux:button>
            </div>

        </div>
    </flux:modal>

    {{-- Modal delete --}}
    <flux:modal name="delete-member" class="min-w-[22rem]" x-on:close-modal.window="$flux.modal('delete-member').close()">
        <div class="space-y-6">

            {{-- Modal heading --}}
            <div>
                <flux:heading size="lg">
                    Delete member?
                </flux:heading>
                <flux:text class="mt-2">
                    You're about to delete this member.
                    <br>
                    This action cannot be reversed.
                </flux:text>
            </div>

            {{-- Modal control --}}
            <div class="flex gap-2">
                <flux:spacer />

                {{-- Cancel --}}
                <flux:modal.close>
                    <flux:button variant="ghost">
                        Cancel
                    </flux:button>
                </flux:modal.close>

                {{-- Delete --}}
                <flux:button wire:click="delete" wire:loading.attr="disabled" variant="danger">
                    <span wire:loading.remove wire:target="delete">
                        Delete!
                    </span>
                    <span wire:loading wire:target="delete">
                        Deleting...
                    </span>
                </flux:button>

            </div>
        </div>
    </flux:modal>
